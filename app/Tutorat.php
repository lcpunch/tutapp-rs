<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorat extends Model
{
    protected $fillable = ['user_id', 'hrstart', 'hrfinish', 'dtexecution'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
