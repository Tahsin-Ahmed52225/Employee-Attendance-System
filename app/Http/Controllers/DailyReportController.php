<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("admin.daily_report.index");
        }
    }
}
