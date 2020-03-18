<?php

Route::group(['as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::group(['prefix' => 'drama', 'as' => 'drama.'], function() {
        Route::get('/', 'DramaController@index')->name('index');
        Route::get('add', 'DramaController@add')->name('add');
    });


    Route::get('logout', function() {
        Auth::logout();

        return redirect('/admin');
    })->name('out');
});
