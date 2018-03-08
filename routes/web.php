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

Route::get('/studentLogin', function () {
    return view('studentLogin');
});

Route::get('/instructorLogin', function () {
    return view('instructorLogin');
});

Route::get('/registration', function () {
    return view('registration');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
