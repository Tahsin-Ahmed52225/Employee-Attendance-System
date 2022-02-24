<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("employee.leave.index");
        }
    }
}
