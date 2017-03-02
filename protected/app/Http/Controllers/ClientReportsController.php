<?php

namespace App\Http\Controllers;

use App\Client;
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
    {   ob_clean();
        $query=\DB::table('clients');
        $end_time ="";
        $start_time="";
        if($request->start_date != ""){
            $start_time = date("Y-m-d", strtotime($request->start_date));
        }
        if($request->end_date != ""){
            $end_time = date("Y-m-d", strtotime($request->end_date));
        }
        if($request->hai_reg_no != ""){
            $query->where('hai_reg_number','LIKE',"%{$request->hai_reg_no}%");
        }
        if($request->unique_id != ""){
            $query->where('client_number','LIKE',"%{$request->unique_id}%");
        }
        if($request->full_name != ""){
            $query->where('full_name','LIKE',"%{$request->full_name}%");
        }
        if($request->sex != "" && $request->sex != "All"){
            $query->where('sex','=',"$request->sex");
        }
        if($request->age_score != ""){
            $query->where('age_score','=',"$request->age_score");
        }
        if($request->ration_card_number != ""){
            $query->where('ration_card_number','LIKE',"%{$request->ration_card_number}%");
        }
        if($request->ration_card_number != ""){
            $query->where('present_address','LIKE',"%{$request->present_address}%");
        }
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

        if ($request->specific_needs != "All" && $request->specific_needs !=""){

            $query->join('client_vulnerability_codes', 'clients.id', '=', 'client_vulnerability_codes.client_id')
                ->where('code_id', '=', "$request->specific_needs")
                ->select('clients.*');
        }

        $clients = $query->get();


        //Export now
        switch ($request->report_type)
        {
            case 1:
                if($request->export_type ==1){
                    return view('reports.clients.html.registration_by_category',compact('request'));
                }
                elseif($request->export_type ==2){

                    \Excel::create("registration_by_category_report", function($excel) use($request)  {
                        $excel->sheet('sheet', function($sheet) use($request){
                            $sheet->loadView('reports.clients.excel.registration_by_category',compact('request'));
                            $sheet->setWidth(array(
                                'A'     =>  50,
                                'B'     =>  10,
                                'C'     =>  10,
                                'D'     =>  10,
                                'E'     =>  10,
                                'F'     =>  10,
                                'G'     =>  10,
                                'H'     =>  10,
                                'I'     =>  10,
                                'J'     =>  10,
                                'K'     =>  10,
                                'L'     =>  10,
                                'M'     =>  10,
                                'N'     =>  10,
                                'O'     =>  10,
                                'P'     =>  10,
                                'Q'     =>  10,
                                'R'     =>  10,
                                'S'     =>  10,
                                'T'     =>  10
                            ));
                            $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
                            // $sheet->setAutoFilter('E2:F2');
                        });
                    })->download('xlsx');
                }
                break;
            case  2:
                if($request->export_type ==1){
                    return view('reports.clients.html.population',compact('request'));
                }
                elseif($request->export_type ==2){

                    \Excel::create("registration_by_population_group", function($excel) use($request)  {
                        $excel->sheet('sheet', function($sheet) use($request){
                            $sheet->loadView('reports.clients.excel.population',compact('request'));
                            $sheet->setWidth(array(
                                'A'     =>  50,
                                'B'     =>  10,
                                'C'     =>  10,
                                'D'     =>  10,
                                'E'     =>  10,
                                'F'     =>  10,
                                'G'     =>  10,
                                'H'     =>  10,
                                'I'     =>  10,
                                'J'     =>  10,
                                'K'     =>  10,
                                'L'     =>  10,
                                'M'     =>  10,
                                'N'     =>  10,
                                'O'     =>  10,
                                'P'     =>  10,
                                'Q'     =>  10,
                                'R'     =>  10,
                                'S'     =>  10,
                                'T'     =>  10
                            ));
                            $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
                            // $sheet->setAutoFilter('E2:F2');
                        });
                    })->download('xlsx');
                }
                break;
            case 3:
                if($request->export_type ==1){
                    return view('reports.clients.html.specialneeds',compact('request'));
                }
                elseif($request->export_type ==2){

                    \Excel::create("registration_by_specific_needs", function($excel) use($request)  {
                        $excel->sheet('sheet', function($sheet) use($request){
                            $sheet->loadView('reports.clients.excel.specialneeds',compact('request'));
                            $sheet->setWidth(array(
                                'A'     =>  50,
                                'B'     =>  10,
                                'C'     =>  10,
                                'D'     =>  10,
                                'E'     =>  10,
                                'F'     =>  10,
                                'G'     =>  10,
                                'H'     =>  10,
                                'I'     =>  10,
                                'J'     =>  10,
                                'K'     =>  10,
                                'L'     =>  10,
                                'M'     =>  10,
                                'N'     =>  10,
                                'O'     =>  10,
                                'P'     =>  10,
                                'Q'     =>  10,
                                'R'     =>  10,
                                'S'     =>  10,
                                'T'     =>  10
                            ));
                            $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
                            // $sheet->setAutoFilter('E2:F2');
                        });
                    })->download('xlsx');
                }
                break;
            case 4:
                if($request->export_type ==1){
                    return view('reports.clients.html.registration',compact('clients'));
                }
                elseif($request->export_type ==2){

                    \Excel::create("Client_registration_reports", function($excel) use($clients)  {
                        $excel->sheet('sheet', function($sheet) use($clients){
                            $sheet->loadView('reports.clients.excel.registration',compact('clients'));
                        });
                    })->download('xlsx');
                }
                break;
            default:
                return redirect()->back();

        }

    }

}
