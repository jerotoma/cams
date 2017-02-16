<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class ClientReportsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //
    public function index()
    {//
        return view('reports.clients.index');
    }
    public function showGenerate()
    {//
        return view('reports.clients.generate');
    }
    public function postGenerate(Request $request)
    {//
        $start_time = date("Y-m-d", strtotime($request->start_date));
        $end_time = date("Y-m-d", strtotime($request->end_date));
        $range = [$start_time, $end_time];
        $camp_id=$request->camp_id;

        \Excel::create("Detailed_Registration_by_Category", function ($excel) use ($range,$start_time,$end_time,$camp_id) {
            $excel->sheet('sheet', function ($sheet) use ($range,$start_time,$end_time,$camp_id) {
                $sheet->loadView('reports.clients.registration',compact('range','start_time','end_time','camp_id'));
                $sheet->setWidth(array(
                    'A'     =>  30,
                    'B'     =>  25,
                ));
                $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
                // $sheet->setAutoFilter('E2:F2');
            });
        })->download('xlsx');

    }
}
