@extends('layouts.admin')
@section('content')



    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>Book #{{ $book->id }}</h1>
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="panel">
                        Title: {{ $book->title  }}
                    </div>

                </li>
                <li class="list-group-item">
                    <div class="panel">
                        Author: {{ $book->author }}
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="panel">
                        Year: {{ $book->year }}
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="panel">
                        Genre: {{ $book->genre }}
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="panel">
                        Book was assigned to:
                        @if(isset($bookOwner))
                            <a href="{{ $bookOwner->path() }}">{{ $bookOwner->lastname }}</a>
                        @else
                            No one
                        @endif
                    </div>

                </li>
            </ul>
            <div class="panel-primary">
                @if(!isset($bookOwner))
                    <div class="lead">
                        Select the user for assignment :
                    </div>
                    {{ Form::model($book, ['route' => ['books.assign', $book->id]]) }}
                    {{ Form::select('userId',$usersAndIds)}}
                    {{ Form::submit('Assign the book',['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                @else
                    <div class="lead">
                        Refund the book before assigning it to another user:
                    </div>
                    <a class="btn btn-small btn-success" href="{{ route('books.refund',['book'=>$book->id]) }}">Refund
                        the book</a>
                @endif
            </div>
        </div>
    </div>
@endsection