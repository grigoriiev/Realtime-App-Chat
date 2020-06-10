@extends('layouts.app')



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile Detail</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div>
                                <a href="/profile">Профиль</a>
                            </div>
                            <strong>Профиль ID</strong>
                            <p>{{$profile->id}}</p>
                            <strong>Имя профиля</strong>
                            <p>{{$profile->name}}</p>
                            <strong>Имя пользователя</strong>
                            <p>{{Auth::user()->name}}</p>
                            <strong>Пользователь ID</strong>
                            <p>{{Auth::user()->id}}</p>
                            <div>
                                @if(session('update'))
                                    <div class="alert alert-success">
                                        {{ session('update') }}
                                    </div>
                                @endif
                                @if(session('store'))
                                    <div class="alert alert-success">
                                        {{ session('store') }}
                                    </div>
                                @endif
                                <img src="/storage/{{Auth::user()->profile->image}}" />
                                <a href="{{route('profile.edit',$profile->id)}}">Edit Profile</a>
                                <form action="{{route('profile.destroy',$profile->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button>Delete</button>
                                </form>
                            </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
