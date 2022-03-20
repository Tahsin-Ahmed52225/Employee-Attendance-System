<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Models
use App\Timer;

class TimerController extends Controller
{
    /*
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        return view("admin.in_and_out.index");
    }
    public function checkIn(Request $request)
    {
        if ($request->ajax()) {
            $check_id_checker = Timer::whereDate('check_in', now())->where('user_id', Auth::user()->id)->first();
            if ($check_id_checker) {
                $msg = "<div class='alert alert-warning fade show' role='alert'>"
                    . "Already Checked In Today
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>";

                return response()->json(array('msg' => $msg, 'stage' => false), 200);
            } else {
                Timer::create([

                    'user_id' => auth()->id(),

                    'check_in' => now(),

                    'check_out' => null,

                    'total_time' => null,

                    'update_status' => false,

                ]);

                $msg = "<div class='alert alert-success fade show' role='alert'>"
                    . "Checked in Successfully
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>";

                return response()->json(array('msg' => $msg, 'stage' => true), 200);
            }
        } else {
            $msg = "<div class='alert alert-danger fade show' role='alert'>"
                . "Somthing went wrong
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>";

            return response()->json(array('msg' => $msg, 'stage' => false), 200);
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
                return response()->json(array('msg' => $msg, 'stage' => false), 200);
            } else {
                $timer = Timer::whereDate('check_in', now())->where('user_id', Auth::user()->id)->first();
                if ($timer && $timer->check_out == null) {
                    if ($request->description != "") {
                        $timer->check_out = now();
                        $timer->total_time = $timer->check_out->diffInMinutes($timer->check_in);
                        $timer->daily_update = $request->description;
                        $timer->status = ($request->type == "TIMER") ? "FD" : "HO";
                        $timer->save();
                        $msg = "<div class='alert alert-success fade show' role='alert'>"
                            . $request->hr . " Hour " . $request->min . " Min added to today
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>";
                        return response()->json(array('msg' => $msg, 'stage' => true), 200);
                    } else {
                        $msg = "<div class='alert alert-warning fade show' role='alert'>"
                            .  " Daily Update is required
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>";
                        return response()->json(array('msg' => $msg, 'stage' => false), 200);
                    }
                } else {
                    $msg = "<div class='alert alert-warning fade show' role='alert'>"
                        . " You have to check in first
                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>";
                    return response()->json(array('msg' => $msg, 'stage' => false), 200);
                }
            }
        } else {
            $msg = "<div class='alert alert-danger fade show' role='alert'>"
                . " Something went wrong
                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>";
            return response()->json(array('msg' => $msg, 'stage' => false), 200);
        }
    }
}
