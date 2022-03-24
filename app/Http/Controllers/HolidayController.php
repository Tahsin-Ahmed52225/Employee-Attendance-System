<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Custom Models
use App\OfficeHoliday;


class HolidayController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
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
