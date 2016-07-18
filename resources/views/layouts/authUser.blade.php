@extends('layouts.app')
@section('in navbar')
    <ul class="nav navbar-nav">
        <li><a href="{{ route('books.index') }}">Books</a></li>
    </ul>
    <ul class="nav navbar-nav">
        <li><a href="{{ route('users.index') }}">Users</a></li>
    </ul>
    @yield('create_book_link')
    @yield('create_user_link')

@endsection
