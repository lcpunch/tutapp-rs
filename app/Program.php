<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['title', 'description'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function createRegister($data)
    {
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->save();
    }

    public function updateRegister($id, $data)
    {
        $program  = Program::find($id);
        $program->title = $data['title'];
        $program->description = $data['description'];
        $program->save();
    }

    public function deleteRegister($id)
    {
        $program = Program::findOrFail($id);
        if($program)
            $program->delete();
        else
            return response()->json(error);
        return response()->json(null);
    }

    public function returnRegister($id)
    {
        return Program::find($id);
    }

    public function returnAllRegisters()
    {
        return Program::all();
    }
}
