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

Route::group(['prefix' => 'kpi', 'as' => 'kpi.'], function(){

    Route::get('category-datatables', 'KpiCategoryController@datatables')->name('category.datatables');
    Route::resource('category', KpiCategoryController::class);

    Route::get('group-datatables', 'KpiGroupController@datatables')->name('group.datatables');
    Route::resource('group', KpiGroupController::class);

    Route::get('form-datatables', 'KpiFormController@datatables')->name('form.datatables');
    Route::resource('form', KpiFormController::class);

    Route::get('periodsdata', 'KPIPeriodsController@datatable')->name('periods.datatables');
    Route::resource('periods', KPIPeriodsController::class);
});
