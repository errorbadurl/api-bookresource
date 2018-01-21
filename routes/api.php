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

Route::group(['prefix' => '/v1'], function () {
    Route::group(['prefix' => 'user', 'as' => 'user'], function() {
        Route::get('/', 'Api\v1\UserController@showUser')->name('.show');
        Route::post('/login', 'Api\v1\UserController@login')->name('.login');
        Route::post('/register', 'Api\v1\UserController@register')->name('.register');
        Route::get('/books', 'Api\v1\UserController@books')->name('.books');
        Route::get('/purchases', 'Api\v1\UserController@purchases')->name('.purchases');
    });
    Route::group(['prefix' => 'books', 'as' => 'books'], function() {
        Route::post('/{book}/purchase', 'Api\v1\PurchaseController@purchase')->name('.purchase');
    });
    Route::apiResource('books', 'Api\v1\BookController');
    Route::group(['prefix' => 'history', 'as' => 'history'], function() {
        Route::get('/', 'Api\v1\HistoryController@history');
        Route::get('/{history}', 'Api\v1\HistoryController@historyShow')->name('.show');
        Route::delete('/{history}/delete', 'Api\v1\HistoryController@forceDelete')->name('.delete');
        Route::match(['put', 'patch'], '/{history}/restore', 'Api\v1\HistoryController@restore')->name('.restore');
    });
    Route::get('/search', 'Api\v1\SearchController@bookSearch')->name('search');
});

// Route::group(['prefix' => 'v2'], function () {});
