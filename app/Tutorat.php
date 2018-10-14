<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorat extends Model
{
    protected $fillable = ['student_id', 'tutor_id', 'id_calendar'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'course_tutor');
    }

    public function createRegister($data)
    {
        $this->dtexecution = $data['dtexecution'];
        $this->hrstart = $data['hrstart'];
        $this->hrfinish = $data['hrfinish'];
        $this->student_id = $data['student_id'];
        $this->tutor_id = $data['tutor_id'];

        $this->save();
    }
}
