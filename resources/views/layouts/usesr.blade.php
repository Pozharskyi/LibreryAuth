@extends('layouts.app')
@section('in navbar')

    <li><a href="{{ route('books.index') }}">Books</a></li>
    <li><a href="{{ route('users.index') }}">Users</a></li>

@endsection