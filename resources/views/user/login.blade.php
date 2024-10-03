@extends('layout.app')

@section('title', 'Вход')

@section('content')
    <form action="{{route('user.login')}}" method="POST">
        @csrf
        <input type="email" name="email"><br>
        <input type="password" name="password"><br>
        <button type="submit">Вход</button>
    </form>
@endsection
