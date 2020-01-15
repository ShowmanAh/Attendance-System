<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','pin_code',
    ];
    public function schedules()
    {
        return $this->belongsToMany('App\Schedule', 'schedule_users', 'user_id', 'schedule_id');
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
    public function checkout()
    {
        return $this->hasMany(Chekout::class);
    }
    public function hour()
    {
        return $this->hasMany(Hour::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
