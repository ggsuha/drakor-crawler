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
Route::get('/kdrama', 'InputController@kdramas')->name('front');
Route::get('/kdrama/page/{page}', 'InputController@kdramas');
Route::get('/kdrama/{slug}', 'InputController@kdrama');
Route::get('/ost/{slug}', 'InputController@ost');
Route::get('/ost/', 'InputController@osts');
Route::get('/ost/page/{page}', 'InputController@osts');


Auth::routes([
  'register' => false,
  'reset' => false,
  'verify' => false,
]);

Route::get('admin', function () {
    return redirect()->to('admin/dashboard');
});

Route::get('/admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/admin/login', 'Auth\LoginController@login')->name('login');

// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
//     Route::get('/', function() {
//         return redirect('/admin/dasboard');
//     });
//     Route::get('/dasboard', 'HomeController@index');
//     Route::get('/artikel', 'ArticleController@index');
//     Route::get('/artikel/baru', 'ArticleController@create');
//     Route::post('/artikel/store', 'ArticleController@store')->name('store');

//     Route::post('/image/upload', 'CkEditorController@upload')->name('upload');

//     Route::get('/logout', 'HomeController@logout')->name('out');
// });
