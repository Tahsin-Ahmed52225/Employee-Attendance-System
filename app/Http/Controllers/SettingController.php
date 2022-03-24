<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

//Custom Models
use App\Settings;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            //dd(Helpers::settings('office_time_starts'));
            return view("admin.settings");
        } else if ($request->isMethod("POST")) {

            if ($request->filled('office_time_starts') || $request->filled('office_time_ends') || $request->filled('office_hours')) {
                if ($request->office_time_starts) {
                    $settings = Settings::where('name', 'office_time_starts')->first();
                    $settings->value = $request->office_time_starts;
                    $settings->save();
                }
                if ($request->office_time_ends) {
                    $settings = Settings::where('name', 'office_time_ends')->first();
                    $settings->value = $request->office_time_ends;
                    $settings->save();
                }
                if ($request->office_hours) {
                    $settings = Settings::where('name', 'office_hours')->first();
                    $settings->value = $request->office_hours;
                    $settings->save();
                }
                // dd(Cache::get('settings'));
                return redirect()->back()->with('success', 'Settings updated successfully');
            } else {
                return redirect()->back()->with('warning', 'Something went wrong');
            }
        } else {
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }
}
