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
            'game_id' => '3',
            'status' => 'playing',
            'rows' => '3',
            'cols' => '3',
            'bombs' => '1',
            'revealed'=> 'H,H,H,H,H,H,H,H,H'
        ], 201)
            ->header('Content-Type', 'json/application');
    });

});