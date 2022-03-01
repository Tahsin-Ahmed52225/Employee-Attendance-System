<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Custom models
use App\HomeOffice;

class AdminHomeOfficeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            $home_office_records = HomeOffice::where('ho_status', 'Pending')->orderBy('created_at', 'desc')->get();
            return view("admin.home_office.index", ['home_office_records' => $home_office_records]);
        }
    }
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("admin.home_office.view");
        }
    }
    public function update()
    {
    }
}
