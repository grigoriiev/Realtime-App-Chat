@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="container">
            <presence-chat :room="{{$room}}" :user="{{Auth::user()}}" :image="{{Auth::user()->profile}}"
            ></presence-chat>
        </div>
    @endif
@endsection
