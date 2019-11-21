<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware([])->group(function () {

	Route::prefix('albums')->group(function () {

	    Route::get('/', 'Api\AlbumController@index');

	    Route::get('latest', 'Api\AlbumController@latest');

	});

    Route::get('albums-listened', 'Api\AlbumListenController@index');

    Route::get('artists', function () {
        return \App\Artist::latest()->limit(25)->get()->toArray();
    });

    Route::get('listens', 'Api\ListenController@index');
});
