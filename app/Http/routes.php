<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/client', 'ClientController@index');
Route::get('/client/{id}', 'ClientController@show');
Route::post('/client', 'ClientController@create');
Route::put('/client/{id}', 'ClientController@update');
Route::delete('/client/{id}', 'ClientController@delete');

Route::get('/project/{project_id}/note', 'ProjectNoteController@index');
Route::get('/project/{project_id}/note/{note_id}', 'ProjectNoteController@show');
Route::post('/project/{project_id}/note', 'ProjectNoteController@create');
Route::put('/project/{project_id}/note/{note_id}', 'ProjectNoteController@update');
Route::delete('/project/{project_id}/note/{note_id}', 'ProjectNoteController@delete');

Route::get('/project', 'ProjectController@index');
Route::get('/project/{id}', 'ProjectController@show');
Route::post('/project', 'ProjectController@create');
Route::put('/project/{id}', 'ProjectController@update');
Route::delete('/project/{id}', 'ProjectController@delete');