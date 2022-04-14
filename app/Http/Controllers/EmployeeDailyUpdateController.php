<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            ->paginate(9, ['users.name', 'timesheet.*']);
        //Infinite scroll for pagination
        if ($request->ajax()) {

            $view =  view("employee.daily_report.data", compact('updates'))->render();
            // dd(response()->json(['html' => $view]));
            return response()->json(['html' => $view]);
        }

        return view("employee.daily_report.index", ['updates' => $updates]);
    }
    /**
     * Update Daily Task
     *
     * @return
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod("POST")) {
            $update = Timer::find(decrypt($id));
            if ($update) {
                if ($update->user_id == Auth::user()->id) {
                    if ($request->description == "") {
                        return redirect()->back()->with('warning', 'Update field is required');
                    } else {
                        $update->daily_update = $request->description;
                        $update->update_status = true;
                        $update->save();
                        return redirect()->back()->with('success', 'Updated Successfully');
                    }
                } else {
                    return redirect()->back()->with('warning', 'Unauthorized Access');
                }
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } else {
            return redirect()->back();
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
