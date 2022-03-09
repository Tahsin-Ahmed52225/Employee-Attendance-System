<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Custom Models
use App\Timer;

class AdminDailyUpdateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            $updates = Timer::join("users", "users.id", "=", "timesheet.user_id")
                ->where('users.role', '!=', 'admin')
                ->orderBy('timesheet.check_out', 'desc')
                ->get(['users.name', 'timesheet.check_out', 'timesheet.daily_update']);
            //dd($updates);
            return view("admin.daily_report.index", [
                "updates" => $updates
            ]);
        }
    }
}
