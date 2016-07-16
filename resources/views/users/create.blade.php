@extends('layouts.admin')

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>Create user</h1>
            {{ Form::open(['url' => 'users']) }}

            <div class="form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
                {{ Form::label('firstname','First name') }}
                {{ Form::text('firstname', old('firstname'), ['class' => 'form-control']) }}
                @if ($errors->has('firstname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('firstname') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }}">
                {{ Form::label('lastname','Last name') }}
                {{ Form::text('lastname', old('lastname'), ['class' => 'form-control']) }}
                @if ($errors->has('lastname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                {{ Form::label('email','Email') }}
                {{ Form::email('email', old('email'), ['class' => 'form-control']) }}
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            {{ Form::submit('Create user', ['class' => 'btn btn-primary']) }}

            {{ Form::close() }}
        </div>
    </div>

@endsection