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
        $start_time = date("Y-m-d", strtotime($request->start_time));
        $end_time = date("Y-m-d", strtotime($request->end_time));
        $range = [$start_time, $end_time];
        $codes=$request->vulnerability_code;

        \Excel::create("Detailed_Registration_by_Category", function ($excel) use ($codes,$range,$start_time,$end_time) {
            $excel->sheet('sheet', function ($sheet) use ($codes,$range) {
                $sheet->loadView('reports.clients.registration',compact('range','codes','end_time','start_time'));
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
