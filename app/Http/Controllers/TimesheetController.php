<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Models
use App\User;

class TimesheetController extends Controller
{
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {

            $user = User::where('role', 'employee')->get('name');
            return view("admin.in_and_out.view", ['user' => $user]);
        }
    }
}
