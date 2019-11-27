<?php

Auth::routes();

Route::middleware(['auth'])->group(function () {

	Route::get('/', 'AdminController@index')->name('home');

	Route::get('logout', 'Auth\LoginController@logout')->name('logout');

	Route::get('/{vue_capture?}', 'AdminController@index')->where('vue_capture', '[\/\w\.-]*');

});


