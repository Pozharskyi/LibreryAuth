@extends('layout')
@section('content')



    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>User #{{ $user->id }}</h1>
            <ul class="list-group">
                <li class="list-group-item">
                    <pre>First name:  {{ $user->firstname }}</pre>
                </li>
                <li class="list-group-item">
                    <pre>Last name:  {{ $user->lastname }}</pre>
                </li>
                <li class="list-group-item">
                    <pre>Email:  {{ $user->email }}</pre>
                </li>
                <span>Assigned books:</span>
                @foreach($assignedBooks as $book)
                    <li class="list-group-item">
                        #{{ $book->id }} {{$book->title}}
                    </li>

                @endforeach
            </ul>

        </div>
    </div>
@endsection