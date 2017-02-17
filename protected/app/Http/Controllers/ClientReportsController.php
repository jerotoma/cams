<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
    { $start_time = date("Y-m-d", strtotime($request->start_date));
        $end_time = date("Y-m-d", strtotime($request->end_date));
        $range = [$start_time, $end_time];
        $camp_id=$request->camp_id;
        //return view('reports.clients.registration',compact('range','start_time','end_time','camp_id'));
        Excel::create('Laravel Excel', function($excel) {

            $excel->sheet('Excel sheet', function($sheet) {

                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }
}