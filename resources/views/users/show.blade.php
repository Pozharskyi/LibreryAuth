@extends('layouts.authUser')
@section('content')



    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>User #{{ $user->id }}</h1>
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="panel">
                        First name: {{ $user->firstname }}
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="panel">
                        Last name: {{ $user->lastname }}
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="panel">
                        Email: {{ $user->email }}
                    </div>
                </li>
            </ul>

            <div class="lead">Assigned books:</div>

            <ul class="list-group">
                @foreach($assignedBooks as $book)
                    <li class="list-group-item panel">
                        <div class="">
                            <a href="{{ $book->path() }}"> #{{ $book->id }} {{$book->title}}</a>
                            <a class="btn btn-small btn-success pull-right"
                               href="{{ route('books.refund',['book'=>$book->id]) }}">Refund the book</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection