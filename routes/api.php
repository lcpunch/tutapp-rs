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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::apiResource('programs', 'ProgramController');
Route::post('programs/{program}', 'ProgramController@show');
Route::post('programs/create', 'ProgramController@store');


Route::group(['middleware' => 'auth:api'], function() {
    Route::post('details', 'API\UserController@details');
});

