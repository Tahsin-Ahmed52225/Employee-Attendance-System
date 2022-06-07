<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Custom models
use App\HomeOffice;
use App\OfficeLeave;
use App\Timer;
use App\Helpers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {

            $employee_checked_in = Timer::whereDate('timesheet.check_in', '=', now())
                ->where('timesheet.check_out', '=', null)
                ->join('users', 'users.id', '=', 'timesheet.user_id')
                ->where('users.role', '!=', 'admin')
                ->get(['users.name', 'users.position', 'users.id', 'users.image','timesheet.check_in']);

            $employee_checked_out = Timer::whereDate('timesheet.check_out', '=', now())
                ->where('timesheet.check_out', '!=', null)
                ->join('users', 'users.id', '=', 'timesheet.user_id')
                ->where('users.role', '!=', 'admin')
                ->get(['users.name', 'users.position', 'users.id', 'users.image']);

            $employee_on_leave = OfficeLeave::where(function ($query) {
                $query->where('leave_days', 1)
                    ->whereDate('leave_starting_date', '=', now()->toDateString())
                    ->where('leave_description.leave_status', '=', 'accepted');
            })
                ->orWhere(function ($query) {
                    $query->where('leave_days', '>', 1)
                        ->whereDate('leave_starting_date', '<=', now()->toDateString())
                        ->whereDate('leave_ending_date', '>=', now()->toDateString())
                        ->where('leave_description.leave_status', '=', 'accepted');
                })
                ->join('users', 'users.id', '=', 'leave_description.user_id')
                ->where('users.role', '!=', 'admin')
                ->get(['users.name', 'users.position', 'users.id', 'users.image']);


            $employee_on_home_office = HomeOffice::where(function ($query) {
                $query->where('ho_days', 1)
                    ->whereDate('ho_starting_date', '=', now()->toDateString())
                    ->where('homeoffice.ho_status', '=', 'accepted');
            })
                ->orWhere(function ($query) {
                    $query->where('ho_days', '>', 1)
                        ->whereDate('ho_starting_date', '<=', now()->toDateString())
                        ->whereDate('ho_ending_date', '>=', now()->toDateString())
                        ->where('homeoffice.ho_status', '=', 'accepted');
                })

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
