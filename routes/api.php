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

Route::group(['prefix' => 'v1'], function () {
    Route::get('index', function () {
        return response('show test game', 200);
    });

// TODO: authentication https://laravel.com/docs/5.4/passport

    Route::post('game', 'Api\GameController@newGame')->name('newGame');
    Route::post('game/reveal', 'Api\GameController@revealCell')->name('revealCell');

});