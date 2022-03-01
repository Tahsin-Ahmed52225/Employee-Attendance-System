<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeOffice extends Model
{
    //Table associated with this model
    protected $table = "homeoffice";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'ho_description', 'ho_starting_date', 'ho_ending_date', 'ho_days', 'ho_status',
    ];


    //One to many relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
