<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class AdminProfileController extends Controller
{
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {
            $user = Auth::user();
            return view("admin.profile", ['user' => $user]);
        }
    }
    public function edit(Request $request)
    {
        if ($request->isMethod("GET")) {
            $user = Auth::user();
            return view("admin.edit-profile", ['user' => $user]);
        } else if ($request->isMethod("POST")) {

            $user = Auth::user();
            $user->name = $request->user_name;
            $user->number = $request->user_number;
            $user->position = $request->user_position;
            $user->save();
            if ($request->user_mail == $user->email) {
                return redirect()->route("admin.edit_profile")->with("warning", "We know you can inpect element so don't act like a fool");
            } else {
                return redirect()->route("admin.edit_profile")->with("success", "Profile Updated Succesfully");
            }
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
                return redirect()->route("admin.edit_profile")->with("success", "Profile Updated Succesfully");
            } else {
                return redirect()->back()->with("rejected", "Something went wrong ! Try again");
            }
        } else {
            return redirect()->back()->with("rejected", "Something went wrong ! Try again");
        }
    }
}
