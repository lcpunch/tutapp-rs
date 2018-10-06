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
        $this->hrend = $data['hrfinish'];
        $this->user_id = $data['user_id'];
        $this->save();
    }
}
