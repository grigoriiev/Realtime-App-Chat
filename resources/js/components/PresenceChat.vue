<template>
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-8">
                <a class="navbar-brand" href="/profile">
                    Профиль</a><br>
                <div class="card-header">Messages</div>
                <div class="card-body p-0">
                    <ul class="list-unstyled" style="height:300px; overflow-y:scroll" v-chat-scroll>
                        <li class="p-2" v-for="(message, index) in messages" :key="index" >
                            <time>{{ message.localTime}}</time>
                            <small>{{ message.timezone}}</small>
                            <strong>{{ message.user.name}}</strong>
                            <img v-bind:src="'/storage/'+ message.image" />
                            <span>{{message.message}}</span>
                              </li>
                          </ul>
                      </div>
                      <input type="text" class="form-control" v-model="textMessage" @keyup.enter="sendMessage" @keydown="actionUser">
                      <span v-if="isActive">{{isActive.name}} набирает сообщение...</span>
                  </div>
                  <div class="col-sm-4">
                      <ul>
                          <li v-for="user in activeUsers">{{user}}</li>
                      </ul>
                  </div>
              </div>
          </div>
      </template>

      <script>
          export default {
              props: ['room', 'user','image'],
              data() {
                  return {
                      messages: [],
                      textMessage: '',
                      isActive: false,
                      typingTimer: false,
                      activeUsers: [],
                      localTime:''
                  }
              },
              computed: {
                  channel() {
                      return window.Echo.join('room.' + this.room.id);
                  }
              },
              mounted() {
                  this.fetchMessages();
                  this.channel
                      .here((users) => {
                          this.activeUsers = users;
                      })
                      .joining((user) => {

                              this.activeUsers.push(user);

                      })
                      .leaving((user) => {

                              this.activeUsers.splice(this.activeUsers.indexOf(user), 1);

                      })
                      .listen('MessageSendEvent', ({data}) => {
                          console.log(data);
                          if(data.user.banned===0) {
                              this.messages.push({

                                  user: data.user,
                                  message: data.message,
                                  localTime: data.localTime,
                                  timezone: data.timezone,
                                  image:data.image


                              });
                              this.isActive = false;
                         }
                      })
                      .listenForWhisper('typing', (e) => {
                          if(this.user.banned===0) {
                              this.isActive = e;
                              if (this.typingTimer) clearTimeout(this.typingTimer);
                              this.typingTimer = setTimeout(() => {
                                  this.isActive = false;
                              }, 2000);
                          }
                      });
              },
              methods: {
                fetchMessages() {
                        axios.get('/messages').then(response => {
                            let uploads=response.data;
                            this.messages = response.data;
                            for (let i=0; i<uploads.length; i++){
                                if(response.data[i].user.profile && response.data[i].user.profile.image) {
                                    this.messages[i].image = response.data[i].user.profile.image
                                }else{
                                    this.messages[i].image ='uploads/download.jpeg'
                                }
                            }

                        })
                  },
                  sendMessage() {
                    if(this.textMessage && this.user.banned===0) {
                        axios.post('/messages', {
                            image:this.image.image,
                            message: this.textMessage,
                            room_id: this.room.id,
                            user: this.user,
                            localTime: new Date().toLocaleString(),
                            timezone: Intl.DateTimeFormat().resolvedOptions().timeZone
                        });
                        this.messages.push({

                            image:this.image.image,
                            user: this.user,
                            message: this.textMessage,
                            localTime: new Date().toLocaleString(),
                            timezone: Intl.DateTimeFormat().resolvedOptions().timeZone

                        });
                        this.textMessage = '';
                    }
                  },
                  actionUser() {
                      this.channel
                          .whisper('typing', {
                              name: this.user.name
                          });
                  },

              }
          }
      </script>
