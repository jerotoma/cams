<?php

namespace App\Http\Controllers;

use App\DataVisualization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataVisualizationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function clients()
    {
        //
        return view('reports.clients.index');
    }
    public function showAssessments()
    {
        //
        return view('reports.assessments.index');
    }
    public function generateReport(Request $request)
    {   ob_clean();
        $end_time ="";
        $start_time="";
        if($request->start_date != ""){
            $start_time = date("Y-m-d", strtotime($request->start_date));
        }
        if($request->end_date != ""){
            $end_time = date("Y-m-d", strtotime($request->end_date));
        }


        $range = [$start_time, $end_time];
        $camp_id=$request->camp_id;
        $specific_needs= $request->specific_needs;
        $report_type=$request->report_type;
        $all_dates=$request->all_dates;
        //return view('reports.clients.registration',compact('range','start_time','end_time','camp_id'));

        if($report_type =="Registration by Category") {
            \Excel::create("Detailed_Registration_by_Category", function ($excel) use ($range, $start_time, $end_time, $camp_id) {
                $excel->sheet('sheet', function ($sheet) use ($range, $start_time, $end_time, $camp_id) {
                    $sheet->loadView('reports.clients.registration', compact('range', 'start_time', 'end_time', 'camp_id'));
                });
            })->download('xlsx');
        }elseif($report_type =="Population Planning Groups") {
            \Excel::create("Detailed_Population_Planning_Groups", function ($excel) use ($range, $start_time, $end_time, $camp_id,$all_dates) {
                $excel->sheet('sheet', function ($sheet) use ($range, $start_time, $end_time, $camp_id,$all_dates) {
                    $sheet->loadView('reports.clients.population', compact('range', 'start_time', 'end_time', 'camp_id','all_dates'));
                });
            })->download('xlsx');
        }elseif($report_type =="Specific needs provided") {
            \Excel::create("Detailed_specific_needs_provided", function ($excel) use ($range, $start_time, $end_time, $camp_id,$all_dates,$specific_needs) {
                $excel->sheet('sheet', function ($sheet) use ($range, $start_time, $end_time, $camp_id,$all_dates,$specific_needs) {
                    $sheet->loadView('reports.clients.specialneeds', compact('range', 'start_time', 'end_time', 'camp_id','all_dates','specific_needs'));
                });
            })->download('xlsx');
        }
        elseif($report_type =="All Registration Details") {
            \Excel::create("Detailed_PSN_Registration", function ($excel) use ($range, $start_time, $end_time, $camp_id,$all_dates,$specific_needs) {
                $excel->sheet('sheet', function ($sheet) use ($range, $start_time, $end_time, $camp_id,$all_dates,$specific_needs) {
                    $sheet->loadView('reports.clients.clients', compact('range', 'start_time', 'end_time', 'camp_id','all_dates','specific_needs'));
                });
            })->download('xlsx');
        }
        else{ return redirect()->back();}


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DataVisualization  $dataVisualization
     * @return \Illuminate\Http\Response
     */
    public function show(DataVisualization $dataVisualization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataVisualization  $dataVisualization
     * @return \Illuminate\Http\Response
     */
    public function edit(DataVisualization $dataVisualization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataVisualization  $dataVisualization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataVisualization $dataVisualization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataVisualization  $dataVisualization
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataVisualization $dataVisualization)
    {
        //
    }
}
