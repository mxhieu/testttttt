<?php


Route::group([
    'prefix'    => 'config',
    'as'        => 'config.',
    'middleware' => ['auth']
], function() {
    Route::get('/{resource}', 'ConfigController@index')->name('index');
    Route::post('/{resource}', 'ConfigController@store')->name('store');
    Route::get('/{resource}/{id}/edit', 'ConfigController@edit')->name('edit');
    Route::put('/{resource}/{id}', 'ConfigController@update')->name('update');
    Route::delete('/{resource}/{id}', 'ConfigController@destroy')->name('destroy');

    Route::group(['prefix' => 'tms', 'namespace' => 'TMS'], function(){
        Route::get('taskgroupdata', 'TaskGroupController@taskGroupData')->name('taskgroup.data');

        Route::resource('taskgroup', TaskGroupController::class);

        Route::get('tasktypedata', 'TaskTypeController@TaskTypeData')->name('tasktype.data');

        Route::resource('tasktype', TaskTypeController::class);

        Route::get('taskprioritydata', 'TaskPriorityController@TaskPriorityData')->name('taskpriority.data');

        Route::resource('taskpriority', TaskPriorityController::class);

        Route::get('taskstatusdata', 'TaskStatusController@TaskStatusData')->name('taskstatus.data');

        Route::resource('taskstatus', TaskStatusController::class);

        Route::get('taskcategorydata', 'TaskCategoryController@taskCategoryData')->name('taskcategory.data');

        Route::resource('taskcategory', TaskCategoryController::class);

        Route::get('taskphrasedata', 'TaskPhraseController@taskPhraseData')->name('taskphrase.data');

        Route::resource('taskphrase', TaskPhraseController::class);
    });

    Route::group(['prefix' => 'company'], function(){
        Route::match(['get', 'post'],'/index', 'CompanyController@index')->name('company.index');
    });

    Route::group(['prefix' => 'hrm', 'namespace' => 'HRM'], function(){
        Route::get('employeedata', 'EmployeeController@employeeData')->name('employee.data');
        Route::resource('employee', EmployeeController::class);
    
        Route::get('departmentdata', 'DepartmentController@DepartMentData')->name('department.data');
        Route::resource('department', DepartmentController::class);
    
        Route::get('positiondata', 'PositionController@positionData')->name('position.data');
        Route::resource('position', PositionController::class);
    
        Route::get('employeegroupdata', 'EmployeeGroupController@employeeGroupData')->name('employeegroup.data');
        Route::get('employeegroup/user/{id}', 'EmployeeGroupController@getUser')->name('employeegroup.user');
        Route::resource('employeegroup', EmployeeGroupController::class);

        
        Route::group(['prefix' => 'groupdetail/{groupId}'] ,function(){
            Route::get('', 'GroupDetailController@index')->name('groupdetail.index');
            Route::post('', 'GroupDetailController@store')->name('groupdetail.store');
            Route::get('groupdetaildata', 'GroupDetailController@groupDetailData')->name('groupdetail.data');
            Route::post('update/{id}', 'GroupDetailController@update')->name('groupdetail.update');
            Route::delete('delete/{id}', 'GroupDetailController@destroy')->name('groupdetail.delete');
        });
    });

    Route::group(['prefix' => 'status', 'namespace' => 'Status'], function(){
        Route::get('statusdata', 'StatusController@statusData')->name('status.data');

        Route::resource('status', StatusController::class);

        Route::get('approvedata', 'ApproveController@approveData')->name('approve.data');

        Route::resource('approve', ApproveController::class);

    });

    Route::group(['prefix' => 'event', 'namespace' => 'EVENT'], function(){
        Route::get('eventgroupdata', 'EventGroupController@eventGroupData')->name('eventgroup.data');

        Route::resource('eventgroup', EventGroupController::class);

        Route::get('eventtypedata', 'EventTypeController@EventTypeData')->name('eventtype.data');

        Route::resource('eventtype', EventTypeController::class);

        Route::get('eventprioritydata', 'EventPriorityController@EventPriorityData')->name('eventpriority.data');

        Route::resource('eventpriority', EventPriorityController::class);

        Route::get('eventcategorydata', 'EventCategoryController@eventCategoryData')->name('eventcategory.data');

        Route::resource('eventcategory', EventCategoryController::class);
    });

});
