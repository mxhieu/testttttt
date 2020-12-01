<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::get('/{name}', 'HomeController@mainScreen')->name('home.mainscreen')->where('name', 'home|dashboard|');
});

Route::group([
    'middleware' => ['auth'],
    'namespace' => 'Cfg',
    'prefix' => 'cfg',
    'as' => 'cfg.'
], function(){
    // Route::match(['get', 'post'], '/company', 'CfgCompanyController@index')->name('company');

    Route::get('/{resource}', 'ConfigController@index')->name('index');
    Route::post('/{resource}', 'ConfigController@store')->name('store');
    Route::put('/{resource}/{id}', 'ConfigController@update')->name('update');
    Route::delete('/{resource}/{id}', 'ConfigController@destroy')->name('destroy');
});


Route::group(['prefix' => 'admin/filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});