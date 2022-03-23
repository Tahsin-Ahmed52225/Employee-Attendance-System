<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("admin.setting.index");
        }
    }
}
