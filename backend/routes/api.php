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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login','API\UserController@login');
Route::post('register','API\UserController@register');
Route::get('register/activate/{token}','API\UserController@activate');
Route::group(['middleware' => 'auth:api'],function(){
    Route::post('details','API\UserController@details');
});

/**
 * route for cards
 */
Route::
//middleware('auth:api')->
prefix('cards')->group(function(){
    Route::get('/','API\CardController@index');
    Route::get('/show/{id}','API\CardController@show');
    Route::post('/store','API\CardController@store');
    Route::put('/update','API\CardController@update');
    Route::delete('/destroy/{id}','API\CardController@destroy');
});

