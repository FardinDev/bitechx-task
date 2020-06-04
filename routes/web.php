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

Route::get('/', 'EntryController@index')->name('entry.index');
Route::post('/store', 'EntryController@store')->name('entry.store');
Route::get('/entry/{id}/edit', 'EntryController@edit')->name('entry.edit');
Route::post('/entry/{id}/edit', 'EntryController@update')->name('entry.update');
Route::delete('/entry/{id}/delete', 'EntryController@delete')->name('entry.delete');
