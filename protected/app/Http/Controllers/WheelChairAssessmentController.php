<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\WheelChairAssessment;
use App\AssessmentInterview;
use App\PhysicalAssessment;
use App\HandSimulation;
use App\TakeMeasurement;
use App\Client;
use App\User;
use DB;

class WheelChairAssessmentController extends Controller
{
  public $parts = array(
					array('slug'=> 'perlvis', 'name'=>'Perlvis'),
					array('slug'=> 'truck', 'name'=>'Trunk'),
					array('slug'=> 'head', 'name'=>'Head'),
					array('slug'=> 'l_hip', 'name'=>'L Hip'),
					array('slug'=> 'r_hip', 'name'=>'R Hip'),
					array('slug'=> 'thighs', 'name'=>'Thighs'),
					array('slug'=> 'l_knee', 'name'=>'L Knee'),
					array('slug'=> 'r_knee', 'name'=>'R Knee'),
					array('slug'=> 'l_ankle', 'name'=>'L Ankle'),
					array('slug'=> 'r_ankle', 'name'=>'R Ankle'),
				   );



	public function __construct(){
        $this->middleware('auth');
    }

    //This function load on background the list of clients to be shown on client selection this minimize load time for the
    //Situation having many clients
    public function  getJSonClientData()
    {
        //
        $clients=Client::orderBy('full_name','ASC')->get();
        $iTotalRecords =count(Client::all());
        $sEcho = intval(10);

        $records = array();
        $records["data"] = array();


        $count=1;
        foreach($clients as $client) {
            $origin="";
            $status="";

            if(is_object($client->nationality) && $client->nationality != null )
            {
                $origin=$client->nationality->country_name;
            }
            $records["data"][] = array(
                $count++,
                $client->client_number,
                $client->full_name,
                $client->sex,
                $origin,
                date('d M Y',strtotime($client->date_arrival)),
                '<label><input type="radio" name="client_id" value="'.$client->id.' "></label>',
            );
        }


        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        echo json_encode($records);
    }

