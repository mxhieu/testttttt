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

Route::group(['prefix' => 'event', 'as' => 'event.'], function(){
    Route::get('eventdata', 'EventController@datatable')->name('event.data');
    Route::get('calendar', 'EventController@calendar')->name('event.calendar');
    Route::post('update-calendar', 'EventController@updateCalendar')->name('event.update_calendar');
    Route::resource('event', EventController::class);
});
