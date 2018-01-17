<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mail', function(){
    Mail::send(['text' => 'mail'], ['name' => 'Assassin'], function ($message) {
      $message->to('scambert666@yahoo.com', 'Assassiner')->subject('Welcome!');
      $message->from('blacqueous@gmail.com', 'from me');
    });
});