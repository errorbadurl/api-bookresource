<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/login', function() { return View::make('auth.login'); })->name('login');
Route::get('/register', function() { return View::make('auth.register'); })->name('register');

Route::prefix('user')->group(function() {
    Route::get('/', 'UserController@showUser')->name('user.show');
    Route::post('/login', 'UserController@login')->name('user.login');
    Route::post('/register', 'UserController@register')->name('user.register');
    Route::get('/books', 'UserController@books')->name('user.books');
    Route::get('/books/history', 'BookController@history')->name('user.books.history');
    Route::patch('/books/restore/{book}', 'BookController@restore')->name('user.books.restore');
    Route::get('/{user}/books', 'UserController@showUserBooks')->name('user.books.show');
});

Route::apiResource('/books', 'BookController');
