<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function deleteRegister($id)
    {
        $course = Course::findOrFail($id);
        if($course)
            $course->delete();
        else
            return response()->json(error);
        return response()->json(null);
    }

    public function returnRegister($id)
    {
        return Course::find($id);
    }

    public function returnAllRegisters($id)
    {
        return Course::all();
    }
}
