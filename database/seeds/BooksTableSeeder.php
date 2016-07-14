<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * custom genres that will randomly add in books table
     */


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Book::class, 50)->create();
    }

}