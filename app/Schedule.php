<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['slug', 'time_in', 'time_out'];
    public function users()
    {
        return $this->belongsToMany('App\User', 'schedule_users', 'schedule_id', 'user_id');
    }
}
