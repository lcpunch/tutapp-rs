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
}
