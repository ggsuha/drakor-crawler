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


Route::get('/', 'InputController@index');
Route::get('/{slug}', 'InputController@tes');

Route::get('post', 'UserController@store')->name('post');
Route::post('ckeditor/image_upload', 'InputController@upload')->name('upload');

