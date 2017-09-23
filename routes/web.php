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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// game routes
Route::get('/advance', 'DatesController@create');
Route::get('/history', 'GamesController@show');

// card routes
Route::get('/create', 'CardsController@create');
Route::post('/create', 'CardsController@store');

// fight routes
Route::get('/fight/{fight}/{a}/{b}', 'FightsController@update');

// boxer routes
Route::get('/freeagents', 'FreeAgentsController@index');
Route::get('/boxers', 'BoxersController@index');
Route::get('/boxers/{boxer}', 'BoxersController@show');
Route::post('/boxers/{boxer}/cut', 'BoxersController@destroy');
Route::post('/{game}/boxers/sign/{boxer}', 'BoxersController@store');

Route::get('/api/boxers/free', 'Api\BoxersController@free');
Route::get('/api/boxers/user', 'Api\BoxersController@users');
Route::post('/api/boxers/upgrade/{boxer}', 'Api\BoxersController@update');

// rankings routes
Route::get('/rankings', 'RankingsController@index');