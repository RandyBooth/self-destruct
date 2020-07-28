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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('m')->group(
    function () {
        Route::get(
            'hidden',
            'MessageController@hidden'
        )->middleware('throttle:60,5')->name('message.hidden');

        Route::get(
            '{slug}@{slug_password}',
            'MessageController@show'
        )->middleware('throttle:60,5')->name('message.show');

        Route::post(
            '{slug}@{slug_password}',
            'MessageController@password'
        )->middleware('throttle:30,10')->name('message.password');
    }
);
