@extends('layouts.default')

@section('content')
       <h1>Register</h1>

        @if($errors->has())
            <p>The following errors have occured:</p>
                <ul id="form-errors">
                      {{ $errors->first('username', '<li>:message</li>') }}
                      {{ $errors->first('password', '<li>:message</li>') }}
                      {{ $errors->first('password_confirmation', '<li>:message</li>') }}
                </ul>
        @endif

{{ Form::open() }}

    <p align="center">
        {{ Form::label('username', 'Username') }} <br/>
        {{ Form::text('username', Input::old('username'), ['class' => 'form-control']) }}
    </p>

    <p align="center">
        {{ Form::label('password', 'Password') }} <br/>
        {{ Form::password('password', ['class' => 'form-control']) }}
    </p>

    <p align="center">
        {{ Form::label('password_confirmation', 'Confirm Password') }} <br/>
        {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
    </p>

    {{ Form::submit('Register', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}
@stop