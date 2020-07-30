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

Route::get('/', 'MessageController@index')->name('home');
Route::post('/', 'MessageController@store')->name('message.store');

Route::get('privacy', fn() => 'coming soon');

Route::prefix('m')->group(
    function () {
        Route::get(
            'hidden',
            'MessageController@hidden'
        )->name('message.hidden');

        Route::get(
            '{slug}@{slug_password}',
            'MessageController@show'
        )->name('message.show');

        Route::post(
            '{slug}@{slug_password}',
            'MessageController@password'
        )->name('message.password');
    }
);

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
