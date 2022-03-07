<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Custom models
use App\HomeOffice;

class AdminHomeOfficeController extends Controller
{
    /**
     * View all the (Pending) Home Office applications
     *
     * @return view admin.home_office.index
     */

    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            $home_office_records = HomeOffice::where('ho_status', 'Pending')->orderBy('created_at', 'desc')->get();
            return view("admin.home_office.index", ['home_office_records' => $home_office_records]);
        }
    }
    /**
     * View all the Home Office applications by user
     *
     * @return view admin.home_office.view
     */
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("admin.home_office.view");
        }
    }
    /**
     * Accept and Reject Home Office applications
     *
     * @return view admin.home_office.index with success or warning message
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod("POST")) {
            $ho = HomeOffice::find(decrypt($id));
            if ($ho) {
                $ho->ho_status = $request->ho_status;
                $ho->save();
                return redirect()->back()->with('success', 'Response has been sent');
            } else {
                return redirect()->back()->with('warning', 'Something went wrong');
            }
        }
    }
}
