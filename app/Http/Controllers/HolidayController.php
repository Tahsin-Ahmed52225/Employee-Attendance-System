<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Custom Models
use App\OfficeHoliday;


class HolidayController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            $not_checkedout =   DB::table('timesheet')->whereDate('check_in', now())->where('check_out', null)->get();
            foreach ($not_checkedout as $not_checkedout_user) {
                DB::table('timesheet')->where('id', $not_checkedout_user->id)->update(['check_out' => date('Y-m-d H:i:s')]);
                DB::table('timesheet')->where('id', $not_checkedout_user->id)->update(['status' => 'Pending']);
            }

            $employees = DB::table('users')->where('role', 'employee')->get();
            foreach ($employees as $person) {

                //Check if employee in the office
                $attended = DB::table('timesheet')->whereDate('created_at', now())->where('user_id', $person->id)->get();
                //   dd($attended);
                //Check if employee in leave
                if (count($attended) == 0) {
                    //Check if today is holiday
                    $office_holidays = DB::table('holiday')
                        ->where(function ($query) {
                            $query->where('days', 1)
                                ->whereDate('start_date', '=', now()->toDateString());
                        })
                        ->orWhere(function ($query) {
                            $query->where('days', '>', 1)
                                ->whereDate('start_date', '<=', now()->toDateString())
                                ->whereDate('end_date', '>=', now()->toDateString());
                        })
                        ->get();
                    //  dd($office_holidays);
                    if (count($office_holidays) == 0) {
                        $leave = DB::table('leave_description')
                            ->where('user_id', $person->id)
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
                        //Check if employee in home office
                        $home_office = DB::table('homeoffice')->where('user_id',  $person->id)
                            ->where('ho_status', 'accepted')
                            ->where(function ($query) {
                                $query->where('ho_days', 1)
                                    ->whereDate('ho_starting_date', '=', now()->toDateString());
                            })
                            ->orWhere(function ($query) {
                                $query->where('ho_days', '>', 1)
                                    ->whereDate('ho_starting_date', '<=', now()->toDateString())
                                    ->whereDate('ho_ending_date', '>=', now()->toDateString());
                            })
                            ->get();
                        if (count($home_office) == 0) {
                            if (count($leave) == 0) {
                                DB::table('timesheet')->insert(['user_id' => $person->id, 'check_in' => date('1000-01-01 00:00:00'), 'check_out' => null, 'total_time' => null, 'status' => 'Absent', 'created_at' => now()]);
                            }
                        }
                    }
                }
            }























            return view("admin.holiday.index");
        } else if ($request->isMethod("POST")) {
            if ($request->number_of_days == 1) {
                $request->validate([
                    'number_of_days' => 'required',
                    'starting_date' => 'required',
                    'reason' => 'required',
                ]);
            } else if ($request->number_of_days > 1) {
                $request->validate([
                    'ending_date' => 'required',
                ]);
            } else {
                return redirect()->back()->with('warning', 'Leave days must be valid');
            }

            $holiday = OfficeHoliday::create([
                'title' => $request->reason,
                'start_date' => $request->starting_date,
                'end_date' => $request->ending_date,
                'days' => $request->number_of_days,
            ]);
            if ($holiday) {
                return redirect()->back()->with('success', 'Holiday date is added');
            } else {
                return redirect()->back()->with('warning', 'Something went wrong');
            }
        } else {
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {
            $holidays = OfficeHoliday::all();
            return view("admin.holiday.view", ['holiday' => $holidays]);
        }
    }
    public function delete(Request $request, $id)
    {
        if ($request->isMethod("POST")) {
            $holiday = OfficeHoliday::find(decrypt($id));
            if ($holiday) {
                $holiday->delete();
                return redirect()->back()->with('success', 'Holiday date is deleted');
            } else {
                return redirect()->back()->with('warning', 'Something went wrong');
            }
        } else {
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }
}
