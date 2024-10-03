@extends('layout.app')

@section('title', 'Регистрация')

@section('content')
    <form action="{{route('user.register')}}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Имя"><br>
        <input type="email" name="email" placeholder="Почта"><br>
        <input type="password" name="password" placeholder="Пароль"><br>
        <button type="submit">Вход</button>
    </form>
@endsection
