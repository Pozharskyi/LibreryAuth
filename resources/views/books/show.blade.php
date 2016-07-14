@extends('layout')
@section('content')



    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>Book #{{ $book->id }}</h1>
            <ul class="list-group">
                <li class="list-group-item">
                    <pre>Title:  {{ $book->title  }}</pre>
                </li>
                <li class="list-group-item">
                    <pre>Author:  {{ $book->author }}</pre>
                </li>
                <li class="list-group-item">
                    <pre>Year:  {{ $book->year }}</pre>
                </li>
                <li class="list-group-item">
                    <pre>Genre:  {{ $book->genre }}</pre>
                </li>
                <li class="list-group-item">
                    <pre>Book was assigned to: {{ (isset($bookOwner)) ? $bookOwner->lastname : 'No one'}}</pre>
                </li>
                <li class="list-group-item">
                    Select the user for assignment :
                    {{ Form::model($book, ['route' => ['books.assign', $book->id]]) }}

                    {{ Form::select('userId',$usersAndIds)}}
                    {{ Form::submit('Assign the book',['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </li>
                <li class="list-group-item">
                    <a class="btn btn-small btn-success" href="{{ route('books.refund',['book'=>$book->id]) }}">Refund the book</a>
                </li>

            </ul>

        </div>
    </div>
@endsection