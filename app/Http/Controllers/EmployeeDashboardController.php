<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

//Custom models
use App\HomeOffice;
use App\OfficeLeave;
use App\OfficeHoliday;


class EmployeeDashboardController extends Controller
{
    public function view(Request $request)
    {
        // $ip = file_get_contents('https://api.my-ip.io/ip');
        // if ($ip == '203.76.222.138') {
        //     $in_office = true;
        // } else {
        //     $in_office = false;
        // }
        //Check if user is in leave
        $leave = OfficeLeave::where('user_id', auth()->user()->id)
            ->where('leave_status', 'accepted')
            ->where(function ($query) {
                $query->where('leave_days', 1)
                    ->whereDate('leave_starting_date', '=', now()->toDateString());
            })
            ->orWhere(function ($query) {
                $query->where('leave_days', '>', 1)
                    ->whereDate('leave_starting_date', '<=', now()->toDateString())
                    ->whereDate('leave_ending_date', '>=', now()->toDateString());
            })
            ->get();



        // Check if user is in Home Office
        $home_office = HomeOffice::where('user_id', auth()->user()->id)
            ->where('ho_status', 'accepted')
            ->where(function ($query) {
                $query->where('ho_days', 1)
                    ->whereDate('ho_starting_date', '=', now()->toDateString());
            })
            ->orWhere(function ($query) {
                $query->where('ho_days', '>', 1)
                    ->whereDate('ho_starting_date', '<=', now()->toDateString())
                    ->whereDate('ho_ending_date', '>=', now()->toDateString());
            })
            ->get();

        //Check if it is Office holiday
        $office_holidays = OfficeHoliday::where(function ($query) {
            $query->where('days', 1)
                ->whereDate('start_date', '=', now()->toDateString());
        })
            ->orWhere(function ($query) {
                $query->where('days', '>', 1)
                    ->whereDate('start_date', '<=', now()->toDateString())
                    ->whereDate('end_date', '>=', now()->toDateString());
            })
            ->get();


        return view('employee.dashboard', ['leave' => $leave, 'home_office' => $home_office, 'office_holidays' => $office_holidays]);
    }
}
