<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessmentReportsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //

    public function index()
    {//
        return view('reports.assessments.index');
    }
    public function showGenerate()
    {//
        return view('reports.clients.generate');
    }
    public function generateReport(Request $request)
    {   ob_clean();


        //Export now
        switch ($request->report_type)
        {
            case 1:
                $query=\DB::table('vulnerability_assessments');
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
                    $query->whereBetween('q1_5', $range);
                }
                elseif($start_time != "" && $end_time ==""){
                    $query->where('q1_5', $start_time);
                }
                elseif($start_time == "" && $end_time !=""){
                    $query->where('q1_5', $end_time);
                }
                else{
                    $query->where('q1_5', null);
                }
                if($request->camp_id != "" && $request->camp_id !="All"){
                    $query->where('q1_3','=',"$request->camp_id");
                }
                if ($request->clients_needs != "All" && $request->clients_needs !=""){

                    $query->join('client_needs', 'vulnerability_assessments.id', '=', 'client_needs.assessment_id')
                        ->where('need_id', '=', $request->clients_needs)
                        ->where('client_needs.status', '=', "Yes")
                        ->select('vulnerability_assessments.*','need_id');
                }

                $assessment = $query->get();

                if($start_time != "" && $end_time !="") {
                    if ($request->export_type == 1) {
                        return view('reports.assessments.html.population', compact('request'));
                    } elseif ($request->export_type == 2) {

                        \Excel::create("registration_by_category_report", function ($excel) use ($request) {
                            $excel->sheet('sheet', function ($sheet) use ($request) {
                                $sheet->loadView('reports.assessments.excel.population', compact('request'));
                                $sheet->setWidth(array(
                                    'A' => 50,
                                    'B' => 10,
                                    'C' => 10,
                                    'D' => 10,
                                    'E' => 10,
                                    'F' => 10,
                                    'G' => 10,
                                    'H' => 10,
                                    'I' => 10,
                                    'J' => 10,
                                    'K' => 10,
                                    'L' => 10,
                                    'M' => 10,
                                    'N' => 10,
                                    'O' => 10,
                                    'P' => 10,
                                    'Q' => 10,
                                    'R' => 10,
                                    'S' => 10,
                                    'T' => 10
                                ));
                                $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
                                // $sheet->setAutoFilter('E2:F2');
                            });
                        })->download('xlsx');
                    }
                }
                else
                {
                    return redirect()->back();
                }
                break;
            case  2:
                $query=\DB::table('clients');
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
                    $query->whereBetween('date_arrival', $range);
                }
                elseif($start_time != "" && $end_time ==""){
                    $query->where('date_arrival', $start_time);
                }
                elseif($start_time == "" && $end_time !=""){
                    $query->where('date_arrival', $end_time);
                }
                if($request->camp_id != "" && $request->camp_id !="All"){
                    $query->where('camp_id','=',"$request->camp_id");
                }

                if($start_time != "" && $end_time !=""){

                    $query->join('vulnerability_assessments', 'clients.id', '<>', 'vulnerability_assessments.client_id')
                        ->select('clients.*');

                    $clients =$query->get();

                    if ($request->export_type == 1) {

                        return view('reports.assessments.html.clients', compact('clients', 'request'));
                    } elseif ($request->export_type == 2) {

                        \Excel::create("Clients_Without_Assessment_details", function ($excel) use ($request,$clients) {
                            $excel->sheet('sheet', function ($sheet) use ($request,$clients) {
                                $sheet->loadView('reports.assessments.excel.clients', compact('clients', 'request'));
                                // $sheet->setAutoFilter('E2:F2');
                            });
                        })->download('xlsx');
                    }
                }else
                {
                    return redirect()->back();
                }
                break;
            case 3:
                $query=\DB::table('clients');
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
                    $query->whereBetween('date_arrival', $range);
                }
                elseif($start_time != "" && $end_time ==""){
                    $query->where('date_arrival', $start_time);
                }
                elseif($start_time == "" && $end_time !=""){
                    $query->where('date_arrival', $end_time);
                }
                if($request->camp_id != "" && $request->camp_id !="All"){
                    $query->where('camp_id','=',"$request->camp_id");
                }
                if ($request->clients_needs != "All" && $request->clients_needs !=""){

                    $query->join('client_needs', 'client_needs.client_id', '=', 'clients.id')
                        ->where('client_needs.need_id', '=', $request->clients_needs)
                        ->where('client_needs.status', '=', "Yes")
                        ->select('clients.*');
                }

                if($start_time != "" && $end_time !=""){

                    $query->join('vulnerability_assessments', 'clients.id', '=', 'vulnerability_assessments.client_id')
                        ->select('clients.*');

                    $clients =$query->get();

                    if ($request->export_type == 1) {

                        return view('reports.assessments.html.clients', compact('clients', 'request'));
                    } elseif ($request->export_type == 2) {

                        \Excel::create("Clients_Assessment_details", function ($excel) use ($request,$clients) {
                            $excel->sheet('sheet', function ($sheet) use ($request,$clients) {
                                $sheet->loadView('reports.assessments.excel.clients', compact('clients', 'request'));
                                // $sheet->setAutoFilter('E2:F2');
                            });
                        })->download('xlsx');
                    }
                }else
                {
                    return redirect()->back();
                }
                break;
            default:
                return redirect()->back();

        }

    }
}
