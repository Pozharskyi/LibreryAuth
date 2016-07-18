<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create User policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
//    public function update(User $user)
//    {
//        return \Auth::id() === $user->id;
//    }

//    public function before(User $user)
//    {
//        if ($user->isSuperAdmin()) {
//            return true;
//        }
//    }
}
