<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLeaveController extends Controller
{
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("admin.leave.index");
        }
    }
}
