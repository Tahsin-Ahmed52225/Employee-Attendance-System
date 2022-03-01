<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Custom models
use App\OfficeLeave;
use App\User;

class AdminLeaveController extends Controller
{
    /**
     * Viewing all leave applications
     *
     * @return void
     */
    public function index(Request $request)
    {

        if ($request->isMethod("GET")) {
            $leaves = OfficeLeave::where('leave_status', 'Pending')->orderBy('created_at', 'desc')->get();
            return view("admin.leave.index", ['leaves' => $leaves]);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }
    /**
     * Updating singular leave applications
     *
     * @return void
     */

    public function update(Request $request, $id)
    {
        if ($request->isMethod("POST")) {
            $leave = OfficeLeave::find(decrypt($id));
            if ($leave) {
                $leave->leave_status = $request->leave_status;
                $leave->save();
                return redirect()->back()->with('success', 'Response has been sent');
            } else {
                return redirect()->back()->with('warning', 'Something went wrong');
            }
        }
    }
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {
            $user = User::where("role", "!=", "admin")->get();
            dd($user);

            return view("admin.leave.view");
        }
    }
}
