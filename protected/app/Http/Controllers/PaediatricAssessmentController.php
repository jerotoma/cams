<?php

namespace App\Http\Controllers;

use App\Client;
use App\PaediatricAssessment;
use App\PaediatricAssessmentHistory;
use App\PaediatricChildGrowth;
use App\PaediatricChildHistory;
use App\PaediatricChildInspection;
use App\PaediatricChildInspectionResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

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
        try {
            $validator = Validator::make($request->all(), [
                'client_id' => 'required',
                'full_name' => 'required',
                'unique_number' => 'required|unique:paediatric_assessments',
                'birth_date' => 'required',
                'father_phone' => 'required',
                'father_name' => 'required',
                'nationality' => 'required',
                'father_age' => 'numeric',
                'mother_age' => 'numeric',
                'total_children_alive' => 'numeric',
                'total_children_dead' => 'numeric',
                'total_children' => 'numeric',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {


                $assessment =new PaediatricAssessment;
                $assessment->client_id=$request->client_id;
                $assessment->full_name=$request->full_name;
                $assessment->rational_number=$request->rational_number;
                $assessment->unique_number=$request->unique_number;
                $assessment->home_name=$request->home_name;
                $assessment->sex=$request->sex;
                $assessment->birth_date=date("Y-m-d",strtotime($request->birth_date));
                $assessment->father_name=$request->father_name;
                $assessment->father_job=$request->father_job;
                $assessment->father_phone=$request->father_phone;
                $assessment->father_age=$request->father_age;
                $assessment->mother_name=$request->mother_name;
                $assessment->mother_job=$request->mother_job;
                $assessment->mother_phone=$request->mother_phone;
                $assessment->mother_age=$request->mother_age;
                $assessment->permanent_address=$request->permanent_address;
                $assessment->school_status=$request->school_status;
                $assessment->school_reasons=$request->school_reasons;
                $assessment->nationality=$request->nationality;
                $assessment->domicile=$request->domicile;
                $assessment->communication=$request->communication;
                $assessment->total_children=$request->total_children_alive + $request->total_children_dead;
                $assessment->total_children_alive=$request->total_children_alive;
                $assessment->total_children_dead=$request->total_children_dead;
                $assessment->created_by=Auth::user()->id;
                $assessment->save();

                $history=new PaediatricAssessmentHistory;
                $history->assessment_id=$assessment->id;
                $history->place_born=$request->place_born;
                $history->mother_pregnant_complications=$request->mother_pregnant_complications;
                $history->mother_birth_complications=$request->mother_birth_complications;
                $history->child_birth_condition=$request->child_birth_condition;
                $history->mother_labor_days=$request->mother_labor_days;
                $history->was_child_cry=$request->was_child_cry;
                $history->save();

                $childHistory=new PaediatricChildHistory;
                $childHistory->assessment_id=$assessment->id;
                $childHistory->child_complications=$request->child_complications;
                $childHistory->child_complication_1=$request->child_complication_1;
                $childHistory->child_complication_2=$request->child_complication_2;
                $childHistory->save();

                $childGrowth=new PaediatricChildGrowth;
                $childGrowth->assessment_id=$assessment->id;
                $childGrowth->sitting=$request->sitting;
                $childGrowth->crowing=$request->crowing;
                $childGrowth->standing=$request->standing;
                $childGrowth->walking=$request->walking;
                $childGrowth->talking=$request->talking;
                $childGrowth->child_self_expression=$request->child_self_expression;
                $childGrowth->save();

                $count=0;
                foreach ($request->area as $area) {
                    if($area != "" && $request->investigation_type[$count] !="") {
                        $childInspection = new PaediatricChildInspection;
                        $childInspection->assessment_id = $assessment->id;
                        $childInspection->area = $area;
                        $childInspection->investigation_type = $request->investigation_type[$count];
                        $childInspection->results = $request->results[$count];
                        $childInspection->save();
                    }
                }

                $childInspectionResults=new PaediatricChildInspectionResult;
                $childInspectionResults->assessment_id=$assessment->id;
                $childInspectionResults->child_ability=$request->child_ability;
                $childInspectionResults->child_special_need=$request->child_special_need;
                $childInspectionResults->long_term_plan=$request->long_term_plan;
                $childInspectionResults->short_term_plan=$request->short_term_plan;
                $childInspectionResults->consultation=$request->consultation;
                $childInspectionResults->provider_name=$request->provider_name;
                $childInspectionResults->provider_designation=$request->provider_designation;
                $childInspectionResults->provider_date=date("Y-m-d",strtotime($request->provider_date));
                $childInspectionResults->source_name=$request->source_name;
                $childInspectionResults->source_designation=$request->source_designation;
                $childInspectionResults->source_date=date("Y-m-d",strtotime($request->source_date));
                $childInspectionResults->centre_name=$request->centre_name;
                $childInspectionResults->save();

                return response()->json([
                    'success' => true,
                    'message' => "Record saved"
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
        $assessment=PaediatricAssessment::findorfail($id);
        return view('assessments.paediatric.show',compact('assessment'));
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
        $assessment=PaediatricAssessment::findorfail($id);
        return view('assessments.paediatric.edit',compact('assessment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clearForms($id)
    {
        $assessment = PaediatricAssessment::find($id);
        if ($assessment->assessmentHistory){
            $assessment->assessmentHistory->delete();
        }
        if ($assessment->childHistory){
            $assessment->childHistory->delete();
        }
        if ($assessment->childGrowth){
            $assessment->childGrowth->delete();
        }
        foreach ($assessment->childInspection as $item){
            $item->delete();
        }
        if ($assessment->childInspectionResult){
            $assessment->childInspectionResult->delete();
        }
    }
    public function update(Request $request, $id)
    {
        //
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'unique_number' => 'required|unique:paediatric_assessments,unique_number,'.$id,
                'birth_date' => 'required',
                'father_phone' => 'required',
                'father_name' => 'required',
                'nationality' => 'required',
                'father_age' => 'numeric',
                'mother_age' => 'numeric',
                'total_children_alive' => 'numeric',
                'total_children_dead' => 'numeric',
                'total_children' => 'numeric',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {


                $assessment = PaediatricAssessment::find($id);
                $assessment->full_name=$request->full_name;
                $assessment->rational_number=$request->rational_number;
                $assessment->unique_number=$request->unique_number;
                $assessment->home_name=$request->home_name;
                $assessment->sex=$request->sex;
                $assessment->birth_date=date("Y-m-d",strtotime($request->birth_date));
                $assessment->father_name=$request->father_name;
                $assessment->father_job=$request->father_job;
                $assessment->father_phone=$request->father_phone;
                $assessment->father_age=$request->father_age;
                $assessment->mother_name=$request->mother_name;
                $assessment->mother_job=$request->mother_job;
                $assessment->mother_phone=$request->mother_phone;
                $assessment->mother_age=$request->mother_age;
                $assessment->permanent_address=$request->permanent_address;
                $assessment->school_status=$request->school_status;
                $assessment->school_reasons=$request->school_reasons;
                $assessment->nationality=$request->nationality;
                $assessment->domicile=$request->domicile;
                $assessment->communication=$request->communication;
                $assessment->total_children=$request->total_children_alive + $request->total_children_dead;
                $assessment->total_children_alive=$request->total_children_alive;
                $assessment->total_children_dead=$request->total_children_dead;
                $assessment->created_by=Auth::user()->id;
                $assessment->save();

                $this->clearForms($assessment->id);

                $history=new PaediatricAssessmentHistory;
                $history->assessment_id=$assessment->id;
                $history->place_born=$request->place_born;
                $history->mother_pregnant_complications=$request->mother_pregnant_complications;
                $history->mother_birth_complications=$request->mother_birth_complications;
                $history->child_birth_condition=$request->child_birth_condition;
                $history->mother_labor_days=$request->mother_labor_days;
                $history->was_child_cry=$request->was_child_cry;
                $history->save();

                $childHistory=new PaediatricChildHistory;
                $childHistory->assessment_id=$assessment->id;
                $childHistory->child_complications=$request->child_complications;
                $childHistory->child_complication_1=$request->child_complication_1;
                $childHistory->child_complication_2=$request->child_complication_2;
                $childHistory->save();

                $childGrowth=new PaediatricChildGrowth;
                $childGrowth->assessment_id=$assessment->id;
                $childGrowth->sitting=$request->sitting;
                $childGrowth->crowing=$request->crowing;
                $childGrowth->standing=$request->standing;
                $childGrowth->walking=$request->walking;
                $childGrowth->talking=$request->talking;
                $childGrowth->child_self_expression=$request->child_self_expression;
                $childGrowth->save();

                $count=0;
                foreach ($request->area as $area) {
                    if($area != "" && $request->investigation_type[$count] !="") {
                        $childInspection = new PaediatricChildInspection;
                        $childInspection->assessment_id = $assessment->id;
                        $childInspection->area = $area;
                        $childInspection->investigation_type = $request->investigation_type[$count];
                        $childInspection->results = $request->results[$count];
                        $childInspection->save();
                    }
                }

                $childInspectionResults=new PaediatricChildInspectionResult;
                $childInspectionResults->assessment_id=$assessment->id;
                $childInspectionResults->child_ability=$request->child_ability;
                $childInspectionResults->child_special_need=$request->child_special_need;
                $childInspectionResults->long_term_plan=$request->long_term_plan;
                $childInspectionResults->short_term_plan=$request->short_term_plan;
                $childInspectionResults->consultation=$request->consultation;
                $childInspectionResults->provider_name=$request->provider_name;
                $childInspectionResults->provider_designation=$request->provider_designation;
                $childInspectionResults->provider_date=date("Y-m-d",strtotime($request->provider_date));
                $childInspectionResults->source_name=$request->source_name;
                $childInspectionResults->source_designation=$request->source_designation;
                $childInspectionResults->source_date=date("Y-m-d",strtotime($request->source_date));
                $childInspectionResults->centre_name=$request->centre_name;
                $childInspectionResults->save();

                return response()->json([
                    'success' => true,
                    'message' => "Record saved"
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
        $assessment = PaediatricAssessment::find($id);
        $assessment->delete();
    }
}
