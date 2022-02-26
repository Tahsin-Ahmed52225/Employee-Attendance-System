<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeLeave extends Model
{
    //Table associated with this model
    protected $table = "leave_description";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'leave_description', 'leave_starting_date', 'leave_ending_date', 'leave_days', 'leave_status',
    ];


    //One to many relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
