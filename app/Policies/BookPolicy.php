<?php

namespace App\Policies;

use App\Book;
use App\User;
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

    public function updateBook(User $user)
    {
        return $user->isAdmin();
    }

    public function createBook(User $user)
    {
        return $user->isAdmin();
    }

    public function deleteBook(User $user)
    {
        return $user->isAdmin();
    }

    public function refundBook(User $user)
    {
        return $user->isAdmin();
    }

    public function assignBook(User $user)
    {
        return $user->isAdmin();
    }

}
