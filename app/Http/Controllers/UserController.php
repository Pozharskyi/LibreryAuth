<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Validator;
use Session;

class UserController extends Controller
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->isAdmin()){
            $users = User::paginate(10);
        } else {
            $users = new Collection();
            $users->add(Auth::user());
        }
        return view('users.index')->with('users', $users);
    }

    public function create()
    {
        if (Gate::denies('create', new User())) {
            abort(403, 'Access denied');
        }
        return view('users.create');
    }

    public function save(Request $request)
    {

        $rules = [
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'email' => 'required|email|unique:users,email',
            'password' =>'required|min:6'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {

            $user = new User();

            if (Gate::denies('create',$user)) {
                abort(403, 'Access denied');
            }

            $user->create($request->all());
            Session::flash('message', 'User has been created');
            return redirect()->route('users.index');
        }
    }

    public function show(User $user)
    {
        if (Gate::denies('show',$user)) {
            abort(403, 'Access denied');
        }
        $assignedBooks = $user->books;
        return view('users.show')->with(compact('user','assignedBooks'));
    }

    public function edit(User $user)
    {
        if (Gate::denies('update',$user)) {
            abort(403, 'Access denied');
        }
        return view('users.edit')->with('user',$user);
    }
    public function update(Request $request, User $user){

        if (Gate::denies('update',$user)) {
            abort(403, 'Access denied');
        }
        $rules = [
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' =>'required|min:6'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {

            $user->update([$request->except('password'),'password'=>bcrypt($request->password)]);
            Session::flash('message', 'User has been updated');
            return redirect()->route('users.index');
        }
    }
    public function delete(User $user)
    {
        if (Gate::denies('delete',$user)) {
            abort(403, 'Access denied');
        }
        Session::flash('message','User has been deleted successful');
        $user->delete();
        return redirect()->route('users.index');
    }
}
