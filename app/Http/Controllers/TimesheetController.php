<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Models
use App\Timer;

class TimesheetController extends Controller
{
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {

            $timesheet = Timer::where('check_out', '!=', null)
                ->join('users', 'users.id', '=', 'timesheet.user_id')
                ->where('users.role', '=', 'employee')
                ->orderBy('timesheet.check_in', 'DESC')
                ->get(['users.name', 'timesheet.check_in', 'timesheet.check_out', 'timesheet.total_time', 'timesheet.status']);
            //dd($timesheet);
            return view("admin.in_and_out.view", ['timesheet' => $timesheet]);
        }
    }
    public function absent(Request $request)
    {
        if ($request->isMethod("GET")) {
            $AbsentList = Timer::where('status', '=', 'absent')
                ->join('users', 'users.id', '=', 'timesheet.user_id')
                ->where('users.role', '=', 'employee')
                ->orderBy('timesheet.check_in', 'DESC')
                ->get(['users.name', 'timesheet.check_in', 'timesheet.check_out', 'timesheet.total_time', 'timesheet.status']);

            return view("admin.in_and_out.absent", ['AbsentList' => $AbsentList]);
        }
    }
    public function pending(Request $request)
    {
        if ($request->isMethod("GET")) {
            $PendingList = Timer::where('status', '=', 'Pending')
                ->join('users', 'users.id', '=', 'timesheet.user_id')
                ->where('users.role', '=', 'employee')
                ->orderBy('timesheet.check_in', 'DESC')
                ->get(['users.name', 'timesheet.check_in', 'timesheet.check_out', 'timesheet.total_time', 'timesheet.status']);

            return view("admin.in_and_out.pending", ['PendingList' => $PendingList]);
        }
    }
}
