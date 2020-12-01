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



// Route::group([
//     'prefix'    => 'hrm',
//     'as'        => 'hrm.',
//     'middleware' => ['auth']
// ], function() {

//     Route::get('employeedata', 'EmployeeController@employeeData')->name('employee.data');
//     Route::resource('employee', EmployeeController::class);

//     Route::get('departmentdata', 'DepartmentController@DepartMentData')->name('department.data');
//     Route::resource('department', DepartmentController::class);

//     Route::get('positiondata', 'PositionController@positionData')->name('position.data');
//     Route::resource('position', PositionController::class);

//     Route::get('employeegroupdata', 'EmployeeGroupController@employeeGroupData')->name('employeegroup.data');
//     Route::resource('employeegroup', EmployeeGroupController::class);

    
//     Route::group(['prefix' => 'groupdetail/{groupId}'] ,function(){
//         Route::get('', 'GroupDetailController@index')->name('groupdetail.index');
//         Route::post('', 'GroupDetailController@store')->name('groupdetail.store');
//         Route::get('groupdetaildata', 'GroupDetailController@groupDetailData')->name('groupdetail.data');
//         Route::post('update/{id}', 'GroupDetailController@update')->name('groupdetail.update');
//         Route::delete('delete/{id}', 'GroupDetailController@destroy')->name('groupdetail.delete');
//     });
// });
