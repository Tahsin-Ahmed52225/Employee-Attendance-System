<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function tdgLogin(Request $request)
    {
        if ($request->isMethod("GET")) {
            return  view("auth.login");
        } else if ($request->isMethod("POST")) {
            $data['email'] = $request->email;
            $data['password'] = $request->password;
            $validator = Validator::make($data, [
                'email' => ['required', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:6'],
            ]);
            if ($validator->fails()) {
                return redirect("/login")
                    ->withErrors($validator)
                    ->withInput();
            } else {
                if (Auth::attempt(['email' =>  $request->email, 'password' => $request->password])) {

                    if (Auth::user()->role == "employee" || Auth::user()->role == "admin") {
                        if (Auth::user()->stage == 1) {
                            if (Auth::user()->role == "employee") {
                                return redirect('/employee/dashboard');
                            } else if (Auth::user()->role == "admin") {
                                return redirect('/admin/dashboard');
                            }
                        } else {
                            Auth::logout();
                            return redirect()->back()->with(session()->flash('alert-warning', 'Your account has been locked !'));
                        }
                    } else {
                        Auth::logout();
                        return redirect()->back()->with(session()->flash('alert-warning', 'Not permitted route'));
                    }
                } else {
                    return redirect()->back()->with(session()->flash('alert-danger', 'Incorract Credentials'));
                }
            }
        } else {
            return  view('welcome');
        }
    }
    public function logout(Request $request)
    {
        if ($request->isMethod("GET")) {
            if (Auth::user()->role == 'client') {
                Auth::logout();
                return redirect('/login');
            } else {
                Auth::logout();
                return redirect('/');
            }
        } else {
            return view("welcome");
        }
    }
}
