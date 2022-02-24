<?php


//Make min into hour and min
if (!function_exists('min_to_hour')) {
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
}
