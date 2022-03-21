<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Custom models
use App\HomeOffice;
use App\OfficeLeave;
use App\Timer;

class AdminDashboardController extends Controller
{
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {

            $employee_checked_in = Timer::whereDate('timesheet.created_at', '=', now())

                ->where('timesheet.check_out', '=', null)
                ->join('users', 'users.id', '=', 'timesheet.user_id')
                ->where('users.role', '!=', 'admin')
                ->get(['users.name', 'users.position', 'users.id', 'users.image']);

            $employee_checked_out = Timer::whereDate('timesheet.created_at', '=', now())
                ->where('timesheet.check_out', '!=', null)
                ->join('users', 'users.id', '=', 'timesheet.user_id')
                ->where('users.role', '!=', 'admin')
                ->get(['users.name', 'users.position', 'users.id', 'users.image']);

            $employee_on_leave = OfficeLeave::whereDate('leave_description.created_at', '=', now())
                ->where('leave_description.leave_status', '=', 'accepted')
                ->join('users', 'users.id', '=', 'leave_description.user_id')
                ->where('users.role', '!=', 'admin')
                ->get(['users.name', 'users.position', 'users.id', 'users.image']);


            $employee_on_home_office = HomeOffice::whereDate('homeoffice.created_at', '=', now())
                ->where('homeoffice.ho_status', '=', 'accepted')
                ->join('users', 'users.id', '=', 'homeoffice.user_id')
                ->where('users.role', '!=', 'admin')
                ->get(['users.name', 'users.position', 'users.id', 'users.image',]);





            //dd($employee_online);
            // $employee_HO = \App\HomeOffice::where('ho_status', 'Pending')->count();
            // $employee_leave = \App\OfficeLeave::where('leave_status', 'Pending')->count();
            return view("admin.dashboard", ['employee_checked_in' => $employee_checked_in, 'employee_checked_out' => $employee_checked_out, 'employee_on_leave' => $employee_on_leave, 'employee_on_home_office' => $employee_on_home_office]);
        }
    }
}
