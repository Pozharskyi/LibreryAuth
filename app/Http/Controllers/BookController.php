<?php

namespace App\Http\Controllers;

use App\User;
use Gate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Book;
use Validator;
use Session;

class BookController extends Controller
{
    /**
     * BookController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(10);

        return view('books.index')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $this->authorize('update');
        if (Gate::denies('update')) {
            abort(403,'Access denied');
        }
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'year' => 'required|integer',
            'title' => 'required|regex:/^[(a-zA-Z\s)]+$/u',         //Regex for words with spaces
            'author' => 'required|regex:/^[(a-zA-Z\s)]+$/u',
            'genre' => 'required|alpha'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {

            $book = new Book();
            if (Gate::denies('update',$book)) {
                abort(403,'Access denied');
            }
            $book->create($request->all());
            Session::flash('message', 'Book has been created');
            return redirect()->route('books.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        $bookOwner = User::find($book->user_id);
        $users = User::all();
        $usersIds = [];
        $usersNames = [];
        foreach ($users as $user) {
            $usersIds [] = $user->id;
            $usersNames [] = $user->lastname;
        }
        $usersAndIds = array_combine($usersIds, $usersNames);   //associative array id=>lastname using in select form

        return view('books.show')->with(compact('book','usersAndIds','bookOwner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('update')) {
            abort(403,'Access denied');
        }
        $book = Book::find($id);
        return view('books/edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'year' => 'required|integer',
            'title' => 'required|regex:/^[(a-zA-Z\s)]+$/u',     //Regex for words with spaces
            'author' => 'required|regex:/^[(a-zA-Z\s)]+$/u',
            'genre' => 'required|alpha'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $book = Book::find($id);
            if (Gate::denies('update',$book)) {
                abort(403,'Access denied');
            }

            $book->update($request->all());

            Session::flash('message', 'Book has been updated');
            return redirect()->route('books.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if (Gate::denies('update',$book)) {
            abort(403,'Access denied');
        }
        $book->delete();
        Session::flash('message', 'Book has been deleted');
        return redirect()->route('books.index');
    }

    public function assignToUser(Request $request, Book $book)
    {
        if (Gate::denies('update',$book)) {
            abort(403,'Access denied');
        }
        $user = User::findOrFail($request->userId);
        $book->user()->associate($user);
        $book->save();

        Session::flash('message', 'Book has been assigned to the user ' . $user->lastname . ' successfully');
        return redirect()->back();
    }
    public function refund (Book $book)
    {
        if (Gate::denies('update',$book)) {
            abort(403,'Access denied');
        }
        $book->user()->dissociate();
        $book->save();
        Session::flash('message', 'Book has been refunded');
        return redirect()->back();
    }
}
