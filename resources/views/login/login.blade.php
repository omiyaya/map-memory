@extends('layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">
@endsection

@section('content')
    <div class="login">
        <div class="title">mapMemory</div>
        <form action="login" method="post">
            @csrf
            <login-component></login-component>
            <input type="submit" class="button" value="login">
        </form>
    </div>
@endsection