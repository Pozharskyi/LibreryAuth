<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = new Role();
        $roleAdmin->name = 'Admin';
        $roleAdmin->description = 'Admin could make all actions';
        $roleAdmin->save();

        $roleUser = new Role();
        $roleUser->name = 'User';
        $roleUser->description = 'User could edit only his profile';
        $roleUser->save();
    }
}