<?php
/*
|--------------------------------------------------------------------------
| Ajax Routes
|--------------------------------------------------------------------------
|
*/
Route::get( 'state-city', 'AjaxController@getStateCityToSelect' )->name( 'ajax.get.state-city' );
Route::get( 'set-active', 'AjaxController@setActive' )->name( 'ajax.set.active' );
Route::get( 'get-ajax-to-select2', 'AjaxController@ajaxSelect2' )->name('ajax.get-select2');
/*
|--------------------------------------------------------------------------
| PEDIDOS Routes
|--------------------------------------------------------------------------
|
*/
Route::namespace('Transactions')->middleware('auth')->prefix('transactions')->group( function () {

    Route::group( [ 'prefix' => 'requests' ], function () {

        Route::post('add-item/{request}', 'RequestController@addItem')->name('ajax.requests.add-item');
        Route::delete('rem-item/{request}', 'RequestController@removeItem')->name('ajax.requests.rem-item');
        Route::get('show-item/{item}', 'RequestController@showItem')->name('ajax.requests.show-item');
        Route::post('save-item', 'RequestController@saveItem')->name('ajax.requests.save-item');


        Route::post( 'confirm-item', 'RequestController@confirmItem' )->name('ajax.requests.confirm-item');

        Route::post( 'approve-item', 'RequestController@approveItem' )->name('ajax.requests.approve-item');

        Route::get( 'products-ajax-to-select2', 'ProductController@toSelect2' )->name('ajax.requests.products.get-select2');

    } );
});

/*
|--------------------------------------------------------------------------
| HumanResources Routes
|--------------------------------------------------------------------------
|
*/
Route::namespace('HumanResources')->middleware('auth')->prefix('human_resources')->group( function () {

    Route::group( [ 'prefix' => 'clients' ], function () {

        Route::get( 'clients-ajax-to-select2', 'VoterController@toSelect2' )->name('ajax.clients.get-select2');

    } );

    Route::post( 'read-notification/{id}', 'NotificationController@read' )->name( 'ajax.human_resources.notification.read' );
    Route::post( 'read-all-notification', 'NotificationController@readAll' )->name( 'ajax.human_resources.notification.read-all' );
});
