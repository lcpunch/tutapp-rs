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
}
