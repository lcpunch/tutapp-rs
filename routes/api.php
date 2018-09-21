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

Route::get('programs', function() {
   return Program::all();
});

Route::get('programs/{id}', function($id) {
    return Program::find($id);
});


Route::group(['middleware' => 'auth:api'], function() {
    Route::post('details', 'API\UserController@details');
});