	public function getJSonWCListAllClientData(){


         $wc_assessment  = WheelChairAssessment::all();
		$iTotalRecords   =count($wc_assessment);
         $sEcho = intval(10);

        $records = array();
        $records["data"] = array();


		$count=1;
		foreach( $wc_assessment as $key => $assessed ){

		    $client   = Client::find($assessed->client_id);
			  $assessor = User::find($assessed->assessor_id);
		    $origin="";
            if(!empty($client ) && !empty($assessor)):

			         if(is_object($client->nationality) && $client->nationality != null ){
						$origin=$client->nationality->country_name;
					 }
					 $records["data"][] = array(
						$count++,
						$client->client_number,
						$client->full_name,
						$client->sex,
						$origin,
						date('d M Y',strtotime($client->date_arrival)),
						$assessor->full_name,
						'<label><a href="'.url("wheelchair/view").'/'.$assessed->id.'">View</a></label>',
					);

		  endif;

		}

	echo json_encode($records);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		 $parts          = $this->parts;
		 $clients        = Client::all();
         $wc_assessment  = WheelChairAssessment::all();
		 $hasValue       = false;
		 $tr             = '';
		 $count          = 1;

		foreach( $wc_assessment as $key => $assessed ){
			$assessed->client_id;
		    $client   = Client::find($assessed->client_id);
			$assessor = User::find($assessed->assessor_id);

            if(!empty($client ) && !empty($assessor)):
				 $hasValue = true;
			            $tr .=  '<tr>
						         <td class="text-center">'.($count + $key).'</td>
								<td class="text-center">
									'.$client->client_number.'
								</td>
								<td class="text-center">
									'.$client->full_name.'
								</td>
								<td class="text-center">
									'.$client->sex.'
								</td>
							   <td class="text-center">
								   '.$client->origin.'
								</td>
								<td class="text-center">
								   '.$client->date_arrival.'
								</td>
								<td class="text-center">
									'.$assessor->full_name.'
								</td>
								<td class="text-center">
									<label><a href="'.url("wheelchair/view").'/'.$assessed->id.'">View</a></label>
								</td>
							</tr>';


			 endif;

		}
		if($hasValue){
			$table_rows = $tr;
			return view('assessments.wheelchair.index', compact('parts', 'clients', 'table_rows'));
		}else{
			return view('assessments.wheelchair.index', compact('parts', 'clients'));
		}


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }
    public function postData(Request $request){

        //we need to check the user role here, to know if the logged in user can assess
		// Auth::user()->id; check this
		//
        $client=Client::find($request->client_id);

        if(!empty($client) && $request->ajax() ){

            if($client->id == $request->client_id ){

                    $wheelChairAssessment              = new WheelChairAssessment();
                    $wheelChairAssessment->assessor_id = Auth::user()->id;
                    $wheelChairAssessment->client_id   = $client->id;
                    $wheelChairAssessment->save();

                    $assessmentInterview = new AssessmentInterview();
                    $assessmentInterview->wc_assessment_id                                  = $wheelChairAssessment->id;
                    $assessmentInterview->assess_interview_diagnosis_qn_1                  = serialize($request->assess_interview_diagnosis_qn_1);
                    $assessmentInterview->assess_interview_diagnosis_qn_2                  = $request->assess_interview_diagnosis_qn_2;
                    $assessmentInterview->assess_interview_physical_issues_qn_1            = serialize($request->assess_interview_physical_issues_qn_1);
                    $assessmentInterview->assess_interview_physical_issues_qn_2            = serialize($request->assess_interview_physical_issues_qn_2);
                    $assessmentInterview->assess_interview_physical_issues_qn_3            = serialize($request->assess_interview_physical_issues_qn_3);
                    $assessmentInterview->assess_interview_physical_issues_qn_3_describe   = $request->assess_interview_physical_issues_qn_3_describe;
                    $assessmentInterview->assess_interview_physical_issues_qn_4            = serialize($request->assess_interview_physical_issues_qn_4);
                    $assessmentInterview->assess_interview_physical_issues_qn_4_describe   = $request->assess_interview_physical_issues_qn_4_describe;
                    $assessmentInterview->assess_interview_physical_issues_qn_5            = serialize($request->assess_interview_physical_issues_qn_5);
                    $assessmentInterview->assess_interview_physical_issues_qn_6            = $request->assess_interview_physical_issues_qn_6;
                    $assessmentInterview->assess_interview_lifestyle_env_qn_1_describe     = $request->assess_interview_lifestyle_env_qn_1_describe;
                    $assessmentInterview->assess_interview_lifestyle_env_qn_1              = $request->assess_interview_lifestyle_env_qn_1;
                    $assessmentInterview->assess_interview_lifestyle_env_qn_2              = $request->assess_interview_lifestyle_env_qn_2;
                    $assessmentInterview->assess_interview_lifestyle_env_qn_3              = $request->assess_interview_lifestyle_env_qn_3;
                    $assessmentInterview->assess_interview_lifestyle_env_qn_4              = $request->assess_interview_lifestyle_env_qn_4;
                    $assessmentInterview->assess_interview_lifestyle_env_qn_5              = $request->assess_interview_lifestyle_env_qn_5;
                    $assessmentInterview->assess_interview_lifestyle_env_qn_6              = $request->assess_interview_lifestyle_env_qn_6;
                    $assessmentInterview->assess_interview_lifestyle_env_qn_7              = $request->assess_interview_lifestyle_env_qn_7;
                    $assessmentInterview->assess_interview_lifestyle_env_qn_7_describe     = $request->assess_interview_lifestyle_env_qn_7_describe;
                    $assessmentInterview->assess_interview_existing_wheelchair_qn_1        = $request->assess_interview_existing_wheelchair_qn_1;
                    $assessmentInterview->assess_interview_existing_wheelchair_qn_2        = $request->assess_interview_existing_wheelchair_qn_2;
                    $assessmentInterview->assess_interview_existing_wheelchair_qn_3        = $request->assess_interview_existing_wheelchair_qn_3;
                    $assessmentInterview->assess_interview_existing_wheelchair_qn_4        = $request->assess_interview_existing_wheelchair_qn_4;
                    $assessmentInterview->assess_interview_existing_wheelchair_qn_5        = $request->assess_interview_existing_wheelchair_qn_5;
                    $assessmentInterview->assess_interview_existing_wheelchair_qn_6        = $request->assess_interview_existing_wheelchair_qn_6;
                    $assessmentInterview->save();

                    $physicalAssessment = new PhysicalAssessment();
                    $physicalAssessment->wc_assessment_id                      = $wheelChairAssessment->id;
                    $physicalAssessment->physical_assess_presence_risk_qn_1    = $request->physical_assess_presence_risk_qn_1;
                    $physicalAssessment->physical_assess_presence_risk_qn_2    = $request->physical_assess_presence_risk_qn_2;
                    $physicalAssessment->physical_assess_presence_risk_qn_3    = $request->physical_assess_presence_risk_qn_3;
                    $physicalAssessment->physical_assess_presence_risk_qn_4    = $request->physical_assess_presence_risk_qn_4;
                    $physicalAssessment->physical_assess_presence_risk_qn_5    = $request->physical_assess_presence_risk_qn_5;
                    $physicalAssessment->physical_assess_presence_risk_qn_6    = $request->physical_assess_presence_risk_qn_6;
                    $physicalAssessment->physical_assess_method_of_pushing_qn_1    = $request->physical_assess_method_of_pushing_qn_1;
                    //$physicalAssessment->physical_assess_method_of_pushing_qn_2    = $request->physical_assess_method_of_pushing_qn_2;
                    $physicalAssessment->physical_assess_method_of_pushing_qn_2_describe    = $request->physical_assess_method_of_pushing_qn_2_describe;
                    $physicalAssessment->physical_assess_sitting_posture_without_support_qn_1    = $request->physical_assess_sitting_posture_without_support_qn_1;
                    $physicalAssessment->physical_assess_pelvis_hip_posture_screen_qn_1    = $request->physical_assess_pelvis_hip_posture_screen_qn_1;
                    $physicalAssessment->physical_assess_pelvis_hip_posture_screen_qn_2    = $request->physical_assess_pelvis_hip_posture_screen_qn_2;
                    $physicalAssessment->physical_assess_pelvis_hip_posture_screen_qn_2_angle    = $request->physical_assess_pelvis_hip_posture_screen_qn_2_angle;
                    $physicalAssessment->physical_assess_pelvis_hip_posture_screen_qn_3    = $request->physical_assess_pelvis_hip_posture_screen_qn_3;
                    $physicalAssessment->physical_assess_pelvis_hip_posture_screen_qn_3_angle    = $request->physical_assess_pelvis_hip_posture_screen_qn_3_angle;
                    $physicalAssessment->save();


                    $handsimulation                       =  new HandSimulation();
                    $handsimulation->p_assessment_id   =  $physicalAssessment->id;
                    $handsimulation->perlvis  =  $request->perlvis;
                    $handsimulation->perlvis_0=  $request->perlvis_0;
                    $handsimulation->truck    =  $request->truck;
                    $handsimulation->truck_1  =  $request->truck_1;
                    $handsimulation->head     =  $request->head;
                    $handsimulation->head_2   =  $request->head_2;
                    $handsimulation->l_hip    =  $request->l_hip;
                    $handsimulation->l_hip_3  =  $request->l_hip_3;
                    $handsimulation->r_hip    =  $request->r_hip;
                    $handsimulation->r_hip_4  =  $request->r_hip_4;
                    $handsimulation->thighs   =  $request->thighs;
                    $handsimulation->thighs_5 =  $request->thighs_5;
                    $handsimulation->l_knee   =  $request->l_knee;
                    $handsimulation->l_knee_6 =  $request->l_knee_6;
                    $handsimulation->r_knee   =  $request->r_knee;
                    $handsimulation->r_knee_7 =  $request->r_knee_7;
                    $handsimulation->l_ankle   =  $request->l_ankle;
                    $handsimulation->l_ankle_8 =  $request->l_ankle_8;
                    $handsimulation->r_ankle   =  $request->r_ankle;
                    $handsimulation->r_ankle_9 =  $request->r_ankle_9;
                    $handsimulation->save();


                    $takeMeasurement  =  new TakeMeasurement();
                    $takeMeasurement->p_assessment_id  =  $physicalAssessment->id;
                    $takeMeasurement->save();

            return response()->json([
                    'success' => true,
                    'action' => 'add',
                    'message' => "<div class='alert alert-success remove-alert'><strong>Success!</strong> Wheelchair Assessment was submitted successifully</div>"
                ], 200);

            }else{

               return response()->json([
                    'success' => false,
                    'message' => "<div class='alert alert-success remove-alert'><strong>Error!</strong> Something went wrong, failed to submit your client Wheel Chair Assessment</div>",
                ], 400);

            }

        }else{
	    return response()->json([
							'success' => false,
							'message' => "<div class='alert alert-danger remove-alert'><strong>Error!</strong> Sorry, No such Wheelchair Assessment in our system</div>"
						   ], 200);

		}

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//we need to check the user role here, to know if the logged in user can assess
		// Auth::user()->id; check this
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
                $parts          = $this->parts;
		            $clients        = Client::all();
                $wc_assessment  = WheelChairAssessment::find($id);;
		            $assessed       = $wc_assessment;

            $assessInterview    = $wc_assessment->assessmentInterview;
            $passessment        = $wc_assessment->physicalAssessment;
            $hsimulation        = $passessment->handsimulation;
            $takeMeasurement    = $passessment->takeMeasurement;
            //dd($hsimulation);

           //dd($assessInterview );


			$assessed->client_id;
		    $assessedClient   = Client::find($assessed->client_id);
			$assessor = User::find($assessed->assessor_id);

		return view('assessments.wheelchair.view', compact('parts','hsimulation','clients','passessment' ,'assessInterview','assessedClient','assessor','wc_assessment'));
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
    public function update(Request $request, $id )
    {
        if($request->ajax()){

              try
                {

                       // $client        = Client::findOrFail($id);
                        $wc_assessment =  WheelChairAssessment::findOrFail($id);  // DB::table('wheel_chair_assessments')->where('id',  $client->id )->get();
                        if(!empty($wc_assessment)){


                        $assessmentInterview = $wc_assessment->assessmentInterview;
                        $assessmentInterview->wc_assessment_id                                 = $wc_assessment->id;
                        $assessmentInterview->assess_interview_diagnosis_qn_1                  = serialize($request->assess_interview_diagnosis_qn_1);
                        $assessmentInterview->assess_interview_diagnosis_qn_2                  = $request->assess_interview_diagnosis_qn_2;
                        $assessmentInterview->assess_interview_physical_issues_qn_1            = serialize($request->assess_interview_physical_issues_qn_1);
                        $assessmentInterview->assess_interview_physical_issues_qn_2            = serialize($request->assess_interview_physical_issues_qn_2);
                        $assessmentInterview->assess_interview_physical_issues_qn_3            = serialize($request->assess_interview_physical_issues_qn_3);
                        $assessmentInterview->assess_interview_physical_issues_qn_3_describe   = $request->assess_interview_physical_issues_qn_3_describe;
                        $assessmentInterview->assess_interview_physical_issues_qn_4            = serialize($request->assess_interview_physical_issues_qn_4);
                        $assessmentInterview->assess_interview_physical_issues_qn_4_describe   = $request->assess_interview_physical_issues_qn_4_describe;
                    	$assessmentInterview->assess_interview_physical_issues_qn_5            = serialize($request->assess_interview_physical_issues_qn_5);
                        $assessmentInterview->assess_interview_physical_issues_qn_6            = $request->assess_interview_physical_issues_qn_6;
                        $assessmentInterview->assess_interview_lifestyle_env_qn_1_describe     = $request->assess_interview_lifestyle_env_qn_1_describe;
                        $assessmentInterview->assess_interview_lifestyle_env_qn_1              = $request->assess_interview_lifestyle_env_qn_1;
                        $assessmentInterview->assess_interview_lifestyle_env_qn_2              = $request->assess_interview_lifestyle_env_qn_2;
                        $assessmentInterview->assess_interview_lifestyle_env_qn_3              = $request->assess_interview_lifestyle_env_qn_3;
                        $assessmentInterview->assess_interview_lifestyle_env_qn_4              = $request->assess_interview_lifestyle_env_qn_4;
                        $assessmentInterview->assess_interview_lifestyle_env_qn_5              = $request->assess_interview_lifestyle_env_qn_5;
                        $assessmentInterview->assess_interview_lifestyle_env_qn_6              = $request->assess_interview_lifestyle_env_qn_6;
                        $assessmentInterview->assess_interview_lifestyle_env_qn_7              = $request->assess_interview_lifestyle_env_qn_7;
                        $assessmentInterview->assess_interview_lifestyle_env_qn_7_describe     = $request->assess_interview_lifestyle_env_qn_7_describe;
                        $assessmentInterview->assess_interview_existing_wheelchair_qn_1        = $request->assess_interview_existing_wheelchair_qn_1;
                        $assessmentInterview->assess_interview_existing_wheelchair_qn_2        = $request->assess_interview_existing_wheelchair_qn_2;
                        $assessmentInterview->assess_interview_existing_wheelchair_qn_3        = $request->assess_interview_existing_wheelchair_qn_3;
                        $assessmentInterview->assess_interview_existing_wheelchair_qn_4        = $request->assess_interview_existing_wheelchair_qn_4;
                        $assessmentInterview->assess_interview_existing_wheelchair_qn_5        = $request->assess_interview_existing_wheelchair_qn_5;
                        $assessmentInterview->assess_interview_existing_wheelchair_qn_6        = $request->assess_interview_existing_wheelchair_qn_6;
                        $assessmentInterview->save();

                        $physicalAssessment = $wc_assessment->physicalAssessment;
                        $physicalAssessment->wc_assessment_id                      = $wc_assessment->id;
                        $physicalAssessment->physical_assess_presence_risk_qn_1    = $request->physical_assess_presence_risk_qn_1;
                        $physicalAssessment->physical_assess_presence_risk_qn_2    = $request->physical_assess_presence_risk_qn_2;
                        $physicalAssessment->physical_assess_presence_risk_qn_3    = $request->physical_assess_presence_risk_qn_3;
                        $physicalAssessment->physical_assess_presence_risk_qn_4    = $request->physical_assess_presence_risk_qn_4;
                        $physicalAssessment->physical_assess_presence_risk_qn_5    = $request->physical_assess_presence_risk_qn_5;
                        $physicalAssessment->physical_assess_presence_risk_qn_6    = $request->physical_assess_presence_risk_qn_6;
                        $physicalAssessment->physical_assess_method_of_pushing_qn_1    = $request->physical_assess_method_of_pushing_qn_1;
                        //$physicalAssessment->physical_assess_method_of_pushing_qn_2    = $request->physical_assess_method_of_pushing_qn_2;
                        $physicalAssessment->physical_assess_method_of_pushing_qn_2_describe    = $request->physical_assess_method_of_pushing_qn_2_describe;
                        $physicalAssessment->physical_assess_sitting_posture_without_support_qn_1    = $request->physical_assess_sitting_posture_without_support_qn_1;
                        $physicalAssessment->physical_assess_pelvis_hip_posture_screen_qn_1    = $request->physical_assess_pelvis_hip_posture_screen_qn_1;
                        $physicalAssessment->physical_assess_pelvis_hip_posture_screen_qn_2    = $request->physical_assess_pelvis_hip_posture_screen_qn_2;
                        $physicalAssessment->physical_assess_pelvis_hip_posture_screen_qn_2_angle    = $request->physical_assess_pelvis_hip_posture_screen_qn_2_angle;
                        $physicalAssessment->physical_assess_pelvis_hip_posture_screen_qn_3    = $request->physical_assess_pelvis_hip_posture_screen_qn_3;
                        $physicalAssessment->physical_assess_pelvis_hip_posture_screen_qn_3_angle    = $request->physical_assess_pelvis_hip_posture_screen_qn_3_angle;
                        $physicalAssessment->save();


                        $handsimulation                    =  $physicalAssessment->handsimulation;  ;
                        $handsimulation->p_assessment_id   =  $physicalAssessment->id;
                        $handsimulation->perlvis  =  $request->perlvis;
                        $handsimulation->perlvis_0=  $request->perlvis_0;
                        $handsimulation->truck    =  $request->truck;
                        $handsimulation->truck_1  =  $request->truck_1;
                        $handsimulation->head     =  $request->head;
                        $handsimulation->head_2   =  $request->head_2;
                        $handsimulation->l_hip    =  $request->l_hip;
                        $handsimulation->l_hip_3  =  $request->l_hip_3;
                        $handsimulation->r_hip    =  $request->r_hip;
                        $handsimulation->r_hip_4  =  $request->r_hip_4;
                        $handsimulation->thighs   =  $request->thighs;
                        $handsimulation->thighs_5 =  $request->thighs_5;
                        $handsimulation->l_knee   =  $request->l_knee;
                        $handsimulation->l_knee_6 =  $request->l_knee_6;
                        $handsimulation->r_knee   =  $request->r_knee;
                        $handsimulation->r_knee_7 =  $request->r_knee_7;
                        $handsimulation->l_ankle   =  $request->l_ankle;
                        $handsimulation->l_ankle_8 =  $request->l_ankle_8;
                        $handsimulation->r_ankle   =  $request->r_ankle;
                        $handsimulation->r_ankle_9 =  $request->r_ankle_9;
                        $handsimulation->save();


                        $takeMeasurement  =  $physicalAssessment->takeMeasurement;
                        $takeMeasurement->p_assessment_id  =  $physicalAssessment->id;
                        $takeMeasurement->save();


                        return response()->json([
                                                'success' => true,
                                                'action' => 'update',
                                                'message' => "<div class='alert alert-success remove-alert'><strong>Success!</strong> Wheelchair Assessment was submitted successifully</div>"
                                               ], 200);

                     }else{
                            return response()->json([
                                                'success' => true,
                                                'message' => "<div class='alert alert-danger remove-alert'><strong>Error!</strong> Sorry, No such Wheelchair Assessment in our system</div>"
                                               ], 200);

                        }

                }catch (\Exception $ex) {

                        return Response::json(array(
                                                    'success' => false,
                                                     'id'=> $id,
                                                    'errors' => $ex->getMessage()

                                                ), 400);
               }


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
    }
}
