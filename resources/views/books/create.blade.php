@extends('layouts.authUser')

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>Create a book</h1>
            {{ Form::open(['url' => 'books']) }}

            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                {{ Form::label('title','Title') }}
                {{ Form::text('title', old('title'), ['class' => 'form-control']) }}
                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('author') ? ' has-error' : '' }}">
                {{ Form::label('author','Author') }}
                {{ Form::text('author', old('author'), ['class' => 'form-control']) }}
                @if ($errors->has('author'))
                    <span class="help-block">
                        <strong>{{ $errors->first('author') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('year') ? ' has-error' : '' }}">
                {{ Form::label('year','Year') }}
                {{ Form::number('year', old('year'), ['class' => 'form-control']) }}
                @if ($errors->has('year'))
                    <span class="help-block">
                        <strong>{{ $errors->first('year') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('genre') ? ' has-error' : '' }}">
                {{ Form::label('genre','Genre') }}
                {{ Form::text('genre', old('genre'), ['class' => 'form-control']) }}
                @if ($errors->has('genre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('genre') }}</strong>
                    </span>
                @endif
            </div>
            {{ Form::submit('Create the book', ['class' => 'btn btn-primary']) }}

            {{ Form::close() }}
        </div>
    </div>

@endsection