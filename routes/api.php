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

// Route::get('/mail', 'MailController@send')->name('mail.send');
// Route::get('/test', function() { return View::make('mail.bookpurchase'); });

Route::get('/login', function() { return View::make('auth.login'); })->name('login');
Route::get('/register', function() { return View::make('auth.register'); })->name('register');

Route::group(['prefix' => '/v1'], function () {
    Route::prefix('user')->group(function() {
        Route::get('/', 'Api\v1\UserController@showUser')->name('user.show');
        Route::post('/login', 'Api\v1\UserController@login')->name('user.login');
        Route::post('/register', 'Api\v1\UserController@register')->name('user.register');
        Route::get('/books', 'Api\v1\UserController@books')->name('user.books');
        Route::get('/purchases', 'Api\v1\UserController@purchases')->name('user.purchases');
    });
    Route::get('/books/search', 'Api\v1\BookController@search')->name('books.search');
    Route::get('/books/history', 'Api\v1\BookController@history')->name('books.history');
    Route::get('/books/history/{book}', 'Api\v1\BookController@history_show')->name('books.history.show');
    Route::match(['put', 'patch'], '/books/history/{book}/restore', 'Api\v1\BookController@restore')->name('books.history.restore');
    Route::post('/books/{book}/purchase', 'Api\v1\BookController@purchase')->name('books.purchase');
    Route::apiResource('/books', 'Api\v1\BookController');
});

// Route::group(['prefix' => 'v2'], function () {});
