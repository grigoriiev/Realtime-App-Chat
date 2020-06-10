@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header mt-0 mb-1">Profile</div>
                    <div class="card-body">
                        <ul class="list-unstyled">

                            @if(session('delete'))
                                <div class="alert alert-success">
                                    {{ session('delete') }}
                                </div>
                            @endif
                            @if(session('emailSucsses'))
                                <div class="alert alert-success">
                                    {{ session('emailSucsses') }}
                                </div>
                            @endif
                            @if($profile)

                                    <h5  class="mt-0 mb-1">Пользователь ид {{Auth::user()->id}}</h5>
                                    <h5  class="mt-0 mb-1">Имя пользователя {{Auth::user()->name}}</h5>
                                <h5  class="mt-0 mb-1">Профиль ид{{$profile->id}}</h5>
                                    <h5  class="mt-0 mb-1">Имя профиля пользователя {{$profile->name}}</h5>
                                <a href="{{route('statistics', Auth::user()->id)}}"> Статистика  пользователя {{Auth::user()->name}}</a><br>
                                                     <a href="{{route('statistics.mail',Auth::user()->id)}}"> Послать статистику по email пользователю {{Auth::user()->name}}</a><br>
                                <img src="/storage/{{$profile->image}}" /><br>
                                    <p>Аватар пользователя</p>
                                    <a class="navbar-brand" href="{{ url('/joinRoom1') }}">
                                        Иметь возможность писатьть в комнате 1</a><br>
                                    <a class="navbar-brand" href="{{ url('/room/1') }}">
                                        Присоединиться к чату комнаты 1</a><br>
                                <a href="{{route('profile.show', $profile)}}">Редактировать профиль</a>
                            @else
                                <a href="{{route('profile.create')}}">Создать профиль</a>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
