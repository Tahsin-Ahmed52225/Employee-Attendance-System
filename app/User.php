<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'position', 'password', 'role', 'stage', 'number'
    ];

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
    /**
     * Function for checking Employee or not
     *
     */
    public function isEmployee()
    {
        if ($this->role == 'employee') {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Function for checking Admin or not
     *
     */
    public function isAdmin()
    {
        if ($this->role == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function Timer()
    {
        return $this->hasMany('App\Timer');
    }
    /**
     * Realtionship with Leave
     *
     * @var array
     */
    public function OfficeLeave()
    {
        return $this->hasMany('App\OfficeLeave');
    }
    /**
     * Realtionship with Office
     *
     * @var array
     */

    public function HomeLeave()
    {
        return $this->hasMany('App\HomeLeave');
    }
}
