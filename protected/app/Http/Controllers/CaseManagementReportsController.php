<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaseManagementReportsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //

    public function index()
    {//
        return view('reports.cases.index');
    }
    public function showGenerate()
    {//
        return view('reports.clients.generate');
    }
    public function generateReport(Request $request)
    {   ob_clean();
        $query=\DB::table('client_cases');
        $end_time ="";
        $start_time="";
        if($request->start_date != ""){
            $start_time = date("Y-m-d", strtotime($request->start_date));
        }
        if($request->end_date != ""){
            $end_time = date("Y-m-d", strtotime($request->end_date));
        }
        if($start_time != "" && $end_time !=""){
            $range = [$start_time, $end_time];
            $query->whereBetween('open_date', $range);
        }
        elseif($start_time != "" && $end_time ==""){
            $query->where('open_date', $start_time);
        }
        elseif($start_time == "" && $end_time !=""){
            $query->where('open_date', $end_time);
        }
        else{
            $query->where('open_date', null);
        }

        if($request->case_type != ""){
            $query->where('case_type','LIKE',"%{$request->case_type}%");
        }
        if($request->case_worker_name != ""){
            $query->where('case_worker_name','LIKE',"%{$request->case_worker_name}%");
        }

        $cases = $query->get();

        if($start_time != "" && $end_time !=""){
            //Export now
            switch ($request->report_type) {
                case 1:

                    if ($request->export_type == 1) {
                        return view('reports.cases.html.cases', compact('request','cases'));
                    } elseif ($request->export_type == 2) {

                        \Excel::create("list_of_cases_with_full_details", function ($excel) use ($request,$cases) {
                            $excel->sheet('sheet', function ($sheet) use ($request,$cases) {
                                $sheet->loadView('reports.cases.excel.cases', compact('request','cases'));
                                $sheet->setWidth(array(
                                    'B'     =>  20,
                                    'E'     =>  50,
                                    'F'     =>  50,
                                    'G'     =>  50,
                                    'H'     =>  50

                                ));
                                $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
                            });
                        })->download('xlsx');
                    }
                    break;
                default:
                    return redirect()->back()->with('message',"Selection not found");

            }
        }
        else {

            return redirect()->back()->with('message',"Please select date range");
        }

    }
}
