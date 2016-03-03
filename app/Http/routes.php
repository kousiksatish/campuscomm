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

Route::post('/register', 'UsersController@store');
Route::post('/send', 'MessagesController@send');
Route::post('/fetchNew', 'MessagesController@fetchNew');
Route::post('/fetchOld', 'MessagesController@fetchOld');
Route::post('/latestID', 'MessagesController@latestID');
