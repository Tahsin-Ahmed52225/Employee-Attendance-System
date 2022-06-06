<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
//Custom Models
use App\Timer;

class SearchController extends Controller
{
    public function searchDailyUpdate(Request $request , $month , $year)
    {
        if($request->isMethod("GET")){
            if($month == -1 || $year == -1){
                return redirect()->back()->with('warning', 'Choose valid month and year');
            }
            $updates = Timer::where('user_id', auth()->id())
                ->where('daily_update', '!=', null)
                ->where('check_out', "!=", null)
                ->whereMonth('check_out', $month)
                ->whereYear('check_out', $year)
                ->join("users", "users.id", "=", "timesheet.user_id")
                ->orderBy('timesheet.check_out', 'desc')
                ->get(['users.name', 'timesheet.*']);

            return view("employee.daily_report.index", ['updates' => $updates , 'month' => $month , 'year' => $year]);
        }else{
            return redirect()->back();
        }

    }
    public function getPostDescription(Request $request)
    {
        if($request->ajax()){
            if(Timer::find($request->post_id)){
                $dailyUpdate = Timer::where('id', $request->post_id)->get('daily_update');
                return response()->json($dailyUpdate[0]->daily_update);
            }else{
                return response()->json('404');
            }
        }else{
            return redirect()->back();
        }

    }
}
