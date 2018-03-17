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

use App\Instructor;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/studentLogin', function () {
    return view('studentLogin');
});

Route::get('/instructorLogin', function () {
    return view('instructorLogin');
});

Route::get('/registration', 'Auth\RegisterController@create');
Route::post('/registration', 'Auth\RegisterController@store');


Auth::routes();
