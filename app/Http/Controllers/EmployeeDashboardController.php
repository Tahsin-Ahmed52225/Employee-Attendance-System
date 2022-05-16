<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

//Custom models
use App\HomeOffice;
use App\OfficeLeave;
use App\OfficeHoliday;
use App\Timer;


class EmployeeDashboardController extends Controller
{
    public function view(Request $request)
    {
        // $ip = file_get_contents('https://api.my-ip.io/ip');
        // if ($ip == '203.76.222.138') {
        //     $in_office = true;
        // } else {
        //     $in_office = false;
        // }

        //Check if user is in leave
        $leave = OfficeLeave::where(function ($query) {
            $query->where('leave_days', 1)
                ->where('user_id', auth()->user()->id)
                ->whereDate('leave_starting_date', '=', now()->toDateString())
                ->where('leave_status', 'accepted');
        })
            ->orWhere(function ($query) {
                $query->where('leave_days', '>', 1)
                    ->where('user_id', auth()->user()->id)
                    ->whereDate('leave_starting_date', '<=', now()->toDateString())
                    ->whereDate('leave_ending_date', '>=', now()->toDateString())
                    ->where('leave_status', 'accepted');
            })
            ->get();
        //   dd($leave);



        // Check if user is in Home Office
        $home_office = HomeOffice::where(function ($query) {
            $query->where('ho_days', 1)
                ->where('user_id', auth()->user()->id)
                ->where('ho_status', 'accepted')
                ->whereDate('ho_starting_date', '=', now()->toDateString());
        })
            ->orWhere(function ($query) {
                $query->where('ho_days', '>', 1)
                    ->where('user_id', auth()->user()->id)
                    ->whereDate('ho_starting_date', '<=', now()->toDateString())
                    ->whereDate('ho_ending_date', '>=', now()->toDateString())
                    ->where('ho_status', 'accepted');
            })
            ->get();

        //Check if it is Office holiday
        $office_holidays = OfficeHoliday::where(function ($query) {
            $query->where('days', 1)
                ->whereDate('start_date', '=', now()->toDateString());
        })
            ->orWhere(function ($query) {
                $query->where('days', '>', 1)
                    ->whereDate('start_date', '<=', now()->toDateString())
                    ->whereDate('end_date', '>=', now()->toDateString());
            })
            ->get();
        //days without updates
        $pending_update = Timer::where('user_id', auth()->user()->id)
            ->where('daily_update', null)
            ->where('status', '!=', 'Pending')
            ->where('status', '!=', 'Absent')
            ->get();
        //days without checkouts
        $pending_checkout = Timer::where('user_id', auth()->user()->id)
            ->where('daily_update', null)
            ->where('status', 'Pending')
            ->get();

        $total_office = count(Timer::where('user_id', auth()->user()->id)
            ->where('status', '!=', 'Pending')
            ->where('status', '!=', 'Absent')
            ->where('daily_update', '!=', null)
            ->get());

        $checked_in = count(Timer::where('user_id', auth()->user()->id)
            ->whereDate('check_in', '=', now())
            ->where('check_out', '=', null)
            ->get());
        //dd($checked_in);


        return view('employee.dashboard', ['leave' => $leave, 'home_office' => $home_office, 'office_holidays' => $office_holidays, 'pending_update' => $pending_update, 'pending_checkout' => $pending_checkout, 'total_office' => $total_office, 'checked_in' => $checked_in]);
    }
    public function pendingUpdate(Request $request)
    {
        if ($request->isMethod("GET")) {
            $pending_state = Timer::where('user_id', auth()->user()->id)
                ->where('daily_update', null)
                ->where('status', '!=', 'Pending')
                ->where('status', '!=', 'Absent')
                ->get();
            return view('employee.daily_report.pending', ['pending_state' => $pending_state]);
        } else {
        }
    }
}
