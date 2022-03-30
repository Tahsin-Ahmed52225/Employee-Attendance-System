<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Custom Models
use App\Timer;

class AdminDailyUpdateController extends Controller
{
    public function index(Request $request)
    {

        $updates = Timer::join("users", "users.id", "=", "timesheet.user_id")
            ->where("timesheet.daily_update", "!=", null)
            ->where("check_out", "!=", null)
            ->where('users.role', '!=', 'admin')
            ->orderBy('timesheet.check_out', 'desc')
            ->paginate(9);
        //Infinite scroll for pagination
        if ($request->ajax()) {

            $view =  view("admin.daily_report.data", compact('updates'))->render();
            // dd(response()->json(['html' => $view]));
            return response()->json(['html' => $view]);
        }
        return view("admin.daily_report.index", [
            "updates" => $updates
        ]);
    }
}
