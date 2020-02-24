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


Route::get('/', function() {
    return redirect('/kdrama');
});
Route::get('/kdrama', 'InputController@index');
Route::get('/kdrama/page/{page}', 'InputController@index');
Route::get('/kdrama/{slug}', 'InputController@tes');
Route::get('/ost/{slug}', 'InputController@ost');
Route::get('/ost/', 'InputController@ostIndex');
Route::get('/ost/page/{page}', 'InputController@ostindex');

