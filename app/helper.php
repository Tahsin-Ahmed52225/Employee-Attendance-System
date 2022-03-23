<?php

//Using laravel facade
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;

//Get the settings from the database

function settings($key)
{
    static $settings;

    if (is_null($settings)) {
        $settings = Cache::remember('settings', 24 * 60, function () {
            return Arr::pluck(App\Settings::all()->toArray(), 'name', 'value');
        });
    }

    return (is_array($key)) ? Arr::only($settings, $key) : $settings[$key];
}

//Make min into hour and min

function min_to_hour($min)
{

    $hour = floor($min / 60);
    if ($hour > 0) {
        $mins = $min - ($hour * 60);
    } else {
        $mins = $min;
    }
    return $hour . 'h ' . $mins . 'm';
}

//Check employe each day status

function check_out_status($time_diff_form_office,  $employee_work_hour, $office_work_hour,  $type)
{
    $status = '';
    if ($type == 'TIMER') {
        if ($time_diff_form_office > 0) {
            $status = 'Late,';
        }
        if (($employee_work_hour % 60) < ($office_work_hour / 2)) {
            $status = $status . 'HD,';
        } else {
            $status = $status . 'FD';
        }
    } else {
        $status = 'HO';
    }
    return $status;
}
