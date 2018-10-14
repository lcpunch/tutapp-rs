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

    public function listCalendarByUser($id)
    {
        return Calendar::join('users', 'users.id', '=', 'calendars.user_id')
            ->where('users.id', '=', $id)
            ->select('calendars.dtavailability', 'calendars.id', 'calendars.user_id')
            ->getQuery()
            ->get();
    }

    public function listHoursByDate($id, $date)
    {
        return Calendar::join('users', 'users.id', '=', 'calendars.user_id')
            ->where('users.id', '=', $id)
            ->where('calendars.dtavailability', '=', $date)
            ->select('calendars.hrstart', 'calendars.id', 'calendars.hrfinish', 'users.name')
            ->getQuery()
            ->get();
    }
}
