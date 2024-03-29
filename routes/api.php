<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['prefix' => 'prospect'], function() {
    Route::post('/create', 'ProspectController@create');
    Route::post('/update', 'ProspectController@update');
});

Route::group(['prefix' => 'order'], function() {
    Route::post('/create', 'OrderController@create');
    Route::post('/update', 'OrderController@update');
    Route::post('/view', 'OrderController@view');
});

Route::group(['prefix' => 'upsell'], function() {
    Route::post('/create', 'UpsellController@create');
});

Route::group(['prefix' => 'shipping'], function() {
    Route::get('/get', 'ShippingController@get');
});
