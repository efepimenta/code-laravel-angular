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

Route::get('/client', 'ClientController@index');
Route::get('/client/{id}', 'ClientController@show');
Route::post('/client', 'ClientController@create');
Route::put('/client/{id}', 'ClientController@update');
Route::delete('/client/{id}', 'ClientController@delete');

Route::get('/project', 'ProjectController@index');
Route::get('/project/{id}', 'ProjectController@show');
Route::post('/project', 'ProjectController@create');
Route::put('/project/{id}', 'ProjectController@update');
Route::delete('/project/{id}', 'ProjectController@delete');

Route::get('/notes', 'ProjectNoteController@index');
Route::get('/notes/{id}', 'ProjectNoteController@show');
Route::post('/notes', 'ProjectNoteController@create');
Route::put('/notes/{id}', 'ProjectNoteController@update');
Route::delete('/notes/{id}', 'ProjectNoteController@delete');