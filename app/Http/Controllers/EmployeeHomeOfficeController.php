<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Custom models
use App\HomeOffice;
use Illuminate\Support\Facades\Auth;

class EmployeeHomeOfficeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            $employee_HO = HomeOffice::where('user_id', Auth::user()->id)->get();
            return view("employee.home_office.index", ['home_offices' => $employee_HO]);
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
                    'ho_description' => $request->reason,
                    'ho_starting_date' => $request->starting_date,
                    'ho_ending_date' => $request->ending_date,
                    'ho_days' => $request->number_of_days,
                    'ho_status' => 'Pending',

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
    public function delete(Request $request, $id)
    {
        if ($request->isMethod("POST")) {
            $ho = HomeOffice::find(decrypt($id));
            if ($ho) {
                $ho->delete();
                return redirect()->back()->with('success', 'Home office request has been deleted');
            } else {
                return redirect()->back()->with('warning', 'Something went wrong');
            }
        } else {
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }
}
