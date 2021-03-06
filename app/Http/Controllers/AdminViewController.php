<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Custom Model
use App\User;
use App\Timer;
use App\HomeOffice;
use App\OfficeLeave;

class AdminViewController extends Controller
{
    public function index(Request $request, $id)
    {
        if ($request->isMethod("GET")) {
            $user_id = decrypt($id);
       //     dd($user_id);
            if (User::where('id',$user_id)->first()) {
                //Office Days
                $office_days = Timer::where('user_id', $user_id)
                    ->where('check_in', '!=', null)
                    ->where('check_out', '!=', null)
                    ->where('daily_update', '!=', null)
                    ->where('status', '!=', 'Absent')
                    ->where('status', '!=', 'Pending')
                    ->where('status', '!=', 'HO')
                    ->get();

                //home_office
                $home_office = HomeOffice::where('user_id', $user_id)
                    ->where('ho_status', '=', 'accepted')
                    ->get();

                //Home office list
                $absent = Timer::where('user_id', $user_id)
                    ->where('status', 'Absent')
                    ->where('check_out', null)
                    ->where('daily_update', null)
                    ->get();



                //Office Leave List
                $leave = OfficeLeave::where('user_id', $user_id)
                    ->where('leave_status', '=', 'accepted')
                    ->get();
                return view("admin.daily_report.office_days", ['office_days' => $office_days, 'home_office' => $home_office, 'absent' => $absent, 'leave' => $leave, 'user' => User::where('id',$user_id)->first()]);
            } else {
                return redirect()->back()->with('error', 'User not found');
            }
        }else{
            return redirect()->back();
        }
    }
    public function viewProfile(Request $request, $id)
    {
        if ($request->isMethod("GET")) {
            $user_id = decrypt($id);
            if (User::find($user_id)) {
                $user = User::find($user_id);
                return view("admin.employee.view_profile", ['user' => $user]);
            } else {
                return redirect()->back()->with('error', 'User not found');
            }
        }
    }
}
