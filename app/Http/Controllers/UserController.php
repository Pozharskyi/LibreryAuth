<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Validator;
use Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    public function create()
    {
        return view('users.create');
    }

    public function save(Request $request)
    {
        $rules = [
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'email' => 'required|email|unique:users,email'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {

            $user = new User();
            $user->create($request->all());
            Session::flash('message', 'User has been created');
            return redirect()->route('users.index');
        }
    }

    public function show(User $user)
    {
        $assignedBooks = $user->books;
        return view('users.show')->with('user',$user)->with('assignedBooks',$assignedBooks);
    }

    public function edit(User $user)
    {
        return view('users.edit')->with('user',$user);
    }
    public function update(Request $request, User $user){

        $rules = [
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'email' => 'required|email'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {

            $user->update($request->all());
            Session::flash('message', 'User has been updated');
            return redirect()->route('users.index');
        }
    }
    public function delete(User $user)
    {
        Session::flash('message','User has been deleted successful');
        $user->delete();
        return redirect()->route('users.index');
    }
}
