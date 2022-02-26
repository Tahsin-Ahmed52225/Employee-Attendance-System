<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//
use App\OfficeLeave;

class AdminLeaveController extends Controller
{
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {
            $leaves = OfficeLeave::orderBy('created_at', 'desc')->get();
            return view("admin.leave.index", ['leaves' => $leaves]);
        }
    }
}
