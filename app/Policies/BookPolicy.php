<?php

namespace App\Policies;

use App\Book;
use App\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function updateBook(User $user, Book $book)
    {
//        return Auth::user()->isAdmin();
        return $user->isAdmin();
    }

    public function createBook(User $user, Book $book)
    {
        return $user->isAdmin();
    }

    public function deleteBook(User $user, Book $book)
    {
        return $user->isAdmin();
    }

    public function refundBook(User $user, Book $book)
    {
        return $user->isAdmin();
    }

    public function assignBook(User $user, Book $book)
    {
        return $user->isAdmin();
    }

}
