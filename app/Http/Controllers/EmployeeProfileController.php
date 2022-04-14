<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeProfileController extends Controller
{
    public function view(Request $request)

    {
        $user = Auth::user();
        return view('employee.profile', ['user' => $user]);
    }
    public function edit(Request $request)
    {
        if ($request->isMethod("GET")) {
            $user = Auth::user();
            return view("employee.edit-profile", ['user' => $user]);
        } else if ($request->isMethod("POST")) {

            $user = Auth::user();
            $user->name = $request->user_name;
            $user->number = $request->user_number;
            $user->save();
            return redirect()->route("employee.edit_profile")->with("success", "Profile Updated Succesfully");
        } else {
            return redirect()->back()->with("rejected", "Something went wrong ! Try again");
        }
    }
    public function changeProfile(Request $request)
    {
        if ($request->isMethod("POST")) {
            if ($request->file("profile_avatar")) {
                $file = $request->file("profile_avatar");
                $fileName =  preg_replace("/\h*/", "_", $file->getClientOriginalName());
                $file->move("files/profile_pics", $fileName);
                $user = Auth::user();
                $user->image = $fileName;
                $user->save();
                return redirect()->route("employee.edit_profile")->with("success", "Profile Updated Succesfully");
            } else {
                return redirect()->back()->with("rejected", "Something went wrong ! Try again");
            }
        } else {
            return redirect()->back()->with("rejected", "Something went wrong ! Try again");
        }
    }
    public function changePassword(Request $request)
    {
        $user = Auth::user();
        if ($request->isMethod("GET")) {

            return view("employee.change_password", ['user' => $user]);
        } else {

            $new_password = $request->new_password;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route("employee.change_password")->with("success", "Password Updated Succesfully");
        }
    }
}
