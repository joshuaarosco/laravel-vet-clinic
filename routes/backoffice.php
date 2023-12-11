<?php


/**
 *
 * ------------------------------------
 * Backoffice Routes
 * ------------------------------------
 *
 */
Route::group(['middleware' => "backoffice.guest", 'as' => "auth." ], function(){
    Route::get('login',['as' => "login", 'uses' => "LoginController@login"]);
    Route::post('login',['uses' => "LoginController@authenticate"]);
    Route::get('register',['as' => "register", 'uses' => "RegisterController@register"]);
    Route::post('register',['uses' => "RegisterController@authenticate"]);
});

Route::group(['middleware' => ["backoffice.auth"]], function(){
    Route::get('logout',['as' => "logout",'uses' => "LoginController@logout"]);
    Route::get('/',['as' => "index",'uses' => "DashboardController@index"]);

    
    Route::group(['as' => "patients.", 'prefix' => "patients"], function(){
        Route::get('/',['as' => "index", 'middleware' => "backoffice.superUserOnly", 'uses' => "PatientsController@index"]);
        Route::get('create',['as' => "create", 'middleware' => "backoffice.superUserOnly", 'uses' => "PatientsController@create"]);
        Route::post('create',['middleware' => "backoffice.superUserOnly", 'uses' => "PatientsController@store"]);
        Route::get('view/{id}',['as' => "view",'uses' => "PatientsController@view"]);
        Route::get('edit/{id}',['as' => "edit",'uses' => "PatientsController@edit"]);
        Route::post('edit/{id}',['as' => "update",'uses' => "PatientsController@update"]);
    });

    Route::group(['as' => "pets.", 'prefix' => "pets"], function(){
        Route::get('{patient_id}/create',['as' => "create",'uses' => "PetsController@create"]);
        Route::post('{patient_id}/create',['uses' => "PetsController@store"]);
        Route::get('view/{pet_id}',['as' => "view",'uses' => "PetsController@view"]);
        Route::get('edit/{pet_id}',['as' => "edit",'uses' => "PetsController@edit"]);
        Route::post('edit/{pet_id}',['uses' => "PetsController@update"]);
    });

    Route::group(['as' => "services.", 'prefix' => "services"], function(){
        Route::get('/',['as' => "index", 'middleware' => "backoffice.superUserOnly", 'uses' => "ServicesController@index"]);
        Route::get('create',['as' => "create", 'middleware' => "backoffice.superUserOnly", 'uses' => "ServicesController@create"]);
        Route::post('create',['middleware' => "backoffice.superUserOnly", 'uses' => "ServicesController@store"]);
        Route::get('view/{id}',['as' => "view",'uses' => "ServicesController@view"]);
        Route::get('edit/{id}',['as' => "edit",'uses' => "ServicesController@edit"]);
        Route::post('edit/{id}',['as' => "update",'uses' => "ServicesController@update"]);
    });

    Route::group(['as' => "vets.", 'prefix' => "vets"], function(){
        Route::get('/',['as' => "index", 'middleware' => "backoffice.superUserOnly", 'uses' => "VetsController@index"]);
        Route::get('create',['as' => "create", 'middleware' => "backoffice.superUserOnly", 'uses' => "VetsController@create"]);
        Route::post('create',['uses' => "VetsController@store"]);
        Route::get('view/{id}',['as' => "view",'uses' => "VetsController@view"]);
        Route::get('edit/{id}',['as' => "edit",'uses' => "VetsController@edit"]);
        Route::post('edit/{id}',['as' => "update",'uses' => "VetsController@update"]);
    });

    Route::group(['as' => "records.", 'prefix' => "records"], function(){
        Route::get('/',['as' => "index"/**, 'middleware' => "backoffice.superUserOnly" */, 'uses' => "RecordsController@index"]);
        Route::get('create',['as' => "create"/**, 'middleware' => "backoffice.superUserOnly" */, 'uses' => "RecordsController@create"]);
        Route::post('create',['uses' => "RecordsController@store"]);
        Route::post('pets',['as' => "pets", 'uses' => "RecordsController@pets"]);
        Route::get('view/{id}',['as' => "view",'uses' => "RecordsController@view"]);
        Route::get('edit/{id}',['as' => "edit",'uses' => "RecordsController@edit"]);
        Route::post('edit/{id}',['as' => "update",'uses' => "RecordsController@update"]);

        Route::get('{record_id}/add-service',['as' => "add_service",'uses' => "RecordsController@addService"]);
        Route::post('{record_id}/add-service',['uses' => "RecordsController@saveService"]);
        Route::get('view-service/{id}',['as' => "view_service",'uses' => "RecordsController@viewService"]);
        Route::get('edit-service/{id}',['as' => "edit_service",'uses' => "RecordsController@editService"]);
        Route::post('edit-service/{id}',['uses' => "RecordsController@updateService"]);

        Route::get('transaction-history/{id}',['as' => "transaction_history",'uses' => "RecordsController@transactionHistory"]);
        
        Route::get('{availed_service_id}/add-item',['as' => "add_item",'uses' => "RecordsController@addItem"]);
        Route::post('{availed_service_id}/add-item',['uses' => "RecordsController@saveItem"]);
        Route::any('delete-item/{id}',['as' => "delete_item",'uses' => "RecordsController@deleteItem"]);

        Route::get('invoice/{id}',['as' => "invoice",'uses' => "RecordsController@invoice"]);
        Route::get('view-invoice/{invoiceId}',['as' => "view_invoice",'uses' => "RecordsController@viewInvoice"]);
        
        Route::get('xendit-payment/{id}',['as' => "xendit_payment",'uses' => "XenditController@checkout"]);
        Route::get('xendit-payment-success',['as' => "xendit_payment_success",'uses' => "XenditController@success"]);
        Route::get('xendit-payment-failed',['as' => "xendit_payment_failed",'uses' => "XenditController@failed"]);

        Route::get('cash/{id}',['as' => "cash_payment",'uses' => "RecordsController@cashPayment"]);
    });

    Route::group(['as' => "inventory.", 'middleware' => "backoffice.superUserOnly", 'prefix' => "inventory"], function(){
        Route::get('/',['as' => "index", 'uses' => "InventoryController@index"]);
        Route::get('create',['as' => "create", 'uses' => "InventoryController@create"]);
        Route::post('create',['uses' => "InventoryController@store"]);
        Route::get('view/{id}',['as' => "view",'uses' => "InventoryController@view"]);
        Route::get('edit/{id}',['as' => "edit",'uses' => "InventoryController@edit"]);
        Route::post('edit/{id}',['as' => "update",'uses' => "InventoryController@update"]);
    });

    Route::group(['as' => "appointments.", 'prefix' => "appointments"], function(){
        Route::get('/',['as' => "index", 'uses' => "AppointmentsController@index"]);
        Route::get('create',['as' => "create", 'uses' => "AppointmentsController@create"]);
        Route::post('create',['uses' => "AppointmentsController@store"]);
        Route::get('delete/{id}',['as' => "delete",'uses' => "AppointmentsController@delete"]);
        Route::get('view/{id}',['as' => "view",'uses' => "AppointmentsController@view"]);
        Route::get('edit/{id}',['as' => "edit",'uses' => "AppointmentsController@edit"]);
        Route::post('edit/{id}',['as' => "update",'uses' => "AppointmentsController@update"]);
    });

    Route::group(['as' => "account.", 'prefix' => "account"], function(){
        Route::get('/',['as' => "index", 'uses' => "AccountController@index"]);
        Route::post('/',['as' => "save", 'uses' => "AccountController@save"]);
        Route::post('update-password',['as' => "update_password", 'uses' => "AccountController@updatePassword"]);
    });

});
