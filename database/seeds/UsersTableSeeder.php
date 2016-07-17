<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create();
        $roleUser = Role::where('name','User')->first();

        //adding to all users role User
        $users = User::all();
        foreach($users as $user){
            $user->roles()->attach($roleUser);
        }

        //create user with Admin role
        $roleAdmin = Role::where('name','Admin')->first();

        $user = new User();
        $user->lastname = 'Admin';
        $user->firstname = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('654321');
        $user->remember_token = str_random(10);
        $user->save();

        $user->roles()->attach($roleAdmin);

    }
}