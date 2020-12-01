<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1'], function(){
    Route::get('get-employee-by-department/{departmentId}', 'EmployeeController@getEmployeeByDepartment')->name('getemployeebydepartment');

    Route::get('get-employee-by-group/{groupId}', 'EmployeeController@getEmployeeByGroup')->name('getemployeebygroup');

    Route::get('task-none-project', 'TaskNoneProjectController@getTaskNoneProject')->name('gettasknoneproject');

    Route::get('task-in-week', 'TaskNoneProjectController@taskInWeek')->name('taskInWeek');

    Route::get('events', 'EventController@eventList')->name('eventlist');
});