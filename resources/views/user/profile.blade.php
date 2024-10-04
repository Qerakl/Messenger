@extends('layout.app')

@section('title', 'Профиль')

@section('content')
<p>{{$user->name}}</p>
<p>{{$user->email}}</p>
@endsection
