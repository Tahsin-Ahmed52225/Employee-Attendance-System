<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    //Table associated with this model
    protected $table = "system_settings";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'value',
    ];
    protected $primaryKey = 'name';
}
