<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \PDF;

class PdfGerneratorController extends Controller
{
    /**
     * Generating Monthly Report
     *
     * @return
     */
    public function index(Request $request ,$month ,$year){
        if($request->isMethod("GET")){
            // $pdf = PDF::loadView('pdf', compact('data'));
            // return $pdf->download('report.pdf', array('Attachment' => 0));


        }else{
            return redirect()->back();
        }
    }

}
