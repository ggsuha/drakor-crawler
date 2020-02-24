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
Route::get('/kdrama', 'InputController@kdramas');
Route::get('/kdrama/page/{page}', 'InputController@kdramas');
Route::get('/kdrama/{slug}', 'InputController@kdrama');
Route::get('/ost/{slug}', 'InputController@ost');
Route::get('/ost/', 'InputController@osts');
Route::get('/ost/page/{page}', 'InputController@osts');

