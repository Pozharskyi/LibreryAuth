<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract,  AuthorizableContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    public $table = 'users';

    public $timestamps = false;

    public $guarded = ['id'];

    protected $hidden = [
        'remember_token', 'password'
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function path()
    {
        return route('users.show', ['user' => $this->id]);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
    }
}
