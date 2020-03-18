<?php

Route::group(['as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('logout', function() {
        Auth::logout();

        return redirect('/admin');
    })->name('out');
});
