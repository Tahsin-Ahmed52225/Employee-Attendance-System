<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


//Models
use App\Timer;
use App\Helpers;

class TimesheetController extends Controller
{
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {

            $timesheet = Timer::where('check_out', '!=', null)
                ->where('status', '!=', 'Pending')
                ->where('status', '!=', 'Absent')
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
            $AbsentList = Timer::where('status', '=', 'Absent')
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
                ->get(['users.name', 'timesheet.check_in', 'timesheet.check_out', 'timesheet.total_time', 'timesheet.status', 'timesheet.id']);

            return view("admin.in_and_out.pending", ['PendingList' => $PendingList]);
        }
    }
    public function pending_clearence(Request $request, $id)
    {
        if ($request->isMethod("POST")) {
            $timer = Timer::where('id', decrypt($id))->first();
            if ($timer) {
                if ($request->data == "approve") {
                    //Updating the checkout time
                    $time = explode(':', $request->office_time_ends);
                    $check_out_timer = Carbon::parse($timer->check_out);
                    $check_out_timer->hour   = $time[0];
                    $check_out_timer->minute = $time[1];
                    $check_out_timer->second = $time[2];
                    $timer->check_out = $check_out_timer->toDateTimeString();
                    $timer->total_time = $check_out_timer->diffInMinutes($timer->check_in, true);
                    $timer->status = Helpers::check_out_status(Carbon::parse($timer->check_in)->format('h:i A'), $timer->total_time, 'TIMER');
                    $timer->save();
                } else if ($request->data == "HO") {
                    $timer->status = $request->data;
                    $timer->save();
                } else {
                    $timer->status = $request->data;
                    $timer->check_in = null;
                    $timer->check_out = null;
                    $timer->save();
                }


                return redirect()->back()->with('success', 'Pending Clearence Successfully');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } else {
            return redirect()->back();
        }
    }
}
