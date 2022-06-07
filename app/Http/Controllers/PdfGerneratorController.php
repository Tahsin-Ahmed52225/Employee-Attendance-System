<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \PDF;

//Custom modal
use App\Timer;
use Carbon\Carbon;

class PdfGerneratorController extends Controller
{
    /**
     * Generating Monthly Report
     *
     * @return
     */
    public function index(Request $request ,$month ,$year){
        if($request->isMethod("GET")){
            if($month == -1 || $year == -1){
                return redirect()->back()->with('warning', 'Choose valid month and year');
            }
            $data = Timer::where('user_id', auth()->id())
                ->where('daily_update', '!=', null)
                ->where('check_out', "!=", null)
                ->whereMonth('check_out', $month)
                ->whereYear('check_out', $year)
                ->join("users", "users.id", "=", "timesheet.user_id")
                ->orderBy('timesheet.check_out', 'desc')
                ->get(['users.name', 'timesheet.*']);
            $month = Carbon::create()->day(1)->month($month)->format("M");
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf/monthlyReport', ['data' => $data , 'month' => $month , 'year' => $year , 'user' => auth()->user()]);
            return $pdf->stream(str_replace(' ', '-', auth()->user()->name)."-".$month."-".$year.'.pdf', array('Attachment' => 0));
            // return $pdf->download('report.pdf', array('Attachment' => 0));


        }else{
            return redirect()->back();
        }
    }

}
