<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $fillable = ['dtavailability', 'hrstart', 'hrfinish', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createRegister($data)
    {
        $this->dtavailability = $data['dtavailability'];
        $this->hrstart = $data['hrstart'];
        $this->hrfinish = $data['hrfinish'];
        $this->user_id = $data['user_id'];
        $this->save();
    }

    public function updateRegister($id, $data)
    {
        $calendar = Calendar::find($id);
        $calendar->dtavailability = $data['dtavailability'];
        $calendar->hrstart = $data['hrstart'];
        $calendar->hrfinish = $data['hrfinish'];
        $calendar->user_id = $data['user_id'];
        $calendar->save();
    }

    public function deleteRegister($id)
    {
        $course = Calendar::findOrFail($id);
        if($course)
            $course->delete();
        else
            return response()->json(error);
        return response()->json(null);
    }

    public function returnRegister($id)
    {
        return Calendar::find($id);
    }

    public function returnAllRegisters()
    {
        return Calendar::all();
    }
}
