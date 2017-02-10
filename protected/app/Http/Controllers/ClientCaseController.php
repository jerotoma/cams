<?php

namespace App\Http\Controllers;

use App\ClientCase;
use Illuminate\Http\Request;

class ClientCaseController extends Controller
{
    public function __construct()
    {
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
         return view('progress.cases.index');
    }
    public function getCasesList()
    {
        //
        $cases=ClientCase::all();
        $iTotalRecords =count(ClientCase::all());
        $sEcho = intval(10);

        $records = array();
        $records["data"] = array();


        $count=1;
        foreach($cases as $case) {
            $origin="";
            $status="";

            $vcolor="label-danger";


            $records["data"][] = array(
                $count++,
                $case->reference_number,
                $case->client->client_number,
                $case->client->full_name,
                $case->progress_number,
                $case->case_name,
                $case->referral_date,
                '<span class="text-center" id="'.$case->id.'">
                                        <a href="#" class="showRecord btn " > <i class="fa fa-eye green "></i> </a>
                                        <a href="#" class=" btn "> <i class="fa fa-print green " onclick="printPage(\''.url('cases').'/'.$case->id.'\');" ></i> </a>
                                        <a href="'.url('download/cases/form').'/'.$case->id.'" class=" btn  "> <i class="fa fa-download text-danger "></i> </a>
                </span>',
                '<span id="'.$cases->id.'">
                
                    <a href="#" title="Edit" class="btn btn-icon-only editRecord"> <i class="fa fa-edit text-primary">  </i> </a>
                    <a href="#" title="Delete" class="btn btn-icon-only  deleteRecord"> <i class="fa fa-trash text-danger"></i> </a>
                 </span>',
            );
        }


        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        echo json_encode($records);
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
