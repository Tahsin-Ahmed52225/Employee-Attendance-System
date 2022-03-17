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

        $updates = Timer::where('user_id', auth()->id())
            ->join("users", "users.id", "=", "timesheet.user_id")
            ->orderBy('timesheet.check_out', 'desc')
            ->paginate(9);

        //Infinite scroll for pagination
        if ($request->ajax()) {

            $view =  view("employee.daily_report.data", compact('updates'))->render();
            // dd(response()->json(['html' => $view]));
            return response()->json(['html' => $view]);
        }

        return view("employee.daily_report.index", ['updates' => $updates]);
    }
}
