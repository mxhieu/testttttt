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

Route::group(['prefix' => 'tms', 'as' => 'tms.'], function(){
    Route::group(['prefix' => 'task-none-project'], function(){
        Route::get('tasknoneprojectdata', 'TaskNoneProjectController@taskNoneProjectData')->name('tasknoneproject.data');
        Route::get('home', 'TaskNoneProjectController@home')->name('tasknoneproject.home');
        Route::match(['post', 'get'], 'process/{id}', 'TaskNoneProjectController@taskNoneProjectProcess')->name('tasknoneproject.process');
        Route::get('kanban', 'TaskNoneProjectController@kanban')->name('tasknoneproject.kanban');
        Route::post('update-kanban', 'TaskNoneProjectController@updateKanban')->name('tasknoneproject.updatekanban');
        Route::get('gantt-chart', 'TaskNoneProjectController@ganttChart')->name('tasknoneproject.ganttchart');
        Route::resource('tasknoneproject', TaskNoneProjectController::class);
    });
});