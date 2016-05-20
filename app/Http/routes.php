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

Route::get('/project/{id}/notes', 'ProjectNoteController@index');
Route::get('/project/{id}/notes/{noteId}', 'ProjectNoteController@show');
Route::post('/project/{id}/notes', 'ProjectNoteController@create');
Route::put('/project/{id}/notes/{noteId}', 'ProjectNoteController@update');
Route::delete('/project/{id}/notes/{noteId}', 'ProjectNoteController@delete');

Route::get('/project', 'ProjectController@index');
Route::get('/project/{id}', 'ProjectController@show');
Route::post('/project', 'ProjectController@create');
Route::put('/project/{id}', 'ProjectController@update');
Route::delete('/project/{id}', 'ProjectController@delete');

