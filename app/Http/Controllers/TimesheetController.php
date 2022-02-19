<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Models
use App\User;

class TimesheetController extends Controller
{
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {
            $user = User::where('role', 'employee')->get('id', 'name');
            $timesheet = User::where('role', 'employee')
                ->join('timesheet', 'users.id', '=', 'timesheet.user_id')
                ->get(['users.id', 'timesheet.check_in', 'timesheet.check_out']);
            return view("admin.in_and_out.timesheet", ['user' => $user]);
        }
    }
}
