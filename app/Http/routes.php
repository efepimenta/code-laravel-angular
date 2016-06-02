<?php

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function () {
    Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);
    //Route::get('/client', ['middleware' => 'oauth', 'uses' => 'ClientController@index']);
    //Route::get('/client/{id}', 'ClientController@show');
    //Route::post('/client', 'ClientController@create');
    //Route::put('/client/{id}', 'ClientController@update');
    //Route::delete('/client/{id}', 'ClientController@delete');

    Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);

    Route::group(['prefix' => 'project'], function () {
        //Route::get('/project', 'ProjectController@index');
        //Route::get('/project/{id}', 'ProjectController@show');
        //Route::post('/project', 'ProjectController@create');
        //Route::put('/project/{id}', 'ProjectController@update');
        //Route::delete('/project/{id}', 'ProjectController@delete');

        Route::get('{project_id}/note', 'ProjectNoteController@index');
        Route::get('{project_id}/note/{note_id}', 'ProjectNoteController@show');
        Route::post('{project_id}/note', 'ProjectNoteController@create');
        Route::put('{project_id}/note/{note_id}', 'ProjectNoteController@update');
        Route::delete('{project_id}/note/{note_id}', 'ProjectNoteController@delete');
    });
});

Route::get('/project/{project_id}/task', 'ProjectTaskController@index');
Route::get('/project/{project_id}/task/{task_id}', 'ProjectTaskController@show');
Route::post('/project/{project_id}/task', 'ProjectTaskController@create');
Route::put('/project/{project_id}/task/{task_id}', 'ProjectTaskController@update');
Route::delete('/project/{project_id}/task/{task_id}', 'ProjectTaskController@delete');


Route::get('/project/{project_id}/members', 'ProjectMemberController@show');
Route::post('/project/{project_id}/members', 'ProjectController@addMember');
Route::delete('/project/{project_id}/members/{user_id}', 'ProjectController@removeMember');