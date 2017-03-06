<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferralReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('reports.referrals.index');
    }

    public function generateReport(Request $request)
    {   ob_clean();
        $query=\DB::table('client_referrals');
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
            $query->whereBetween('referral_date', $range);
        }
        elseif($start_time != "" && $end_time ==""){
            $query->where('referral_date', $start_time);
        }
        elseif($start_time == "" && $end_time !=""){
            $query->where('referral_date', $end_time);
        }
        else{
            $query->where('referral_date', null);
        }

        if ($request->progress_status != "All" && $request->progress_status !=""){

            $query->where('status', $request->progress_status);
        }
        if($request->camp_id != "" && $request->camp_id !="All"){
            $query->join('clients', 'client_referrals.client_id', '=', 'clients.id')
                ->where('clients.camp_id', '=', $request->camp_id)
                ->select('client_referrals.*');
        }

        $referrals = $query->get();


        //Export now
        switch ($request->report_type)
        {
            case 1:
                if($start_time != "" && $end_time !="") {
                    if ($request->export_type == 1) {
                        return view('reports.referrals.html.referrals', compact('referrals'));
                    } elseif ($request->export_type == 2) {

                        \Excel::create("list_of_referrals", function ($excel) use ($referrals) {
                            $excel->sheet('sheet', function ($sheet) use ($referrals) {
                                $sheet->loadView('reports.referrals.excel.referrals', compact('referrals'));
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
            default:
                return redirect()->back();

        }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
