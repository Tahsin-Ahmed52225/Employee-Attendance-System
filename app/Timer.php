<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    protected $table = "timesheet";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'check_in', 'check_out', 'total_time',
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
