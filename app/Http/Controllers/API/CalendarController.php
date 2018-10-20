<?php

namespace App\Http\Controllers\API;

use App\Calendar;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function store(Request $request, Calendar $calendar)
    {
        try{
            $calendar->createRegister($request);

            return response()->json(['message' => 'Calendar created successfully.']);

        }catch(Exception $e){

            return response()->json(['error' => 'error: '.$e]);

        }
    }

    public function update($id, Request $request, Calendar $calendar)
    {
        try {

            $calendar->updateRegister($id, $request);

        } catch (\Exception $e) {
            return response()->json(["error" => "Your data seems wrong: ".$e]);
        }

        return response()->json(["message" => "Calendar updated successfully."]);
    }

    public function delete($id, Calendar $calendar)
    {
        try {

            $calendar->deleteRegister($id);

        } catch (\Exception $e) {
            return response()->json(["error" => "Your data seems wrong: ".$e]);
        }

        return response()->json(["message" => "Calendar deleted successfully."]);
    }

    public function findAll(Calendar $calendar)
    {
        return $calendar->returnAllRegisters();
    }

    public function find($id, Calendar $calendar)
    {
        return $calendar->returnRegister($id);
    }

    public function listCalendarByUser($id, $id_student)
    {
        return Calendar::join('users', 'users.id', '=', 'calendars.user_id')
            ->where('users.id', '=', $id)
            ->whereNotIn('calendars.id', function($q) use ($id_student) {
                $q->select('id_calendar')
                    ->from('tutorats')
                    ->where('tutorats.student_id', '=', $id_student);
            })
            ->select(\DB::raw('(SELECT 1 
            FROM tutorats t 
            WHERE t.id_calendar=calendars.id) AS num_tutorats'), 'calendars.hrstart', 'calendars.dtavailability', 'calendars.user_id', 'calendars.id', 'calendars.hrfinish', 'users.name')
            ->getQuery()
            ->get();
    }

    public function listCalendarByTutor($id)
    {
        return Calendar::join('users', 'users.id', '=', 'calendars.user_id')
            ->where('users.id', '=', $id)
            ->select('calendars.hrstart', 'calendars.dtavailability', 'calendars.user_id', 'calendars.id', 'calendars.hrfinish', 'users.name')
            ->getQuery()
            ->get();
    }

    public function listHoursByDate($id, $date)
    {
        return Calendar::join('users', 'users.id', '=', 'calendars.user_id')
            ->where('users.id', '=', $id)
            ->where('calendars.dtavailability', '=', $date)
            ->whereNotIn('calendars.id', function($q){
                $q->select('id_calendar')->from('tutorats');
            })
            ->select('calendars.hrstart', 'calendars.dtavailability', 'calendars.user_id', 'calendars.id', 'calendars.hrfinish', 'users.name')
            ->getQuery()
            ->get();
    }
}
