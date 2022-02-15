<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Models
use App\Timer;

class TimerController extends Controller
{
    /*
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        return view("admin.in_and_out.timer");
    }
    public function checkIn(Request $request)
    {
        if ($request->isMethod("POST")) {
        }
    }
    public function checkOut(Request $request)
    {
        if ($request->ajax()) {
            if ($request->hr == "00" && $request->min == "00") {
                $msg = "<div class='alert alert-warning fade show' role='alert'>
                            Less than one minite will not be added
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>";
            } else {
                $new_count = Timer::create([

                    'user_id' => auth()->id(),

                    'check_in' => $request->description,

                    'check_out' => (int) $request->hr,

                    'total_time' => (int) $request->min,

                ]);


                $msg = "<div class='alert alert-success fade show' role='alert'>"
                    . $request->hr . " Hour " . $request->min . " Min added to today
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>";
            }
            return response()->json(array('msg' => $msg), 200);
        } else {
            return redirect()->route('tdg.dashboard');
        }
    }
}
