<?php

Route::get('/', function () {
    return view('app');
});

Route::post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function () {
    Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);

    Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);

    Route::group(['prefix' => 'project'], function () {
        
        Route::get('{project_id}/note', 'ProjectNoteController@index');
        Route::get('{project_id}/note/{note_id}', 'ProjectNoteController@show');
        Route::post('{project_id}/note', 'ProjectNoteController@create');
        Route::put('{project_id}/note/{note_id}', 'ProjectNoteController@update');
        Route::delete('{project_id}/note/{note_id}', 'ProjectNoteController@delete');

        Route::get('{project_id}/members', 'ProjectMemberController@show');
        Route::post('{project_id}/members', 'ProjectController@addMember');
        Route::delete('{project_id}/members/{user_id}', 'ProjectController@removeMember');

        Route::get('{project_id}/task', 'ProjectTaskController@index');
        Route::get('{project_id}/task/{task_id}', 'ProjectTaskController@show');
        Route::post('{project_id}/task', 'ProjectTaskController@create');
        Route::put('{project_id}/task/{task_id}', 'ProjectTaskController@update');
        Route::delete('{project_id}/task/{task_id}', 'ProjectTaskController@delete');

        Route::get('{project_id}/files', 'ProjectFileController@index');
        Route::get('{project_id}/file/{fileId}', 'ProjectFileController@show');
        Route::get('file/{fileId}/download', 'ProjectFileController@download');
        Route::post('{project_id}/file', 'ProjectFileController@store');
        Route::put('{project_id}/file/{fileId}', 'ProjectFileController@update');
        Route::delete('{project_id}/file/{fileId}', 'ProjectFileController@destroy');
    });

    Route::get('user/authenticated', 'UserController@authenticated');
});