<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    {{ HTML::style('/css/main.css') }}
    {{ HTML::style('/css/bootstrap.min.css') }}
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1>{{ HTML::link('/', 'Murag ASKfm') }}</h1>

        <div class="row">
            <div class="col-lg-6">
                <div class="input-group">
                      <span class="input-group-btn">

                      </span>
                    {{ Form::open(array('route'=>'search')) }}
                    {{ Form::token() }}
                        {{ Form::text('keyword', '', array('id'=>'keyword', 'autofocus'=>'True', 'placeholder'=>'Search', 'class' => 'form-control')) }}
                    {{ Form::close() }}
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div>
    </div>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li>{{ HTML::link('/', 'Home') }} </li>
                @if(!Auth::check())
                <li>{{ HTML::link('register', 'Register') }} </li>
                <li>{{ HTML::link('login', 'Login') }}</li>
                @else
                <li>{{ HTML::link('logout', 'Logout ('.Auth::user()->username.')') }}</li>
                <li>{{ HTML::link('your-questions', "Your Q's") }}</li>
                @endif
            </ul>
        </div>
    </nav>

    <div class="content">
        @if(Session::has('message'))
        <p id="message">{{ Session::get('message') }}</p>
        @endif

        @yield('content')
    </div>

    <div class="footer">
        &copy; Murag ASKfm {{ date('Y') }}
    </div>
</div>


{{ HTML::script('/js/jquery.min.js') }}
{{ HTML::script('/js/bootstrap.min.js') }}
</body>
</html>