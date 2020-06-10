@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a class="navbar-brand" href="{{ url('/profile') }}">
                    Профиль</a><br>
                <div class="card">
                    <div class="card-header mt-0 mb-1">Статистика профиля и статистика чата</div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            Имя профиля пользователя {{$profileName}}<br>
                            Количество комнат в которых может писать пользователь профиля {{$userProfileCount}}<br>
                            Количество сообщений пользователя {{$messagesUser}}<br>
                            Количество пользователей в зарегистрированнных пользователей {{$usersCount}}<br>
                            Количество сообщений в комнате 1 {{$messageCount}}<br>
                            Количество созданных профилей{{$profilesCount}}<br>
                            Количество созданных комнат{{$roomsCount}}<br>
                            <a href="{{route('statistics.mail',Auth::user()->id)}}"> Послать на email статистику пользователя{{Auth::user()->name}}</a><br>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
