<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Custom Models
use App\Timer;

class SearchController extends Controller
{
    public function searchDailyUpdate(Request $request)
    {

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
