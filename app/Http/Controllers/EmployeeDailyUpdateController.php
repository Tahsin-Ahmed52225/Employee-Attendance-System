<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

//Custom Models
use App\Timer;

class EmployeeDailyUpdateController extends Controller
{
    /**
     * View Daily Update
     *
     * @return
     */
    public function index(Request $request)
    {

        $updates = Timer::where('user_id', auth()->id())
            ->where('daily_update', '!=', null)
            ->where('check_out', "!=", null)
            ->join("users", "users.id", "=", "timesheet.user_id")
            ->orderBy('timesheet.check_out', 'desc')
            ->get(['users.name', 'timesheet.*']);
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        return view("employee.daily_report.index", ['updates' => $updates , 'month' => $month , 'year' => $year]);
    }
    /**
     * Update Daily Task
     *
     * @return
     */
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $update = Timer::find($request->post_id);
            if ($update) {
                if ($update->user_id == Auth::user()->id) {
                    if ($request->updated_text == "") {
                        return response()->json(['stage'=>'warning','msg' => 'Something went wrong']);
                    } else {
                        $update->daily_update = $request->updated_text;
                        $update->update_status = true;
                        $update->save();
                        return response()->json(['stage'=>'success','msg' => 'Updated successfully']);
                    }
                } else {
                    return response()->json(['stage'=>'warning','msg' => 'Something went wrong']);
                }
            } else {
                return response()->json(['stage'=>'warning','msg' => 'Something went wrong']);
            }
        } else {
            return response()->json(['stage'=>'warning','msg' => 'Something went wrong']);
        }
    }
    public function officeDays(Request $request)
    {
        if ($request->isMethod("GET")) {
            $days = Timer::where('user_id', auth()->id())
                ->where('daily_update', '!=', null)
                ->where('check_out', "!=", null)
                ->join("users", "users.id", "=", "timesheet.user_id")
                ->orderBy('timesheet.check_out', 'desc')
                ->paginate(9, ['users.name', 'timesheet.*']);
            return view("employee.daily_report.office_days", ['days' => $days]);
        }
    }
}
