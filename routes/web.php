<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PagesController@index');

/*
Route::get('/hello', function () {
    // return view('welcome');
    return '<h1>Hello World!<h1>';
});

Route::get('/users/{id}/{name}', function ($id, $name) {
    return 'This is user '.$name.' with an id of '.$id;
});
*/

Route::get('/about', 'PagesController@about');

Route::get('/general-survey', 'PagesController@survey');

Route::resource('support', 'ContactRequestsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/surveys/create', 'SurveyController@create');
Route::post('/surveys', 'SurveyController@store');
Route::get('/surveys/{survey}/question/create', 'QuestionsController@create');
Route::get('/surveys/{survey}', 'SurveyController@show');

