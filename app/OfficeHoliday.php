<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeHoliday extends Model
{
    protected $table = "holiday";
    protected $fillable = [
        'title', 'days', 'start_date', 'end_date'
    ];
}
