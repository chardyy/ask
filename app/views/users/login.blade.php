@extends('layouts.default')

@section('content')
    <h1>Login</h1>

    {{ Form::open(['login']) }}


        <p align="center">
            {{ Form::label('username', 'Username') }} <br/>
            {{ Form::text('username', Input::old('username'), ['class' => 'form-control']) }}
        </p>

        <p align="center">
            {{ Form::label('password', 'Password') }} <br/>
            {{ Form::password('password', ['class' => 'form-control align-center']) }}
        </p>


        {{ Form::submit('Login', ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}

@stop