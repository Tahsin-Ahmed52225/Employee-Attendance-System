<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Custom models
use App\HomeOffice;

class EmployeeHomeOfficeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("employee.home_office.index");
        } else if ($request->isMethod("POST")) {

            if ($request->number_of_days == 1) {
                $request->validate([
                    'number_of_days' => 'required',
                    'starting_date' => 'required',
                    'reason' => 'required',
                ]);
                if ($request->number_of_days > 1) {
                    $request->validate([
                        'ending_date' => 'required',
                    ]);
                }
                $leave_request = HomeOffice::create([
                    'user_id' => auth()->user()->id,
                    'leave_description' => $request->reason,
                    'leave_starting_date' => $request->starting_date,
                    'leave_ending_date' => $request->ending_date,
                    'leave_days' => $request->number_of_days,
                    'leave_status' => 'Pending',

                ]);
                if ($leave_request) {
                    return redirect()->back()->with('success', 'Leave request has been sent');
                }
            } else {
                return redirect()->route('employee.leave.index')->with('warning', 'Leave days must be valid');
            }
        } else {
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }
}
