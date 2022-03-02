<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Custom models
use App\HomeOffice;
use App\OfficeLeave;
use App\Timer;

class AdminDashboardController extends Controller
{
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {

            $employee_online = \App\Timer::where('created_at', '=', now())->count();
            // $employee_HO = \App\HomeOffice::where('ho_status', 'Pending')->count();
            // $employee_leave = \App\OfficeLeave::where('leave_status', 'Pending')->count();
            return view("admin.dashboard");
        }
    }
}
