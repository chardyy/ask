@extends('layouts.default')

@section('content')
<div id="ask">
    <h1>Ask a Question</h1>
    @if(!Auth::check())
    <p>Please log in to ask or answer questions</p>
    @else
    @if(count($errors)>0)
    <p>The following errors have occurred</p>
    <ul id="form-errors">
        {{ $errors->first('question', '<li>:message</li>') }}
    </ul>
    @endif

    {{ Form::open(array('url' => route('questions.store'))) }}
    {{ Form::token() }}

    <p>
        {{ Form::label('question', 'Question') }}<br />
        {{ Form::text('question', Input::old('question')) }}
        {{ Form::submit('Ask a question') }}
    </p>
    {{ Form::close() }}
    @endif
</div><!-- ask -->

<div id="questions">
    <h2>Unsolved Questions</h2>
    @if(!count($questions))
    <p>No questions have been asked.</p>
    @else
    <ul class="list-group">
        @foreach($questions as $question)
        <li class="list-group-item">
            <span class="badge"> @if(count($question->answers) <= 1)
                    ({{ count($question->answers) }} Answer)
                @else
                    ({{ count($question->answers) }} Answers)
                @endif
            </span>

                {{ link_to("/questions/{$question->id}", e(Str::limit($question->question, 35))) }}
                by {{ ucfirst($question->user->username) }}

        </li>
        @endforeach
    </ul>

    {{ $questions->links() }}
    @endif
</div>

@stop