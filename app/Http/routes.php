<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
//books routes
Route::resource('books', 'BookController');
Route::post('books/{book}/assign','BookController@assignToUser')->name('books.assign');
Route::get('books/{book}/refund','BookController@refund')->name('books.refund');
//users routes
Route::group(['prefix' => 'users'], function(){
    Route::get('','UserController@index')->name('users.index');
    Route::get('create','UserController@create')->name('users.create');
    Route::get('{user}','UserController@show')->name('users.show');
    Route::post('','UserController@save')->name('users.save');
    Route::get('{user}/edit','UserController@edit')->name('users.edit');
    Route::put('{user}','UserController@update')->name('users.update');
    Route::delete('{user}','UserController@delete')->name('users.delete');
});
