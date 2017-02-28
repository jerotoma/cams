<?php

namespace App\Http\Controllers;

use App\PCCashUsage;
use App\PCCashUsageCategory;
use App\PCCashWithdrawal;
use App\PCCommunalRelations;
use App\PCDemographicDetails;
use App\PCPhysicallyReceivingCash;
use App\PostCashAssessment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class PostCashMonitoringController extends Controller
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
        $assessments=PostCashAssessment::all();
        return view('cash.monitoring.index',compact('assessments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cash.monitoring.create');
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
                'camp_id' => 'required',
                'district_id' => 'required',
                'interview_date' => 'required|before:tomorrow',
                'interview_start_time' => 'required',
                'interview_end_time' => 'required',
                'enumerator_name' => 'required',
                'organisation' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $assessment=new PostCashAssessment;
                $assessment->client_id =$request->client_id;
                $assessment->camp_id =$request->camp_id;
                $assessment->district_id =$request->district_id;
                $assessment->interview_date =$request->interview_date;
                $assessment->interview_start_time =$request->interview_start_time;
                $assessment->interview_end_time =$request->interview_end_time;
                $assessment->organisation =$request->organisation;
                $assessment->enumerator_name =$request->enumerator_name;
                $assessment->respondent_name =$request->respondent_name;
                $assessment->enumerator_observations =$request->enumerator_observations;
                $assessment->created_by =Auth::user()->username;
                $assessment->save();

                $domographic=new PCDemographicDetails;
                $domographic->assessment_id=$assessment->id;
                $domographic->q2_1=$request->q2_1;
                $domographic->q2_2=$request->q2_2;
                $domographic->q2_3=$request->q2_3;
                $domographic->q2_4=$request->q2_4;
                $domographic->q2_5=$request->q2_5;
                $domographic->q2_6=$request->q2_6;
                $domographic->q2_7=$request->q2_7;
                $domographic->q2_8=$request->q2_8;
                $domographic->save();

                $withdraw=new PCCashWithdrawal;
                $withdraw->assessment_id =$assessment->id;
                $withdraw->q3_1 =$request->q3_1;
                $withdraw->q3_2 =$request->q3_2;
                $withdraw->q3_3 =$request->q3_3;
                $withdraw->q3_4 =$request->q3_4;
                $withdraw->q3_5 =$request->q3_5;
                $withdraw->q3_6 =$request->q3_6;
                $withdraw->save();

                $physical_receiving=new PCPhysicallyReceivingCash;
                $physical_receiving->assessment_id =$assessment->id;
                $physical_receiving->q4_1 =$request->q4_1;
                $physical_receiving->q4_2 =$request->q4_2;
                $physical_receiving->q4_3 =$request->q4_3;
                $physical_receiving->q4_4 =$request->q4_4;
                $physical_receiving->q4_5 =$request->q4_5;
                $physical_receiving->q4_6 =$request->q4_6;
                $physical_receiving->q4_7 =$request->q4_7;
                $physical_receiving->q4_8 =$request->q4_8;
                $physical_receiving->q4_9 =$request->q4_9;
                $physical_receiving->q4_10 =$request->q4_10;
                $physical_receiving->q4_10_1 =$request->q4_10_1;
                $physical_receiving->q4_11 =$request->q4_11;
                $physical_receiving->q4_12 =$request->q4_12;
                $physical_receiving->q4_13 =$request->q4_13;
                $physical_receiving->q4_14 =$request->q4_14;
                $physical_receiving->q4_15 =$request->q4_15;
                $physical_receiving->q4_16 =$request->q4_16;
                $physical_receiving->q4_17 =$request->q4_17;
                $physical_receiving->q4_18 =$request->q4_18;
                $physical_receiving->q4_19 =$request->q4_19;
                $physical_receiving->q4_20 =$request->q4_20;
                $physical_receiving->q4_21 =$request->q4_21;
                $physical_receiving->q4_22 =$request->q4_22;
                $physical_receiving->save();

                $communal_relation= new PCCommunalRelations;
                $communal_relation->assessment_id =$assessment->id;
                $communal_relation->q5_1=$request->q5_1;
                $communal_relation->q5_2=$request->q5_2;
                $communal_relation->q5_3=$request->q5_3;
                $communal_relation->q5_4=$request->q5_4;
                $communal_relation->q5_5=$request->q5_5;
                $communal_relation->q5_6=$request->q5_6;
                $communal_relation->save();

                $cash_usage=new PCCashUsage;
                $cash_usage->assessment_id =$assessment->id;
                $cash_usage->q6_1 =$request->q6_1;
                $cash_usage->q6_2 =$request->q6_2;
                $cash_usage->q6_3 =$request->q6_3;
                $cash_usage->q6_4 =$request->q6_4;
                $cash_usage->save();

                $counter=0;
                foreach ($request->categories as $category) {

                    $usage_category = new PCCashUsageCategory;
                    $usage_category->usage_id = $cash_usage->id;
                    $usage_category->category_id = $category;
                    $usage_category->currency = $request->currencies[$counter];
                    $usage_category->save();
                }

                return Response::json(array(
                    'success' => false,
                    'errors' => 1,
                    'message' => "Record Saved successfully"
                ), 400); // 400 being the HTTP code for an invalid request.

            }
        }
        catch (\Exception $ex)
        {
            return Response::json(array(
                'success' => false,
                'errors' => 1,
                'message' => $ex->getMessage()
            ), 400); // 400 being the HTTP code for an invalid request.
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
        $assessment=PostCashAssessment::find($id);
        return view('cash.monitoring.show',compact('assessment'));
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
        $assessment=PostCashAssessment::find($id);
        return view('cash.monitoring.edit',compact('assessment'));
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
                'camp_id' => 'required',
                'district_id' => 'required',
                'interview_date' => 'required|before:tomorrow',
                'interview_start_time' => 'required',
                'interview_end_time' => 'required',
                'enumerator_name' => 'required',
                'organisation' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $assessment= PostCashAssessment::find($id);
                $assessment->client_id =$request->client_id;
                $assessment->camp_id =$request->camp_id;
                $assessment->district_id =$request->district_id;
                $assessment->interview_date =$request->interview_date;
                $assessment->interview_start_time =$request->interview_start_time;
                $assessment->interview_end_time =$request->interview_end_time;
                $assessment->organisation =$request->organisation;
                $assessment->enumerator_name =$request->enumerator_name;
                $assessment->respondent_name =$request->respondent_name;
                $assessment->enumerator_observations =$request->enumerator_observations;
                $assessment->created_by =Auth::user()->username;
                $assessment->save();

                if (is_object($assessment->demographicDetails) && $assessment->demographicDetails != null) {
                    $domographic = $assessment->demographicDetails;
                    $domographic->assessment_id = $assessment->id;
                    $domographic->q2_1 = $request->q2_1;
                    $domographic->q2_2 = $request->q2_2;
                    $domographic->q2_3 = $request->q2_3;
                    $domographic->q2_4 = $request->q2_4;
                    $domographic->q2_5 = $request->q2_5;
                    $domographic->q2_6 = $request->q2_6;
                    $domographic->q2_7 = $request->q2_7;
                    $domographic->q2_8 = $request->q2_8;
                    $domographic->save();
                }

                if (is_object($assessment->cashWithdrawal) && $assessment->cashWithdrawal != null) {
                    $withdraw = $assessment->cashWithdrawal;
                    $withdraw->assessment_id = $assessment->id;
                    $withdraw->q3_1 = $request->q3_1;
                    $withdraw->q3_2 = $request->q3_2;
                    $withdraw->q3_3 = $request->q3_3;
                    $withdraw->q3_4 = $request->q3_4;
                    $withdraw->q3_5 = $request->q3_5;
                    $withdraw->q3_6 = $request->q3_6;
                    $withdraw->save();
                }
                if (is_object($assessment->physicallyReceivingCash) && $assessment->physicallyReceivingCash != null) {
                    $physical_receiving = $assessment->physicallyReceivingCash;
                    $physical_receiving->assessment_id = $assessment->id;
                    $physical_receiving->q4_1 = $request->q4_1;
                    $physical_receiving->q4_2 = $request->q4_2;
                    $physical_receiving->q4_3 = $request->q4_3;
                    $physical_receiving->q4_4 = $request->q4_4;
                    $physical_receiving->q4_5 = $request->q4_5;
                    $physical_receiving->q4_6 = $request->q4_6;
                    $physical_receiving->q4_7 = $request->q4_7;
                    $physical_receiving->q4_8 = $request->q4_8;
                    $physical_receiving->q4_9 = $request->q4_9;
                    $physical_receiving->q4_10 = $request->q4_10;
                    $physical_receiving->q4_10_1 = $request->q4_10_1;
                    $physical_receiving->q4_11 = $request->q4_11;
                    $physical_receiving->q4_12 = $request->q4_12;
                    $physical_receiving->q4_13 = $request->q4_13;
                    $physical_receiving->q4_14 = $request->q4_14;
                    $physical_receiving->q4_15 = $request->q4_15;
                    $physical_receiving->q4_16 = $request->q4_16;
                    $physical_receiving->q4_17 = $request->q4_17;
                    $physical_receiving->q4_18 = $request->q4_18;
                    $physical_receiving->q4_19 = $request->q4_19;
                    $physical_receiving->q4_20 = $request->q4_20;
                    $physical_receiving->q4_21 = $request->q4_21;
                    $physical_receiving->q4_22 = $request->q4_22;
                    $physical_receiving->save();
                }

                if (is_object($assessment->communalRelations) && $assessment->communalRelations != null) {
                    $communal_relation =$assessment->communalRelations;
                    $communal_relation->assessment_id = $assessment->id;
                    $communal_relation->q5_1 = $request->q5_1;
                    $communal_relation->q5_2 = $request->q5_2;
                    $communal_relation->q5_3 = $request->q5_3;
                    $communal_relation->q5_4 = $request->q5_4;
                    $communal_relation->q5_5 = $request->q5_5;
                    $communal_relation->q5_6 = $request->q5_6;
                    $communal_relation->save();
                }

                if (is_object($assessment->cashUsage) && $assessment->cashUsage != null) {
                    $cash_usage = $assessment->cashUsage;
                    $cash_usage->assessment_id = $assessment->id;
                    $cash_usage->q6_1 = $request->q6_1;
                    $cash_usage->q6_2 = $request->q6_2;
                    $cash_usage->q6_3 = $request->q6_3;
                    $cash_usage->q6_4 = $request->q6_4;
                    $cash_usage->save();

                    $counter = 0;
                    if (is_object($assessment->usages) && $assessment->usages != null && is_object($assessment->usages->usages) && count($assessment->usages->usages) >0) {
                        foreach ($assessment->usages as $usage){
                            $usage->delete();
                        }
                    }
                    foreach ($request->categories as $category) {

                        $usage_category = new PCCashUsageCategory;
                        $usage_category->usage_id = $cash_usage->id;
                        $usage_category->category_id = $category;
                        $usage_category->currency = $request->currencies[$counter];
                        $usage_category->save();
                    }
                }

                return Response::json(array(
                    'success' => false,
                    'errors' => 1,
                    'message' => "Record Saved successfully"
                ), 400); // 400 being the HTTP code for an invalid request.

            }
        }
        catch (\Exception $ex)
        {
            return Response::json(array(
                'success' => false,
                'errors' => 1,
                'message' => $ex->getMessage()
            ), 400); // 400 being the HTTP code for an invalid request.
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
        $assessment=PostCashAssessment::find($id);
        $assessment->delete();
    }
}
