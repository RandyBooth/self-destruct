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

Route::get('/', 'NoteController@index')->name('home');
Route::post('/', 'NoteController@store')->name('note.store');

// Route::get('contact', fn() => 'coming soon');
// Route::get('privacy', fn() => 'coming soon');

Route::prefix('n')->group(
    function () {
        Route::get(
            'hidden',
            'NoteController@hidden'
        )->name('note.hidden');

        Route::get(
            '{slug}@{slug_password}',
            'NoteController@show'
        )->name('note.show');

        Route::post(
            '{slug}@{slug_password}',
            'NoteController@password'
        )->name('note.password');
    }
);

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
