@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <h1 class="display-3">{{config('app.name', 'Online Survey')}}</h1>
    <p class="lead">Hello there o/ <br> This is the Online Survey!</p>
    <p><a class="btn btn-lg btn-success" href="{{ route('register') }}" role="button">Sign Up</a></p>
</div>
@endsection 