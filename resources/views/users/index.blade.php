@extends('layout')
@section('content')
    <h1>All users</h1>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>First name</td>
            <td>Last name</td>
            <td>Email</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <div class="btn-group inline">
                        <a class="btn btn-small btn-success" href="{{ route('users.show',['user'=>$user]) }}">Show User</a>
                        <a class="btn btn-small btn-info" href="{{ route('users.edit',['user'=>$user]) }}">Edit User</a>

                        {{ Form::open(['url' => 'users/' . $user->id, 'class' => 'pull-right']) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete user', ['class' => 'btn btn-warning']) }}
                        {{ Form::close() }}
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection