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
    Route::post('programs/update/{id}', 'API\ProgramController@update');
    Route::post('programs/save', 'API\ProgramController@store');

    // Course
    Route::post('courses/save', 'API\CourseController@store');
    Route::post('courses/update/{id}', 'API\CourseController@update');
    Route::delete('courses/{id}', 'API\CourseController@delete');
    Route::get('courses', 'API\CourseController@findAll');
    Route::get('courses/{id}', 'API\CourseController@find');

    //Tutorat
    Route::post('tutorat/save', 'API\TutoratController@store');

    // Calendar
    Route::post('calendar/save', 'API\CalendarController@store');
    Route::post('calendar/update/{id}', 'API\CalendarController@update');
    Route::delete('calendar/{id}', 'API\CalendarController@delete');
    Route::get('calendar', 'API\CalendarController@findAll');
    Route::get('calendar/{id}', 'API\CalendarController@find');

});

