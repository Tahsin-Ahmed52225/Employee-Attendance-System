<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HolidayController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("admin.holiday.index");
        }
    }
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("admin.holiday.view");
        }
    }
}
