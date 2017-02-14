<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Client;
use App\User;
use DB;

class InclusionAssessmentController extends Controller
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
        
        return view('assessments.inclusion.index');
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
                '<label><input id="client-'.$client->id.'" type="radio" name="client_id" value="'.$client->id.' "></label>
                <script>$("#client-'.$client->id.'").on("change", function(){ $.get("inclusion/client-to-assess/'.$client->id.'",function(response){ var rs = JSON.parse(response);console.log(rs.data); $("#client-particulars-info").html(rs.data);});});</script>',
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
    public function postData(Request $request){
       
        //we need to check the user role here, to know if the logged in user can assess
		// Auth::user()->id; check this
		//
        $client=Client::find($request->client_id);
        
        if(!empty($client) && $request->ajax() ){
            
            if($client->id == $request->client_id ){
                
                $inc_assessment = new InclusionAssessment();
                $inc_assessment->assessor_id = Auth::user()->id;
                $inc_assessment->client_id   = $request->client_id;
                $inc_assessment->save(); 
                
                $imhistory                                = new InclusionMedicalHistory();
                $imhistory->incl_assessment_id            = $inc_assessment->id; 
                $imhistory->med_history_info_qn_1         = $request->med_history_info_qn_1; 
                $imhistory->med_history_info_qn_2         = $request->med_history_info_qn_2; 
                $imhistory->med_history_info_qn_3         = $request->med_history_info_qn_3; 
                $imhistory->med_history_info_qn_4         = $request->med_history_info_qn_4; 
                $imhistory->med_history_info_qn_5         = $request->med_history_info_qn_5; 
                $imhistory->med_history_info_qn_6         = $request->med_history_info_qn_6; 
                $imhistory->med_history_info_qn_7         = $request->med_history_info_qn_7; 
                $imhistory->med_history_info_qn_8         = $request->med_history_info_qn_8; 
                $imhistory->med_history_info_qn_9         = $request->med_history_info_qn_9; 
                $imhistory->med_history_info_qn_10        = $request->med_history_info_qn_10; 
                $imhistory->med_history_info_qn_10_remark = $request->med_history_info_qn_10_remark; 
                $imhistory->save();
                
                $mpc_part_a                      = new MedicalPerfomanceComponentPartA();       
                $mpc_part_a->incl_assessment_id  = $inc_assessment->id;
                $mpc_part_a->mpc_qn_a_1          = $request->mpc_qn_a_1;
                $mpc_part_a->mpc_qn_a_1_remark   = $request->mpc_qn_a_1_remark;
                $mpc_part_a->mpc_qn_a_2          = $request->mpc_qn_a_2;
                $mpc_part_a->mpc_qn_a_2_remark   = $request->mpc_qn_a_2_remark;
                $mpc_part_a->mpc_qn_a_3          = $request->mpc_qn_a_3;
                $mpc_part_a->mpc_qn_a_4          = $request->mpc_qn_a_4;
                $mpc_part_a->mpc_qn_a_5          = $request->mpc_qn_a_5;
                $mpc_part_a->mpc_qn_a_6          = $request->mpc_qn_a_6;
                $mpc_part_a->mpc_qn_a_7          = $request->mpc_qn_a_7;
                $mpc_part_a->mpc_qn_a_8          = $request->mpc_qn_a_8;
                $mpc_part_a->mpc_qn_a_8_remark   = $request->mpc_qn_a_8_remark;
                $mpc_part_a->mpc_qn_a_9          = $request->mpc_qn_a_9;
                $mpc_part_a->mpc_qn_a_10         = $request->mpc_qn_a_10;
                $mpc_part_a->mpc_qn_a_10_remark  = $request->mpc_qn_a_10_remark;
                $mpc_part_a->mpc_qn_a_11         = $request->mpc_qn_a_11;
                $mpc_part_a->mpc_qn_a_12         = $request->mpc_qn_a_12;
                $mpc_part_a->mpc_qn_a_13         = $request->mpc_qn_a_13;
                $mpc_part_a->mpc_qn_a_14         = $request->mpc_qn_a_14;
                $mpc_part_a->mpc_qn_a_15         = $request->mpc_qn_a_15;
                $mpc_part_a->mpc_qn_a_16         = $request->mpc_qn_a_16;
                $mpc_part_a->mpc_qn_a_16_remark  = $request->mpc_qn_a_16_remark;
                $mpc_part_a->save();
                         
                            $mpc_part_a_posture = new MedicalPerfomanceComponentPartAPosture();
                            $mpc_part_a_posture->mpc_part_a_id      = $mpc_part_a->id;
                            $mpc_part_a_posture->mpc_qn_a_17        = $request->mpc_qn_a_17;
                            $mpc_part_a_posture->mpc_qn_a_18        = $request->mpc_qn_a_18;
                            $mpc_part_a_posture->mpc_qn_a_19        = $request->mpc_qn_a_19;
                            $mpc_part_a_posture->mpc_qn_a_20        = $request->mpc_qn_a_20;
                            $mpc_part_a_posture->mpc_qn_a_21        = $request->mpc_qn_a_21;
                            $mpc_part_a_posture->mpc_qn_a_22        = $request->mpc_qn_a_22;
                            $mpc_part_a_posture->mpc_qn_a_23        = $request->mpc_qn_a_23;
                            $mpc_part_a_posture->mpc_qn_a_24        = $request->mpc_qn_a_24;
                            $mpc_part_a_posture->mpc_qn_a_25_remark = $request->mpc_qn_a_25_remark;
                            $mpc_part_a_posture->mpc_qn_a_26_remark = $request->mpc_qn_a_26_remark;
                            $mpc_part_a_posture->mpc_qn_a_27_remark = $request->mpc_qn_a_27_remark;
                            $mpc_part_a_posture->mpc_qn_a_28_remark = $request->mpc_qn_a_28_remark;
                            $mpc_part_a_posture->mpc_qn_a_29_remark = $request->mpc_qn_a_29;
                            $mpc_part_a_posture->mpc_qn_a_30        = $request->mpc_qn_a_30;
                            $mpc_part_a_posture->mpc_qn_a_31_remark = $request->mpc_qn_a_31_remark;
                            $mpc_part_a_posture->mpc_qn_a_32        = $request->mpc_qn_a_32;
                            $mpc_part_a_posture->mpc_qn_a_33        = $request->mpc_qn_a_33;
                            $mpc_part_a_posture->mpc_qn_a_34        = $request->mpc_qn_a_34;
                            $mpc_part_a_posture->mpc_qn_a_35        = $request->mpc_qn_a_35;
                            $mpc_part_a_posture->mpc_qn_a_35_remark = $request->mpc_qn_a_35_remark;
                            $mpc_part_a_posture->mpc_qn_a_36        = $request->mpc_qn_a_36;
                            $mpc_part_a_posture->mpc_qn_a_37        = $request->mpc_qn_a_37;
                            $mpc_part_a_posture->mpc_qn_a_38        = $request->mpc_qn_a_38;
                            $mpc_part_a_posture->mpc_qn_a_39        = $request->mpc_qn_a_39;
                            $mpc_part_a_posture->mpc_qn_a_40        = $request->mpc_qn_a_40;
                            $mpc_part_a_posture->mpc_qn_a_41_remark = $request->mpc_qn_a_40_remark;
                            $mpc_part_a_posture->save();

                            $mpc_part_a_moving_pattern  = new MedicalPerfomanceComponentPartAMovingPattern();
                            $mpc_part_a_moving_pattern->mpc_part_a_id      = $mpc_part_a->id;
                            $mpc_part_a_moving_pattern->mpc_qn_a_42_remark = $request->mpc_qn_a_42_remark;
                            $mpc_part_a_moving_pattern->mpc_qn_a_43        = $request->mpc_qn_a_43;
                            $mpc_part_a_moving_pattern->mpc_qn_a_44        = $request->mpc_qn_a_44;
                            $mpc_part_a_moving_pattern->mpc_qn_a_45        = $request->mpc_qn_a_45;
                            $mpc_part_a_moving_pattern->mpc_qn_a_46        = $request->mpc_qn_a_46;
                            $mpc_part_a_moving_pattern->mpc_qn_a_47        = $request->mpc_qn_a_47;
                            $mpc_part_a_moving_pattern->mpc_qn_a_48        = $request->mpc_qn_a_48;
                            $mpc_part_a_moving_pattern->mpc_qn_a_49        = $request->mpc_qn_a_49;
                            $mpc_part_a_moving_pattern->mpc_qn_a_50        = $request->mpc_qn_a_50;
                            $mpc_part_a_moving_pattern->mpc_qn_a_51        = $request->mpc_qn_a_51;
                            $mpc_part_a_moving_pattern->mpc_qn_a_52        = $request->mpc_qn_a_52;
                            $mpc_part_a_moving_pattern->mpc_qn_a_53_remark  = $request->mpc_qn_a_53_remark;
                            $mpc_part_a_moving_pattern->save();
                
                $mpc_part_b      = new MedicalPerfomanceComponentPartB();
                $mpc_part_b->incl_assessment_id   = $inc_assessment->id;
                $mpc_part_b->mpc_qn_b_1           = $request->mpc_qn_b_1;
                $mpc_part_b->mpc_qn_b_1_remark    = $request->mpc_qn_b_1_remark;
                $mpc_part_b->mpc_qn_b_2           = $request->mpc_qn_b_2;
                $mpc_part_b->mpc_qn_b_2_remark    = $request->mpc_qn_b_2_remark;
                $mpc_part_b->mpc_qn_b_27_remak    = $request->mpc_qn_b_27_remak;
                $mpc_part_b->mpc_qn_b_28          = serialize($request->mpc_qn_b_28);
                $mpc_part_b->save();
                
                        $mpc_part_b_body_sense                      =  new MedicalPerfomanceComponentPartBBodySenses();
                        $mpc_part_b_body_sense->mpc_part_b_id       =  $mpc_part_b->id;
                        $mpc_part_b_body_sense->mpc_qn_b_6          =  $request->mpc_qn_b_6;
                        $mpc_part_b_body_sense->mpc_qn_b_7          =  $request->mpc_qn_b_7;
                        $mpc_part_b_body_sense->mpc_qn_b_8          =  $request->mpc_qn_b_8;
                        $mpc_part_b_body_sense->mpc_qn_b_9          =  $request->mpc_qn_b_9;
                        $mpc_part_b_body_sense->mpc_qn_b_10         =  $request->mpc_qn_b_10;
                        $mpc_part_b_body_sense->mpc_qn_b_11         =  $request->mpc_qn_b_11;
                        $mpc_part_b_body_sense->mpc_qn_b_12         =  $request->mpc_qn_b_12;
                        $mpc_part_b_body_sense->mpc_qn_b_13         =  $request->mpc_qn_b_13;
                        $mpc_part_b_body_sense->mpc_qn_b_14         =  $request->mpc_qn_b_14;
                        $mpc_part_b_body_sense->mpc_qn_b_15         =  $request->mpc_qn_b_15;
                        $mpc_part_b_body_sense->mpc_qn_b_16         =  $request->mpc_qn_b_16;
                        $mpc_part_b_body_sense->mpc_qn_b_17         =   $request->mpc_qn_b_17;
                        $mpc_part_b_body_sense->mpc_qn_b_18         =  $request->mpc_qn_b_18;
                        $mpc_part_b_body_sense->mpc_qn_b_19         =  $request->mpc_qn_b_19;
                        $mpc_part_b_body_sense->mpc_qn_b_20         =  $request->mpc_qn_b_20;
                        $mpc_part_b_body_sense->mpc_qn_b_21         =  $request->mpc_qn_b_21;
                        $mpc_part_b_body_sense->mpc_qn_b_22         =  $request->mpc_qn_b_22;
                        $mpc_part_b_body_sense->mpc_qn_b_23         =  $request->mpc_qn_b_23;
                        $mpc_part_b_body_sense->mpc_qn_b_24         =  $request->mpc_qn_b_24;
                        $mpc_part_b_body_sense->mpc_qn_b_25         =  $request->mpc_qn_b_25;
                        $mpc_part_b_body_sense->mpc_qn_b_26         =  $request->mpc_qn_b_26;
                        $mpc_part_b_body_sense->save();
                
                
                        $mpc_part_c            = new MedicalPerfomanceComponentPartC();
                        $mpc_part_d            = new MedicalPerfomanceComponentPartD();();
                        $mpc_part_e            = new MedicalPerfomanceComponentPartE();
                        $mpc_part_f            = new MedicalPerfomanceComponentPartF();
                        $mpc_part_parea        = new MedicalPerfomanceComponentPerformanceArea();
                        $mpc_part_context      = new MedicalPerfomanceComponentContext();
                        $mpc_part_swot         = new MedicalPerfomanceComponentSwot();
                        $mpc_part_short_rehab  = new MedicalPerfomanceComponentShortRehab();
                        $mpc_part_long_rehab   = new MedicalPerfomanceComponentLongRehab();

                
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
        //Tables to be made
        /********************************
         
          1.InclusionAssessment
          2.php artisan make:model InclusionMedicalHistory
          3.php artisan make:model MedicalPerfomanceComponentPartA
                 1.php artisan make:model MedicalPerfomanceComponentPartARomLowerLimb
                
                2.php artisan make:model MedicalPerfomanceComponentPartARomUpperLimb
                 3.php artisan make:model MedicalPerfomanceComponentPartAPosture
                 4.php artisan make:model MedicalPerfomanceComponentPartAMovingPattern
          4.php artisan make:model MedicalPerfomanceComponentPartB
                 1.php artisan make:model MedicalPerfomanceComponentPartBBodySenses
          6.php artisan make:model MedicalPerfomanceComponentPartC
          7.php artisan make:model MedicalPerfomanceComponentPartD
          8.php artisan make:model MedicalPerfomanceComponentPartE
          9.php artisan make:model MedicalPerfomanceComponentPartF
          10.php artisan make:model MedicalPerfomanceComponentPerformanceArea
          11.php artisan make:model MedicalPerfomanceComponentContext
          13.php artisan make:model MedicalPerfomanceComponentSwot
          14.php artisan make:model MedicalPerfomanceComponentShortRehab
          15.php artisan make:model MedicalPerfomanceComponentLongRehab


           mpc_long_rehab_1_remark
           mpc_long_rehab_2_remark
           mpc_long_rehab_3_remark
           mpc_long_rehab_4_remark
           mpc_long_rehab_5_remark
           mpc_long_rehab_6_remark
           mpc_long_rehab_7_remark
           mpc_long_rehab_8_remark
           mpc_long_rehab_9_remark
          ********************************/



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
    function getSelectedClientInfo($id){
        
       $client  = Client::find($id);
       $client ->client_id;
		
        if(empty($client->age)){
            $client->age = "&nbsp;";
        }
        if(empty($client->present_address)){
            $client->present_address = "&nbsp;";
        }
        
      $clientView = '<div class="row">
							<div class="col-md-3 first table-client"> 
								<span class="table-title">Client Name :</span>
							</div>
							<div class="col-md-3 table-client">
							  '.$client->full_name.' 
							</div>
							<div class="col-md-3 table-client">
							 <span class="table-title"> Ration Card No:</span>			
							</div>
							<div class="col-md-3 last table-client">
							   '.$client->client_number.'
							</div>
					    </div>
					    <div class="row">
							<div class="col-md-3 first table-client"> 
								<span class="table-title">Gender :</span>
							</div>
							<div class="col-md-3 table-client">
							   '.$client->sex.'
							</div>
							<div class="col-md-3 table-client">
							 <span class="table-title">Age:</span>			
							</div>
							<div class="col-md-3 last table-client">
							   '.$client->age.'	
							</div>
					    </div>
				         <div class="row">
							<div class="col-md-3 first table-client"> 
								<span class="table-title">Camp :</span>
							</div>
							<div class="col-md-3 table-client">
							     '.$client->present_address.'
							</div>
							<div class="col-md-3 table-client">
							 <span class="table-title">&nbsp;</span>			
							</div>
							<div class="col-md-3 last table-client">
							   5656	
							</div>
					    </div>
				         <div class="row">
							<div class="col-md-3 first table-client"> 
								<span class="table-title"> Address:</span>
							</div>
							<div class="col-md-3 table-client">
							     '.$client->present_address.'
							</div>
							<div class="col-md-3 table-client">
							 <span class="table-title"> Unique No :</span>			
							</div>
							<div class="col-md-3 last table-client">
							     '.$client->present_address.'
							</div>
					    </div>
					    <div class="row">
							<div class="col-md-3 first table-client"> 
								<span class="table-title">Religion :</span>
							</div>
							<div class="col-md-3 table-client">
							     '.$client->present_address.' 
							</div>
							<div class="col-md-3 table-client">
							 <span class="table-title"> Country of Origin:</span>			
							</div>
							<div class="col-md-3 last table-client">
							     '.$client->present_address.'
							</div>
					    </div>
				         <div class="row">
							<div class="col-md-3 first table-client"> 
								<span class="table-title">Gadian Name :</span>
							</div>
							<div class="col-md-3 table-client">
							    '.$client->present_address.' 
							</div>
							<div class="col-md-3 table-client">
							 <span class="table-title"> Age of Guardian:</span>			
							</div>
							<div class="col-md-3 last table-client">
							    '.$client->present_address.'
							</div>
					    </div>
				        <div class="row">
							<div class="col-md-3 first table-client"> 
								<span class="table-title">Date of Assessment :</span>
							</div>
							<div class="col-md-3 table-client">
							     '.date("jS \of F Y").'
							</div>
							<div class="col-md-3 table-client">
							 <span class="table-title"> Assessor\'s Name:</span>			
							</div>
							<div class="col-md-3 last table-client">
							     '.Auth::user()->full_name.'
							</div>
					    </div>';
                $arr  = array('status'=>'success', 'data'=>$clientView );
            
        echo json_encode($arr);   
        
         
     }
}




























