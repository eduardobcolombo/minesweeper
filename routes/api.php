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
        return response('show test game', 200)
            ->header('Content-Type', 'json/application');
    });

    Route::post('game', function () {
        return response()->json([
            'username' => 'eduardo',
            'game_id' => '9921',
            'status' => 'playing',
            'rows' => '10',
            'cols' => '10',
            'mines' => '3',
            'board' => '',
        ], 201)
            ->header('Content-Type', 'json/application');
    });

});