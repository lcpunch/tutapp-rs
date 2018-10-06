<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorat extends Model
{
    protected $fillable = ['user_id', 'hrstart', 'hrfinish', 'dtexecution'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'course_tutor');
    }

    public function createRegister($data)
    {
        $this->dtavailability = $data['dtexecution'];
        $this->hrstart = $data['hrstart'];
        $this->hrend = $data['hrfinish'];
        $this->user_id = $data['user_id'];
        $this->save();

        $this->users()->attach($this->tutorat_id);
    }
}
