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

Route::group( [ 'prefix' => 'teste' ], function () {
    Route::get('teste-email', function () {
        $mensagem = 'olá leonardo';
        Mail::raw($mensagem, function ($message) {
            $message->to('silva.zanin@gmail.com', 'Leonardo')->subject('Contato Pelo Site!');
        });
    })->name('send-contact');
} );



Route::get('/', 'HomeController@index')->name('index');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
*/
Auth::routes();


/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
|
*/
Route::group( [ 'namespace' => 'HumanResources','prefix' => 'human_resources', 'middleware' => 'auth' ], function () {

    Route::resource( 'users', 'UserController' );
    Route::get( 'my-profile', 'UserController@profile' )->name( 'profile.my' );
    Route::post( 'password-change', 'UserController@updatePassword' )->name( 'change.password' );

    Route::resource( 'voters', 'VoterController' );
    Route::resource( 'notifications', 'NotificationController' );

    Route::group( [ 'namespace' => 'Settings','prefix' => 'settings' ], function () {

        Route::resource( 'groups', 'GroupController' );

    } );

} );
