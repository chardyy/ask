<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as'=>'home', 'uses'=>'QuestionsController@index']);
Route::get('question/{id}', ['as' => 'question', 'uses' => 'QuestionsController@view']);
Route::get('your-questions', ['as'=>'your-questions',
                              'uses'=>'QuestionsController@get_your_questions']);

Route::get('results/{id}', ['uses'=>'QuestionsController@getResults']);

Route::resource('register', 'UsersController');
Route::post('register', ['before' => 'csrf', 'uses' => 'UsersController@create']);
Route::get('login', ['as' => 'login', 'uses' => 'UsersController@getLogin']);
Route::post('login', ['before' => 'csrf', 'uses' => 'UsersController@postLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'UsersController@getLogout']);
Route::post('ask', ['as' => 'ask', 'uses' => 'QuestionsController@create']);
Route::post('search', ['as'=>'search', 'before'=>'csrf',
                            'uses'=>'QuestionsController@postSearch']);

Route::resource('questions', 'QuestionsController');
Route::resource('answers', 'AnswersController');