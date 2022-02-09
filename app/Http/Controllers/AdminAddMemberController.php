<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

//Models
use App\User;

class AdminAddMemberController extends Controller
{
    public function addMember(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("admin.add-member");
        } else if ($request->isMethod("POST")) {
            $data['name'] = $request->tdg_name;
            $data['email'] = $request->tdg_email;
            $data['phone'] = $request->tdg_phone;
            $data['position'] = $request->tdg_position;
            $data['password'] = $request->tdg_password;
            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'phone' => ['required', 'string', 'max:255'],
                'position' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:6'],
            ]);
            if ($validator->fails()) {
                return redirect("/admin/add-member")
                    ->withErrors($validator)
                    ->withInput();
            } else {

                $user = User::create([
                    'name' =>  $data['name'],
                    'email' =>   $data['email'],
                    'number' => $data['phone'],
                    'position' =>  $data['position'],
                    'role' => 'employee',
                    'stage' => 1,
                    'password' => Hash::make($request->password),
                ]);
                if ($user != null) {
                    return redirect()->back()->with(session()->flash('alert-success', 'Member Added !'));
                } else {
                    return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong, Try Again !'));
                }
            }
        } else {
            return redirect('/');
        }
    }
    public function viewMember(Request $request)
    {
        if ($request->isMethod("GET")) {
            $users = User::where("role", "=", "employee")->get();
            //  dd($users);
            return view('admin.view-member', ['users' => $users]);
        } else if ($request->isMethod("POST")) {
        } else {
            return redirect("/");
        }
    }
    public function deleteMember(Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->data);
            if ($user) {
                $user->delete();
                Session::flash('success', 'Member removed successfully');
                return View::make('partials/flash_message');
            } else {
                Session::flash('error', 'Something is wrong');
                return View::make('partials/flash_message');
            }
        }
    }
    public function updateMember(Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->id);
            if (filter_var($request->value, FILTER_SANITIZE_STRING) == null) {
                $msg = ucwords($request->option) . " shouldn't be empty";
                Session::flash('error', $msg);
                return View::make('partials/flash_message');
            } else {
                if ($request->option == "email") {
                    if (filter_var($request->value, FILTER_VALIDATE_EMAIL)) {
                        if ($user) {
                            $option = $request->option;
                            $user->$option =  filter_var($request->value, FILTER_SANITIZE_EMAIL);
                            $user->save();
                            $msg = ucwords($request->option) . " updated successfully";
                            Session::flash('success', $msg);
                            return View::make('partials/flash_message');
                        } else {
                            Session::flash('error', "Something went wrong");
                            return View::make('partials/flash_message');
                        }
                    } else {
                        Session::flash('error', "Enter valid email");
                        return View::make('partials/flash_message');
                    }
                } else if ($request->option == "number") {
                    if (filter_var($request->value, FILTER_VALIDATE_INT)) {
                        if ($user) {
                            $option = $request->option;
                            $user->$option =  filter_var($request->value, FILTER_VALIDATE_INT);
                            $user->save();
                            $msg = ucwords($request->option) . " updated successfully";
                            Session::flash('success', $msg);
                            return View::make('partials/flash_message');
                        } else {
                            Session::flash('error', "Something went wrong");
                            return View::make('partials/flash_message');
                        }
                    } else {
                        Session::flash('error', "Incorrect input");
                        return View::make('partials/flash_message');
                    }
                } else {
                    if ($user) {
                        $option = $request->option;
                        $user->$option =  filter_var($request->value, FILTER_SANITIZE_STRING);
                        $user->save();
                        $msg = ucwords($request->option) . " updated successfully";
                        Session::flash('success', $msg);
                        return View::make('partials/flash_message');
                    } else {
                        Session::flash('error', "Something went wrong");
                        return View::make('partials/flash_message');
                    }
                }
            }
        }
    }
}
