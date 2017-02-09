<?php

namespace App\Http\Controllers;

use App\Client;
use App\PaediatricAssessment;
use Illuminate\Http\Request;

class PaediatricAssessmentController extends Controller
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
        $assessments =  PaediatricAssessment::all();
        return view('assessments.paediatric.index',compact('assessments'));

    }
    public function showClients()
    {
        return view('assessments.paediatric.listclients');
    }
    public function getJSonDataSearch()
    {
        //
        $assessments=PaediatricAssessment::all();
        $iTotalRecords =count(PaediatricAssessment::all());
        $sEcho = intval(10);

        $records = array();
        $records["data"] = array();


        $count=1;
        foreach($assessments as $assessment) {
            $origin="";
            $status="";

            $vcolor="label-danger";


            $records["data"][] = array(
                $count++,
                $assessment->client->client_number,
                $assessment->client->full_name,
                $assessment->client->sex,
                $assessment->client->age,
                '<span class="text-center" id="'.$assessment->id.'">
                                        <a href="#" class="showRecord btn " > <i class="fa fa-eye green "></i> </a>
                                        <a href="#" class=" btn "> <i class="fa fa-print green " onclick="printPage(\''.url('assessments/paediatric').'/'.$assessment->id.'\');" ></i> </a>
                                        <a href="'.url('paediatric-assessment/download').'/'.$assessment->id.'" class=" btn  "> <i class="fa fa-download text-danger "></i> </a>
                </span>',
                '<span id="'.$assessment->id.'">
                
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
    public function showClientPaediatric($id)
    {
        //
        $client =Client::find($id);

        if(is_object($client->pdlAssessment) && count($client->pdlAssessment) >0)
        {
            return $this->edit($client->pdlAssessment->id);
        }
        else
        {
            return view('assessments.paediatric.create',compact('client'));
        }
    }

    public function downloadForm($id)
    {
        //
        $assessment=PaediatricAssessment::find($id);
         $pdf = \PDF::loadView('assessments.paediatric.show', compact('assessment'))
            ->setOption('footer-center', '[page]')
            ->setOption('page-offset', 0)
            ->setOption('disable-smart-shrinking',true)->setOption('zoom','0.78');
        return $pdf->download('paediatric_assessment.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('assessments.paediatric.create');

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
