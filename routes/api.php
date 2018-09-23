<?php

use App\Program;
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

Route::group(['middleware' => 'auth:api'], function() {

    Route::post('details', 'API\UserController@details');

    // Program
    Route::delete('programs/{id}', 'API\ProgramController@delete');
    Route::get('programs', 'API\ProgramController@findAll');
    Route::get('programs/{id}', 'API\ProgramController@find');
    Route::post('programs/update', 'API\ProgramController@update');
    Route::post('programs/save', 'API\ProgramController@store');
});

