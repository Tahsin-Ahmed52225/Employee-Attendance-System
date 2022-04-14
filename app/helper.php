<?php

namespace App;
//Using laravel facade



//Get the settings from the database
class Helpers
{
    public static function settings($key)
    {
        $settings = Settings::where('name', $key)->first();
        return $settings['value'];
    }
    //Make min into hour and min

    public static function min_to_hour($min)
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

    public static function check_out_status($check_in_time, $employee_work_hour,  $type)
    {
        $status = '';
        if ($type == 'TIMER') {
            if (strtotime($check_in_time) > strtotime(self::settings('office_time_starts'))) {
                $status = $status . 'Late,';
            }
            $office_hour_in_mins = self::settings('office_hours');
            $office_hour_in_mins = $office_hour_in_mins * 30;
            if ($employee_work_hour  <= $office_hour_in_mins) {
                $status = $status . 'HD,';
            } else {
                $status = $status . 'FD,';
            }
        } else {
            $status = 'HO';
        }
        // return $status;
        return $status;
    }
    public static function stringToBadge($status)
    {
        $myArray = explode(',', $status);
        foreach ($myArray as $key => $value) {
            if ($value == 'Late') {
                $myArray[$key] = '<span class="badge badge-danger mr-1">' . 'Late' . '</span>';
            } else if ($value == 'HD') {
                $myArray[$key] = '<span class="badge badge-warning mr-1">' . 'Half Day' . '</span>';
            } else if ($value == 'FD') {
                $myArray[$key] = '<span class="badge badge-success mr-1">' . 'Full Day' . '</span>';
            } else if ($value == 'HO') {
                $myArray[$key] = '<span class="badge badge-info mr-1">' . 'Home Office' . '</span>';
            }
        }
        return  $myArray;
    }
}
