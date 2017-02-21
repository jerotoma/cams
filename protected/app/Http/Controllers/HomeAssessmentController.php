<?php

namespace App\Http\Controllers;

use App\Client;
use App\HomeAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class HomeAssessmentController extends Controller
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
        return view('assessments.needs.index');
    }
    public function downloadPDF($id)
    {

        $assessment=HomeAssessment::findorfail($id);

         $pdf = \PDF::loadView('assessments.needs.show',compact('assessment'))
            ->setOption('footer-center', '[page]')
            ->setOption('page-offset', 0);
        return $pdf->download('PSN_Home_Assessments_form.pdf');
    }
    public function getPSNProfile($id)
    {
        $client=Client::findorfail($id);
        return view('assessments.needs.psnprofile',compact('client'));

    }

    public function showClients()
    {
        return view('assessments.needs.listclients');
    }
    public function getJSonAssessmentList()
    {
        //
        $assessments=HomeAssessment::all();
        $iTotalRecords =count(HomeAssessment::all());
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
                                        <a href="#" class=" btn "> <i class="fa fa-print green " onclick="printPage(\''.url('assessments/home').'/'.$assessment->id.'\');" ></i> </a>
                                        <a href="'.url('download/assessments/home').'/'.$assessment->id.'" class=" btn  "> <i class="fa fa-download text-danger "></i> </a>
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('assessments.needs.create');
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
        try {
            $validator = Validator::make($request->all(), [
                'client_id' => 'required',
                'assessment_date' => 'required',
                'case_code' => 'required'



            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $assessment = new HomeAssessment;
                $assessment->client_id = $request->client_id;
                $assessment->case_code = $request->case_code;
                $assessment->linked_case_code = $request->Linked_case_code;
                $assessment->assessment_date = $request->assessment_date;
                $assessment->needs_description = $request->needs_description;
                $assessment->findings = $request->findings;
                $assessment->diagnosis = $request->diagnosis;
                $assessment->recommendations = $request->recommendations;
                $assessment->final_decision = $request->final_decision;
                $assessment->case_worker_name = $request->case_worker_name;
                $assessment->project_coordinator = $request->project_coordinator;
                $assessment->organization = $request->organization;
                $assessment->save();
                return response()->json([
                    'success' => true,
                    'message' => "Saved Successful"
                ], 200);
            }
        }
        catch (\Exception $ex)
        {
            return Response::json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 402); // 400 being the HTTP code for an invalid request.
        }

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
        $assessment=HomeAssessment::findorfail($id);
        return view('assessments.needs.show',compact('assessment'));
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
        $assessment=HomeAssessment::findorfail($id);
        return view('assessments.needs.edit',compact('assessment'));
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
        try {
            $validator = Validator::make($request->all(), [
                'assessment_date' => 'required',
                'case_code' => 'required'



            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $assessment =  HomeAssessment::find($id);
                $assessment->case_code = $request->case_code;
                $assessment->linked_case_code = $request->Linked_case_code;
                $assessment->assessment_date = $request->assessment_date;
                $assessment->needs_description = $request->needs_description;
                $assessment->findings = $request->findings;
                $assessment->diagnosis = $request->diagnosis;
                $assessment->recommendations = $request->recommendations;
                $assessment->final_decision = $request->final_decision;
                $assessment->case_worker_name = $request->case_worker_name;
                $assessment->project_coordinator = $request->project_coordinator;
                $assessment->organization = $request->organization;
                $assessment->save();
                return response()->json([
                    'success' => true,
                    'message' => "Saved Successful"
                ], 200);
            }
        }
        catch (\Exception $ex)
        {
            return Response::json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 402); // 400 being the HTTP code for an invalid request.
        }
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
        $assessment =  HomeAssessment::find($id);
        $assessment->delete();
    }
}
