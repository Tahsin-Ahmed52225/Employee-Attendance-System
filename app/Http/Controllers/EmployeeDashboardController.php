<?php

namespace App\Http\Controllers;

use App\OfficeLeave;
use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
    public function view()
    {
        $ip = file_get_contents('https://api.my-ip.io/ip');
        if ($ip == '203.76.222.138') {
            $in_office = true;
        } else {
            $in_office = false;
        }
        //Check if user is in leave
        $leave = OfficeLeave::where('user_id', auth()->user()->id)
            ->where('leave_status', 'accepted')
            ->where(function ($query) {
                $query->where('leave_days', 1)
                    ->whereDate('leave_starting_date', '=', now()->toDateString());
            })
            ->orWhere(function ($query) {
                $query->where('leave_days', '>', 1)
                    ->whereDate('leave_starting_date', '<=', now()->toDateString())
                    ->whereDate('leave_ending_date', '>=', now()->toDateString());
            })
            ->get();

        //dd($leave);

        //Check if user is in Home Office
        // $leave = OfficeLeave::where('user_id', auth()->user()->id)
        //     ->where('leave_status', 'accepted')
        //     ->where(function ($query) {
        //         $query->where('leave_days', 1)
        //             ->whereDate('leave_starting_date', '=', now()->toDateString());
        //     })
        //     ->orWhere(function ($query) {
        //         $query->where('leave_days', '>', 1)
        //             ->whereDate('leave_starting_date', '<=', now()->toDateString())
        //             ->whereDate('leave_ending_date', '>=', now()->toDateString());
        //     })
        //     ->get();


        return view('employee.dashboard', ['in_office' => $in_office]);
    }
}
