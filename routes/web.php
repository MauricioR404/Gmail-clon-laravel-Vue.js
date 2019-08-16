<?php

Route::get('/', function () {
    return view('welcome');
});

Route::post('message', 'MessageController@store')->name('message.store');



