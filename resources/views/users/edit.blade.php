@extends('layouts.authUser')

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>Edit user</h1>
            {{ Form::model($user, ['route' =>['users.update', $user], 'method'=>'PUT'] )}}

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
                {{ Form::label('email','Year') }}
                {{ Form::email('email', old('email'), ['class' => 'form-control']) }}
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                {{ Form::label('password','Password') }}
                {{ Form::text('password', old('password'), ['class' => 'form-control']) }}
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            {{ Form::submit('Edit user', ['class' => 'btn btn-primary']) }}

            {{ Form::close() }}
        </div>
    </div>

@endsection