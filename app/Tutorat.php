<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorat extends Model
{
    protected $fillable = ['student_id', 'tutor_id', 'id_calendar', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'course_tutors');
    }

    public function createRegister($data)
    {
        $this->id_calendar = $data['id_calendar'];
        $this->student_id = $data['student_id'];
        $this->tutor_id = $data['tutor_id'];
        $this->status = $data['status'];

        $this->save();
    }

    public function updateStatus($id)
    {
        $tutorat  = Tutorat::find($id);
        $tutorat->status = 1;
        $tutorat->save();
    }
}
