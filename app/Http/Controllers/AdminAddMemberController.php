<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAddMemberController extends Controller
{
    public function store()
    {
        return view("admin.add-member");
    }
    public function view()
    {
        return view("admin.view-member");
    }
}
