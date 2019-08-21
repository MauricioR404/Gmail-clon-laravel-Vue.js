<?php


Route::view('/', 'welcome');
Route::post('messages', 'MessageController@store')->name('message.store');

Route::group([
    'namespace' => 'Admin',
    'middleware' => 'auth'
], 
function () {
    Route::view('messages', 'message')->name('messages');
    Route::get('messages/index', 'MessageController@index')->name('messages.index');
});

Route::auth();
