<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    //Table associated with this model
    protected $table = "timesheet";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'check_in', 'check_out', 'total_time', 'status', 'update_status',
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
