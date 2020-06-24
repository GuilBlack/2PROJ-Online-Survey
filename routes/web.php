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

Route::get('/general-survey', 'SurveyController@show');

Route::resource('support', 'ContactRequestsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/surveys/create', 'SurveyController@create')->middleware('auth');
Route::get('/surveys/{survey}/delete', 'SurveyController@delete')->middleware('auth');
Route::post('/surveys', 'SurveyController@store')->middleware('auth');
Route::get('/surveys/{survey}/questions/create', 'QuestionsController@create')->middleware('auth');
Route::get('/surveys/{survey}', 'SurveyController@show');
Route::post('/surveys/{survey}/questions', 'QuestionsController@store')->middleware('auth');
Route::get('/surveys/{survey}/make-public', 'SurveyController@makeVisible')->middleware('auth');
Route::get('/surveys/{survey}/take-survey', 'SurveyController@takeSurvey');
Route::post('/surveys/{survey}/answers', 'AnswerController@store');
Route::get('/surveys/{survey}/make-private', 'SurveyController@makeVisiblePrivately');
Route::get('/analytics', 'SurveyController@showAnalytics');

Route::get('/questions/{question}/show', 'QuestionsController@show')->middleware('auth');
Route::post('/questions/{question}/edit', 'QuestionsController@edit')->middleware('auth');
Route::get('/questions/{question}/delete', 'QuestionsController@delete')->middleware('auth');

