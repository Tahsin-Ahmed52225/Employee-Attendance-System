<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        if ($request->isMethod("GET")) {
            $updates = Timer::where('user_id', auth()->id())
                ->join("users", "users.id", "=", "timesheet.user_id")
                ->orderBy('timesheet.check_out', 'desc')
                ->get(['users.name', 'timesheet.check_out', 'timesheet.daily_update']);
            return view("employee.daily_report.index", ['updates' => $updates]);
        }
    }
}
