@extends('layout.app')

@section('title', 'Профиль')

@section('content')
    <img src="{{asset('storage/' . $user->avatar)}}" alt="" style="width: 300px">
<p>{{$user->name}}</p>
<p>{{$user->email}}</p>
    <a href="{{route('user.edit', Auth::id())}}">Обновить данные</a>
@endsection
