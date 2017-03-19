<?php

namespace App\Http\Controllers;

use App\ItemsInventory;
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


        switch ($request->report_type){
            case 1:
                $query=\DB::table('items_disbursement_items');
                if($start_time != "" && $end_time !=""){
                    $range = [$start_time, $end_time];
                    $query->whereBetween('items_disbursement_items.distribution_date', $range);
                }
                if($start_time == "" && $end_time !=""){

                    $query->where('items_disbursement_items.distribution_date', $end_time);
                }
                if($start_time != "" && $end_time ==""){
                    $query->where('items_disbursement_items.distribution_date', $start_time);
                }
                if ($request->items !="All"){
                    $query->where('items_disbursement_items.item_id', $request->items);
                }
                if($request->camp_id != "All"){
                    $query->join('items_disbursements', 'items_disbursement_items.distribution_id', '=', 'items_disbursements.id')
                        ->where('items_disbursements.camp_id', $request->camp_id);
                }

                $query->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                    ->select('clients.*','items_disbursement_items.item_id','quantity','items_disbursement_items.distribution_date');
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
                $query=\DB::table('cash_provision_clients');

                if($request->camp_id != "All"){
                    $query->join('cash_provisions', 'cash_provision_clients.provision_id', '=', 'cash_provisions.id')
                        ->where('cash_provisions.camp_id', $request->camp_id)
                        ->select('cash_provision_clients.*');
                }
                if($start_time != "" && $end_time !=""){
                    $range = [$start_time, $end_time];
                    $query->whereBetween('cash_provision_clients.provision_date', $range);
                }
                if($start_time == "" && $end_time !=""){

                    $query->where('cash_provision_clients.provision_date', $end_time);
                }
                if($start_time != "" && $end_time ==""){
                    $query->where('cash_provision_clients.provision_date', $start_time);
                }


                $query->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                    ->select('clients.*','cash_provision_clients.activity_id','amount','cash_provision_clients.provision_date');
                $clients= $query->get();

                if($start_time == "" && $end_time =="") {
                    return redirect()->back();
                }else{
                    if ($request->export_type == 1) {
                        return view('reports.nfis.html.cashclients', compact('request', 'clients'));
                    } else {
                        \Excel::create("List_of_Clients_Received_Cash", function ($excel) use ($request, $clients) {
                            $excel->sheet('sheet', function ($sheet) use ($request, $clients) {
                                $sheet->loadView('reports.nfis.excel.cashclients', compact('request', 'clients'));
                            });
                        })->download('xlsx');
                    }
                }
                break;
            case 3:

                    if ($start_time == "" && $end_time == "" || $request->items =="All") {
                        return redirect()->back()->with('message',"Please select Client arrival date range and NFIs Item in order to generate the list of clients");
                    } else {

                        $query = \DB::table('clients');
                        if ($request->camp_id != "" && $request->camp_id != "All") {
                            $query->where('camp_id', '=', "$request->camp_id");
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
                        else{
                            $query->where('date_arrival', null);
                        }
                        $clients = $query->get();

                        if ($request->export_type == 1) {
                            return view('reports.nfis.html.itemsclients', compact('request', 'clients'));
                        } else {
                            \Excel::create("List_of_clients_for_items_distributions", function ($excel) use ($request, $clients) {
                                $excel->sheet('sheet', function ($sheet) use ($request, $clients) {
                                    $sheet->loadView('reports.nfis.excel.itemsclients', compact('request', 'clients'));
                                });
                            })->download('xlsx');
                        }
                    }

                break;
            case 4:
                if($start_time == "" && $end_time =="" || $request->activity =="All") {
                    return redirect()->back()->with('message',"Please select Client arrival date range and Cash Activity/Project");
                }else{
                    $query=\DB::table('clients');
                    $range = [$start_time, $end_time];
                    if($request->camp_id != "" && $request->camp_id !="All"){
                        $query->where('camp_id','=',"$request->camp_id");
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
                    else{
                        $query->where('date_arrival', null);
                    }

                    $clients= $query->get();
                    if ($request->export_type == 1) {
                        return view('reports.nfis.html.cashclients', compact('request', 'clients'));
                    } else {
                        \Excel::create("List_of_clients_for_cash_distributions", function ($excel) use ($request, $clients) {
                            $excel->sheet('sheet', function ($sheet) use ($request, $clients) {
                                $sheet->loadView('reports.nfis.excel.cashclients', compact('request', 'clients'));
                            });
                        })->download('xlsx');
                    }
                }
                break;
            case 5:
                if($start_time == "" && $end_time =="") {
                    return redirect()->back();
                }else{
                    $range = [$start_time, $end_time];
                    if ($request->export_type == 1) {
                        return view('reports.nfis.html.distributions', compact('request','range'));
                    } else {
                        \Excel::create("Item_distribution_per_population_report", function ($excel) use ($request,$range) {
                            $excel->sheet('sheet', function ($sheet) use ($request,$range) {
                                $sheet->loadView('reports.nfis.excel.distributions', compact('request','range'));
                            });
                        })->download('xlsx');
                    }
                }
                break;
            case 6:
                if($start_time == "" && $end_time =="") {
                    return redirect()->back()->with('message',"Please select date range");
                }else{
                    $range = [$start_time, $end_time];
                    if ($request->export_type == 1) {
                        return view('reports.nfis.html.population', compact('request','range'));
                    } else {
                        \Excel::create("CashGrant_per_population_report", function ($excel) use ($request,$range) {
                            $excel->sheet('sheet', function ($sheet) use ($request,$range) {
                                $sheet->loadView('reports.nfis.excel.population', compact('request','range'));
                            });
                        })->download('xlsx');
                    }
                }
                break;
            case 7:
                $items=ItemsInventory::where('quantity','<=',0)->get();
                if ($request->export_type == 1) {
                    return view('reports.nfis.html.items', compact('request', 'items'));
                } else {
                    \Excel::create("List_of_out_of_Stock", function ($excel) use ($request, $items) {
                        $excel->sheet('sheet', function ($sheet) use ($request, $items) {
                            $sheet->loadView('reports.nfis.excel.items', compact('request', 'items'));
                        });
                    })->download('xlsx');
                }
                break;
            case 8:
                $items=ItemsInventory::all();
                if ($request->export_type == 1) {
                    return view('reports.nfis.html.items', compact('request', 'items'));
                } else {
                    \Excel::create("List_of_All_Items", function ($excel) use ($request, $items) {
                        $excel->sheet('sheet', function ($sheet) use ($request, $items) {
                            $sheet->loadView('reports.nfis.excel.items', compact('request', 'items'));
                        });
                    })->download('xlsx');
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
