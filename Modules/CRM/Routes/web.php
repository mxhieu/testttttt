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

Route::group([
    'prefix'    => 'crm',
    'as'        => 'crm.',
    'middleware' => ['auth']
], function() {
	Route::prefix('config')->group(function() {
		Route::get('/{resource}', 'ConfigController@index')->name('config.index');
		Route::post('/{resource}', 'ConfigController@store')->name('config.store');
        Route::get('/{resource}/{id}/edit', 'ConfigController@edit')->name('config.edit');
		Route::put('/{resource}/{id}', 'ConfigController@update')->name('config.update');
        Route::delete('/{resource}/{id}', 'ConfigController@destroy')->name('config.destroy');
	});

	Route::resource('/customers', 'CustomerController');

    Route::prefix('activities')->group(function() {
        Route::get('/', 'ActivityController@index')->name('activities.index');
        Route::get('/create/{customer}', 'ActivityController@create')->name('activities.create');
        Route::get('/{id}/edit', 'ActivityController@edit')->name('activities.edit');
        Route::post('/{customer}', 'ActivityController@store')->name('activities.store');
        Route::put('/{id}', 'ActivityController@update')->name('activities.update');
        Route::delete('/{id}', 'ActivityController@destroy')->name('activities.destroy');
        Route::get('/grantt', 'ActivityController@grantt')->name('activities.grantt');
        Route::get('/grantt-data', 'ActivityController@granttData')->name('activities.grantt-data');
    });

    Route::prefix('contacts')->group(function() {
        Route::get('/', 'ContactController@index')->name('contacts.index');
        Route::get('/create/{customer}', 'ContactController@create')->name('contacts.create');
        Route::get('/{id}/edit', 'ContactController@edit')->name('contacts.edit');
        Route::post('/{customer}', 'ContactController@store')->name('contacts.store');
        Route::put('/{id}', 'ContactController@update')->name('contacts.update');
        Route::delete('/{id}', 'ContactController@destroy')->name('contacts.destroy');
    });

    Route::resource('/products', 'ProductController');
    Route::resource('/sales', 'SaleController');
    Route::post('/sales/store-detail', 'SaleController@storeDetail')->name('sales.store.detail');
    Route::get('/sales/invoice/{id}', 'SaleController@invoice')->name('sales.invoice');

    Route::get('/payments/datatable/{saleId}', 'PaymentController@datatable')->name('payments.datatable');
    Route::delete('/payments/delete/{id}', 'PaymentController@delete')->name('payments.delete');
    Route::resource('/payments', 'PaymentController');

    Route::get('/deliveries/datatable/{saleId}', 'DeliveryController@datatable')->name('deliveries.datatable');
    Route::delete('/deliveries/delete/{id}', 'DeliveryController@delete')->name('deliveries.delete');
    Route::resource('/deliveries', 'DeliveryController');

    Route::get('/feedback/datatable/{saleId}', 'FeedbackController@datatable')->name('feedback.datatable');
    Route::delete('/feedback/delete/{id}', 'FeedbackController@delete')->name('feedback.delete');
    Route::resource('/feedback', 'FeedbackController');

    Route::resource('/marketing', 'MarketingController');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
});
