<?php

namespace App\Http\Controllers\API;

use App\Course;
use App\Http\Controllers\Controller;
use App\Tutorat;
use Illuminate\Http\Request;

class TutoratController extends Controller
{
    public function store(Request $request, Tutorat $tutorat)
    {
        try{
            $tutorat->createRegister($request);

            return response()->json(['message' => 'success']);

        }catch(Exception $e){

            return response()->json(['error' => 'error: '.$e]);

        }
    }

    public function listTutorsByCourse($id)
    {
        return Course::join('course_tutor', 'course_tutor.course_id', '=', 'courses.id')
            ->join('users', 'users.id', '=', 'course_tutor.user_id')
            ->where('course_tutor.course_id', '=', $id)
            ->select('users.name', 'users.email', 'users.id')
            ->getQuery()
            ->get();
    }

    public function listTutoratsByStudent($id)
    {
        return Tutorat::where('tutorats.student_id', '=', $id)
            ->join('users', 'users.id', '=', 'tutorats.tutor_id')
            ->join('calendars', 'calendars.id', '=', 'tutorats.id_calendar')
            ->select('tutorats.id', 'calendars.dtavailability', 'calendars.hrstart', 'calendars.hrfinish', 'users.name')
            ->getQuery()
            ->get();
    }

    public function updateStatus($id, Tutorat $tutorat)
    {
        try{
            $tutorat->updateStatus($id);
            return response()->json(['message' => 'success']);
        }catch(Exception $e){
            return response()->json(['error' => 'error: '.$e]);
        }
    }
}
