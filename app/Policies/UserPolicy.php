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
    public function update(User $user,User $selectedUser)
    {
        return $user->id === $selectedUser->id;
    }
    public function delete(User $user,User $selectedUser)
    {
        return false;
    }
    public function create(User $user,User $selectedUser)
    {
        return false;
    }

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
        return false;
    }
}
