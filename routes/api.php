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

// Route::group(['middleware' => 'auth:api'], function() {

    Route::post('details/{id}', 'API\UserController@details');

    // Program
    Route::delete('programs/{id}', 'API\ProgramController@delete');
    Route::get('programs', 'API\ProgramController@findAll');
    Route::get('programs/{id}', 'API\ProgramController@find');
    Route::post('programs/update/{id}', 'API\ProgramController@update');
    Route::post('programs/save', 'API\ProgramController@store');

    Route::get('userprograms/{id}', 'API\ProgramController@listProgramByUser');
    Route::get('programs/{id}/courses', 'API\ProgramController@listCoursesByProgram');

    // Course
    Route::post('courses/save', 'API\CourseController@store');
    Route::post('courses/update/{id}', 'API\CourseController@update');
    Route::delete('courses/{id}', 'API\CourseController@delete');
    Route::get('courses/c', 'API\CourseController@findAll');
    Route::get('courses/{id}', 'API\CourseController@find');

    //Tutorat
    Route::post('tutorat/save', 'API\TutoratController@store');
    Route::get('courses/{id}/tutors', 'API\TutoratController@listTutorsByCourse');
    Route::get('tutorat/student/{id}', 'API\TutoratController@listTutoratsByStudent');
    Route::post('tutorat/status/{id}', 'API\TutoratController@updateStatus');
    Route::get('tutorat/{id}/{date}', 'API\TutoratController@listAllTutoratsByTutor');

    Route::post('tutorat/addtutor/{course}/{tutor}', 'API\TutoratController@addTutor');


    // Calendar
    Route::post('calendar/save', 'API\CalendarController@store');
    Route::post('calendar/update/{id}', 'API\CalendarController@update');
    Route::delete('calendar/{id}', 'API\CalendarController@delete');
    Route::get('calendar', 'API\CalendarController@findAll');
    Route::get('calendar/{id}', 'API\CalendarController@find');
    Route::get('calendar/{id}/tutor/{id_student}', 'API\CalendarController@listCalendarByUser');
    Route::get('calendar/{id}/tutor', 'API\CalendarController@listCalendarByTutor');
    Route::get('calendar/{id}/tutor/{date}', 'API\CalendarController@listHoursByDate');

    Route::get('users', 'API\UserController@findAll');
    Route::get('users/{id}', 'API\UserController@find');
    Route::post('users/update/{id}', 'API\UserController@update');
    Route::post('users/save', 'API\UserController@store');
    Route::delete('users/{id}', 'API\UserController@delete');
    Route::post('users/import', 'API\UserController@import');
    // Email
    Route::post('/send', 'EmailController@send');
// });
