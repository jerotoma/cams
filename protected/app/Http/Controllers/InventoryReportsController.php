<?php

namespace App\Http\Controllers;

use App\MateriaSupport;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class InventoryReportsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('reports.nfis.index');
    }
    public function showReportView()
    {
        //
        return view('reports.inventory.generate');
    }

    public function generateReport(Request $request)
    {   ob_clean();

        $query=\DB::table('items_disbursement_items');
        $end_time ="";
        $start_time="";
        if($request->start_date != ""){
            $start_time = date("Y-m-d", strtotime($request->start_date));
        }
        if($request->end_date != ""){
            $end_time = date("Y-m-d", strtotime($request->end_date));
        }
        if($request->start_date != ""){
            $start_time = date("Y-m-d", strtotime($request->start_date));
        }
        if($request->end_date != ""){
            $end_time = date("Y-m-d", strtotime($request->end_date));
        }
        if($start_time != "" && $end_time !=""){
            $range = [$start_time, $end_time];
            $query->whereBetween('items_disbursement_items.distribution_date', $range);
        }
        if($start_time == "" && $end_time !=""){

            $query->where('distribution_date', $end_time);
        }
        if($start_time != "" && $end_time ==""){
            $query->where('distribution_date', $start_time);
        }
        if ($request->items !="All"){
            $query->where('items_disbursement_items.item_id', $request->items);
        }
        if($request->camp_id != "All"){
            $query->join('items_disbursements', 'items_disbursement_items.distribution_id', '=', 'items_disbursements.id')
                ->where('items_disbursements.camp_id', $request->camp_id);
        }

        switch ($request->report_type){
            case 1:
                $query->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                    ->select('clients.*','item_id','quantity','distribution_date');
                $clients= $query->get();

                if($start_time == "" && $end_time =="") {
                    return redirect()->back();
                }else{
                    if ($request->export_type == 1) {
                        return view('reports.nfis.html.clients', compact('request', 'clients'));
                    } else {
                        \Excel::create("List_of_Clients_Received_Items", function ($excel) use ($request, $clients) {
                            $excel->sheet('sheet', function ($sheet) use ($request, $clients) {
                                $sheet->loadView('reports.nfis.excel.clients', compact('request', 'clients'));
                            });
                        })->download('xlsx');
                    }
                }
                break;
            case 2:
                $query->join('clients', 'items_disbursement_items.client_id', '<>', 'clients.id')
                    ->select('clients.*','item_id','quantity','distribution_date');
                $clients= $query->get();

                if($start_time == "" && $end_time =="") {
                    return redirect()->back();
                }else{
                    if ($request->export_type == 1) {
                        return view('reports.nfis.html.registration', compact('request', 'clients'));
                    } else {
                        \Excel::create("List_of_Clients_report", function ($excel) use ($request, $clients) {
                            $excel->sheet('sheet', function ($sheet) use ($request, $clients) {
                                $sheet->loadView('reports.nfis.excel.registration', compact('request', 'clients'));
                            });
                        })->download('xlsx');
                    }
                }
                break;
            case 3:
                if($start_time == "" && $end_time =="") {
                    return redirect()->back();
                }else{
                    $range = [$start_time, $end_time];
                    if ($request->export_type == 1) {
                        return view('reports.nfis.html.population', compact('request','range'));
                    } else {
                        \Excel::create("List_of_Clients_report", function ($excel) use ($request,$range) {
                            $excel->sheet('sheet', function ($sheet) use ($request,$range) {
                                $sheet->loadView('reports.nfis.excel.population', compact('request','range'));
                            });
                        })->download('xlsx');
                    }
                }
                break;
            case 4:
                break;
            case 5:
                break;
            case 6:
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
