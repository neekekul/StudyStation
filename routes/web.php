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

Route::get('/instructorLogin', 'LoginController@onInstructorCreate');
Route::post('/instructorLogin','LoginController@instructorSession');

Route::get('/registration', 'RegisterController@create');
Route::post('/registration', 'RegisterController@store');

Route::get('/logout', 'LoginController@destroy');

Route::get('/home', 'HomeController@show');

Route::get('/lessonCreator', 'InstructorController@lessonCreate');
Route::post('/lessonCreator', 'InstructorController@lessonStore');

Route::get('/courseCreator', 'InstructorController@courseCreate');
Route::post('/courseCreator', 'InstructorController@courseStore');

Route::get('/editInstructor', 'InstructorController@editCreate');
Route::post('/editInstructor', 'InstructorController@editStore');

Route::get('/courseViewer', 'InstructorController@courseShow');
Route::get('/courseViewer/courseGuts', 'InstructorController@courseGuts');
Route::get('/studentCourseView','StudentCourseViewerController@getCourses');

Route::post('/courseViewer/courseGuts/lessonViewer', 'InstructorController@lessonShow');

Route::post('/studentHome/search','StudentCourseViewerController@instructorFind');

Auth::routes();
