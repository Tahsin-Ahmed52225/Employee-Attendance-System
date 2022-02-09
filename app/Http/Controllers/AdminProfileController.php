<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {
            $user = Auth::user();
            return view("admin.profile", ['user' => $user]);
        }
    }
}
