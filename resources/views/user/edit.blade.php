@extends('layout.app')

@section('title', 'Обновлние Профиля')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('user.update')}}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{$user->name}}"><br>
        <input type="email" name="email" value="{{$user->email}}"><br>
        <button type="submit">Обновить данные</button>
    </form>
    <a href="#">Обновить пароль</a>
@endsection
