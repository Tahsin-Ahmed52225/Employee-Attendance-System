<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
    public function view()
    {
        $ip = file_get_contents('https://api.my-ip.io/ip');
        if ($ip == '203.76.222.138') {
            $in_office = true;
        } else {
            $in_office = false;
        }
        return view('employee.dashboard', ['in_office' => $in_office]);
    }
}
