<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Custom Models
use App\Timer;
use App\HomeOffice;
use App\OfficeLeave;

class EmployeeViewController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            //Office Days
            $office_days = Timer::where('user_id', auth()->id())
                ->where('check_in', '!=', null)
                ->where('check_out', '!=', null)
                ->where('daily_update', '!=', null)
                ->where('status', '!=', 'Absent')
                ->where('status', '!=', 'Pending')
                ->get();

            //home_office
            $home_office = HomeOffice::where('user_id', auth()->id())
                ->where('ho_status', '=', 'accepted')
                ->get();

            //Home office list
            $absent = Timer::where('user_id', auth()->id())
                ->where('check_in', null)
                ->where('check_out', null)
                ->where('daily_update', null)
                ->where('status', '==', 'Absent')
                ->get();



            //Office Leave List
            $leave = OfficeLeave::where('user_id', auth()->id())
                ->where('leave_status', '=', 'accepted')
                ->get();
            return view("employee.daily_report.office_days", ['office_days' => $office_days, 'home_office' => $home_office, 'absent' => $absent, 'leave' => $leave]);
        }
    }
}
