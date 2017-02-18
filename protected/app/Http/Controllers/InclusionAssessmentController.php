<?php
namespace App\Http\Controllers;
use App\InclusionAssessment;
use App\MpcPartA;
use App\MpcPartB;
use App\MpcPartC;
use App\MpcPartD;
use App\MpcPartE;
use App\MpcPartF;
use App\MpcPartAPosture;
use App\MpcPerformanceArea;
use App\MpcShortRehab;
use App\MpcLongRehab;
use App\MpcPartARomUpper;
use App\MpcPartARomLower;
use App\mpcContext;
use App\MpcSwot;
use App\MpcPartBBodySense;
use App\MpcPartAMovingPattern;
use App\InclusionMedicalHistory;
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



    public function getJSONIncAssessmentListAllClientData(){


      $incl_assessment  = InclusionAssessment::all();
  		$iTotalRecords    = count($incl_assessment);
           $sEcho = intval(10);

          $records = array();
          $records["data"] = array();


  		$count=1;
  		foreach( $incl_assessment as $key => $assessed ){

  		    $client   = Client::find($assessed->client_id);
  			$assessor  = User::find($assessed->assessor_id);
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
  						'<label><a href="'.url("assessments/inclusion/view").'/'.$assessed->id.'">View</a></label>',
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
                <script>$("#client-'.$client->id.'").on("change", function(){ $.get("inclusion/client-to-assess/'.$client->id.'",function(response){ var rs = JSON.parse(response); $("#client-particulars-info").html(rs.data);});});</script>',
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

                $inc_assessment = new InclusionAssessment;
                $inc_assessment->assessor_id = Auth::user()->id;
                $inc_assessment->client_id   = $request->client_id;
                $inc_assessment->save();

                $imhistory                                = new InclusionMedicalHistory();
                $imhistory->incl_assessment_id            = $inc_assessment->id;
                $imhistory->med_history_info_qn_1         = $request->med_history_info_qn_1;
                $imhistory->med_history_info_qn_1_remark  = $request->med_history_info_qn_1_remark;
                $imhistory->med_history_info_qn_2         = $request->med_history_info_qn_2;
                $imhistory->med_history_info_qn_2_remark  = $request->med_history_info_qn_2_remark;
                $imhistory->med_history_info_qn_3         = $request->med_history_info_qn_3;
                $imhistory->med_history_info_qn_3_remark  = $request->med_history_info_qn_3_remark;
                $imhistory->med_history_info_qn_4         = $request->med_history_info_qn_4;
                $imhistory->med_history_info_qn_4_remark  = $request->med_history_info_qn_4_remark;
                $imhistory->med_history_info_qn_5         = $request->med_history_info_qn_5;
                $imhistory->med_history_info_qn_5_remark  = $request->med_history_info_qn_5_remark;
                $imhistory->med_history_info_qn_6         = $request->med_history_info_qn_6;
                $imhistory->med_history_info_qn_6_remark  = $request->med_history_info_qn_6_remark;
                $imhistory->med_history_info_qn_7         = $request->med_history_info_qn_7;
                $imhistory->med_history_info_qn_7_remark  = $request->med_history_info_qn_7_remark;
                $imhistory->med_history_info_qn_8         = $request->med_history_info_qn_8;
                $imhistory->med_history_info_qn_8_remark  = $request->med_history_info_qn_8_remark;
                $imhistory->med_history_info_qn_9         = $request->med_history_info_qn_9;
                $imhistory->med_history_info_qn_9_remark  = $request->med_history_info_qn_9_remark;
                $imhistory->med_history_info_qn_10        = $request->med_history_info_qn_10;
                $imhistory->med_history_info_qn_10_remark = $request->med_history_info_qn_10_remark;
                $imhistory->save();

                $mpc_part_a                      = new MpcPartA();
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

                $mpc_part_a_posture = new MpcPartAPosture();
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
                $mpc_part_a_posture->mpc_qn_a_41_remark = $request->mpc_qn_a_41_remark;
                $mpc_part_a_posture->save();

                $mpc_part_a_moving_pattern  = new MpcPartAMovingPattern();
                $mpc_part_a_moving_pattern->mpc_part_a_id      = $mpc_part_a->id;
                $mpc_part_a_moving_pattern->mpc_qn_a_42_remark = $request->mpc_qn_a_42_remark;
                $mpc_part_a_moving_pattern->mpc_qn_a_42        = $request->mpc_qn_a_42;
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
                $mpc_part_a_moving_pattern->mpc_qn_a_53        = $request->mpc_qn_a_53;
                $mpc_part_a_moving_pattern->save();

                $mpc_part_b      = new MpcPartB();
                $mpc_part_b->incl_assessment_id   = $inc_assessment->id;
                $mpc_part_b->mpc_qn_b_1           = serialize($request->mpc_qn_b_1);
                $mpc_part_b->mpc_qn_b_1_remark    = $request->mpc_qn_b_1_remark;
                $mpc_part_b->mpc_qn_b_2           = serialize($request->mpc_qn_b_2);
                $mpc_part_b->mpc_qn_b_2_remark    = $request->mpc_qn_b_2_remark;
                $mpc_part_b->mpc_qn_b_3_remark    = $request->mpc_qn_b_3_remark;
                $mpc_part_b->mpc_qn_b_4           = serialize($request->mpc_qn_b_4);
                $mpc_part_b->mpc_qn_b_27_remark    = trim($request->mpc_qn_b_27_remark);
                $mpc_part_b->mpc_qn_b_28          = serialize($request->mpc_qn_b_28);
                $mpc_part_b->save();

                $mpc_part_b_body_sense                      =  new MpcPartBBodySense();
                $mpc_part_b_body_sense->mpc_part_b_id       =  $mpc_part_b->id;
                $mpc_part_b_body_sense->mpc_qn_b_5          =  $request->mpc_qn_b_5;
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
                $mpc_part_b_body_sense->mpc_qn_b_17         =  $request->mpc_qn_b_17;
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

                $mpc_part_c                         =  new MpcPartC();
                $mpc_part_c->incl_assessment_id     =  $inc_assessment->id;
                $mpc_part_c->mpc_qn_c_1             =  $request->mpc_qn_c_1;
                $mpc_part_c->mpc_qn_c_2             =  $request->mpc_qn_c_2;
                $mpc_part_c->mpc_qn_c_3             =  $request->mpc_qn_c_3;
                $mpc_part_c->mpc_qn_c_4             =  $request->mpc_qn_c_4;
                $mpc_part_c->mpc_qn_c_5             =  $request->mpc_qn_c_5;
                $mpc_part_c->mpc_qn_c_6             =  $request->mpc_qn_c_6;
                $mpc_part_c->mpc_qn_c_7_remark      =  $request->mpc_qn_c_7_remark;
                $mpc_part_c->save();

                $mpc_part_d                       =  new MpcPartD();
                $mpc_part_d->incl_assessment_id   =  $inc_assessment->id;
                $mpc_part_d->mpc_qn_d_1           =  $request->mpc_qn_d_1;
                $mpc_part_d->mpc_qn_d_2           =  $request->mpc_qn_d_2;
                $mpc_part_d->save();


                $mpc_part_e                         = new MpcPartE();
                $mpc_part_e->incl_assessment_id     =  $inc_assessment->id;
                $mpc_part_e->mpc_qn_e_1             =  $request->mpc_qn_e_1;
                $mpc_part_e->mpc_qn_e_2             =  $request->mpc_qn_e_2;
                $mpc_part_e->mpc_qn_e_3             =  $request->mpc_qn_e_3;
                $mpc_part_e->mpc_qn_e_4             =  $request->mpc_qn_e_4;
                $mpc_part_e->mpc_qn_e_5             =  $request->mpc_qn_e_5;
                $mpc_part_e->mpc_qn_e_6             =  $request->mpc_qn_e_6;
                $mpc_part_e->mpc_qn_e_7             =  $request->mpc_qn_e_7;
                $mpc_part_e->mpc_qn_e_8_remark      =  $request->mpc_qn_e_8_remark;
                $mpc_part_e->save();


                $mpc_part_f                       =  new MpcPartF();
                $mpc_part_f->incl_assessment_id   =  $inc_assessment->id;
                $mpc_part_f->mpc_qn_f_1           =  $request->mpc_qn_f_1;
                $mpc_part_f->mpc_qn_f_2_remark    =  $request->mpc_qn_f_2_remark;
                $mpc_part_f->mpc_qn_f_3           =  $request->mpc_qn_f_3;
                $mpc_part_f->mpc_qn_f_4_remark    =  $request->mpc_qn_f_4_remark;
                $mpc_part_f->mpc_qn_f_5           =  $request->mpc_qn_f_5;
                $mpc_part_f->mpc_qn_f_6           =  $request->mpc_qn_f_6;
                $mpc_part_f->mpc_qn_f_7_remark    =  $request->mpc_qn_f_7_remark;
                $mpc_part_f->save();

                $mpc_perf_area                            =  new MpcPerformanceArea();
                $mpc_perf_area->incl_assessment_id        =  $inc_assessment->id;
                $mpc_perf_area->mpc_perf_area_1           =  serialize($request->mpc_qn_perf_area_1);
                $mpc_perf_area->mpc_perf_area_2           =  serialize($request->mpc_qn_perf_area_2);
                $mpc_perf_area->mpc_perf_area_3           =  serialize($request->mpc_qn_perf_area_3);
                $mpc_perf_area->mpc_perf_area_4           =  serialize($request->mpc_qn_perf_area_4) ;
                $mpc_perf_area->mpc_perf_area_5           =  serialize($request->mpc_qn_perf_area_5) ;
                $mpc_perf_area->mpc_perf_area_6           =  serialize($request->mpc_qn_perf_area_6);
                $mpc_perf_area->save();


                $mpc_context                           =  new MpcContext();
                $mpc_context->incl_assessment_id       =  $inc_assessment->id;
                $mpc_context->mpc_context_1            =  $request->mpc_context_1;
                $mpc_context->mpc_context_2            =  $request->mpc_context_2;
                $mpc_context->mpc_context_3_remark     =  $request->mpc_context_3_remark;
                $mpc_context->mpc_context_4            =  $request->mpc_context_4;
                $mpc_context->mpc_context_5            =  serialize($request->mpc_context_5);
                $mpc_context->mpc_context_5_remark     =  $request->mpc_context_5_remark;
                $mpc_context->mpc_context_6            =  $request->mpc_context_6;
                $mpc_context->mpc_context_6_remark     =  $request->mpc_context_6_remark;
                $mpc_context->mpc_context_7            =  $request->mpc_context_7;
                $mpc_context->mpc_context_8            =  $request->mpc_context_8;   
                $mpc_context->mpc_context_9            =  $request->mpc_context_9;
                $mpc_context->mpc_context_9_remark     =  $request->mpc_context_9_remark;
                $mpc_context->mpc_context_10           =  $request->mpc_context_10;
                $mpc_context->mpc_context_11           =  $request->mpc_context_11;
                $mpc_context->mpc_context_12           =  $request->mpc_context_12;
                $mpc_context->mpc_context_13           =  $request->mpc_context_13;
                $mpc_context->mpc_context_14           =  $request->mpc_context_14;
                $mpc_context->mpc_context_15_remark    =  $request->mpc_context_15_remark;
                $mpc_context->mpc_context_16           =  $request->mpc_context_16;
                $mpc_context->mpc_context_16_remark    =  $request->mpc_context_16_remark;
                $mpc_context->save();

                $mpc_swot                        =  new MpcSwot();
                $mpc_swot->incl_assessment_id    =  $inc_assessment->id;
                $mpc_swot->mpc_swot_1_remark     =  $request->mpc_qn_swot_1_remark;
                $mpc_swot->mpc_swot_2_remark     =  $request->mpc_qn_swot_2_remark;
                $mpc_swot->mpc_swot_3_remark     =  $request->mpc_qn_swot_3_remark;
                $mpc_swot->mpc_swot_4_remark     =  $request->mpc_qn_swot_4_remark;
                $mpc_swot->mpc_swot_5_remark     =  $request->mpc_qn_swot_5_remark;
                $mpc_swot->mpc_swot_6_remark     =  $request->mpc_qn_swot_6_remark;
                $mpc_swot->mpc_swot_7_remark     =  $request->mpc_qn_swot_7_remark;
                $mpc_swot->save();


                $mpc_short_rehab                        =  new MpcShortRehab();
                $mpc_short_rehab->incl_assessment_id    =  $inc_assessment->id;
                $mpc_short_rehab->mpc_short_rehab_1_remark     =  $request->mpc_qn_short_rehab_1_remark;
                $mpc_short_rehab->mpc_short_rehab_2_remark     =  $request->mpc_qn_short_rehab_2_remark;
                $mpc_short_rehab->mpc_short_rehab_3_remark     =  $request->mpc_qn_short_rehab_3_remark;
                $mpc_short_rehab->mpc_short_rehab_4_remark     =  $request->mpc_qn_short_rehab_4_remark;
                $mpc_short_rehab->mpc_short_rehab_5_remark     =  $request->mpc_qn_short_rehab_5_remark;
                $mpc_short_rehab->mpc_short_rehab_6_remark     =  $request->mpc_qn_short_rehab_6_remark;
                $mpc_short_rehab->mpc_short_rehab_7_remark     =  $request->mpc_qn_short_rehab_7_remark;
                $mpc_short_rehab->save();



                $mpc_long_rehab                        =  new MpcLongRehab();
                $mpc_long_rehab->incl_assessment_id    =  $inc_assessment->id;
                $mpc_long_rehab->mpc_long_rehab_1_remark     =  $request->mpc_qn_long_rehab_1_remark;
                $mpc_long_rehab->mpc_long_rehab_2_remark     =  $request->mpc_qn_long_rehab_2_remark;
                $mpc_long_rehab->mpc_long_rehab_3_remark     =  $request->mpc_qn_long_rehab_3_remark;
                $mpc_long_rehab->mpc_long_rehab_4_remark     =  $request->mpc_qn_long_rehab_4_remark;
                $mpc_long_rehab->mpc_long_rehab_5_remark     =  $request->mpc_qn_long_rehab_5_remark;
                $mpc_long_rehab->mpc_long_rehab_6_remark     =  $request->mpc_qn_long_rehab_6_remark;
                $mpc_long_rehab->mpc_long_rehab_7_remark     =  $request->mpc_qn_long_rehab_7_remark;
                $mpc_long_rehab->mpc_long_rehab_8_remark     =  $request->mpc_qn_long_rehab_8_remark;
                $mpc_long_rehab->mpc_long_rehab_9_remark     =  $request->mpc_qn_long_rehab_9_remark;
                $mpc_long_rehab->save();

                $lower_limb_row_1   = array( 'rom_l_hip_0_1'   => $request->rom_l_hip_0_1,     'rom_l_hip_0_2'   => $request->rom_l_hip_0_2,   'rom_l_hip_0_3'    => $request->rom_l_hip_0_3,  'rom_r_hip_0_1'   => $request->rom_r_hip_0_1,    'rom_r_hip_0_2'    => $request->rom_r_hip_0_2,   'rom_r_hip_0_3'   => $request->rom_r_hip_0_3,
                                             'ms_l_hip_0_1'    => $request->ms_l_hip_0_1,      'ms_l_hip_0_2'    => $request->ms_l_hip_0_2,    'ms_l_hip_0_3'     => $request->ms_l_hip_0_3,   'ms_r_hip_0_1'    => $request->ms_r_hip_0_1,     'ms_r_hip_0_2'     => $request->ms_r_hip_0_2,    'ms_r_hip_0_3'    => $request->ms_r_hip_0_3   );
                $lower_limb_row_2   = array( 'rom_l_hip_1_1'   => $request->rom_l_hip_1_1,     'rom_l_hip_1_2'   => $request->rom_l_hip_1_2,   'rom_l_hip_1_3'    => $request->rom_l_hip_1_3,  'rom_r_hip_1_1'   => $request->rom_r_hip_1_1,    'rom_r_hip_1_2'    => $request->rom_r_hip_1_2,   'rom_r_hip_1_3'   => $request->rom_r_hip_1_3,
                                             'ms_l_hip_1_1'    => $request->ms_l_hip_1_1,      'ms_l_hip_1_2'    => $request->ms_l_hip_1_2,    'ms_l_hip_1_3'     => $request->ms_l_hip_1_3,   'ms_r_hip_1_1'    => $request->ms_r_hip_1_1,     'ms_r_hip_1_2'     => $request->ms_r_hip_1_2,    'ms_r_hip_1_3'    => $request->ms_r_hip_1_3   );
                $lower_limb_row_3   = array( 'rom_l_hip_2_1'   => $request->rom_l_hip_2_1,     'rom_l_hip_2_2'   => $request->rom_l_hip_2_2,   'rom_l_hip_2_3'    => $request->rom_l_hip_2_3,  'rom_r_hip_2_1'   => $request->rom_r_hip_2_1,    'rom_r_hip_2_2'    => $request->rom_r_hip_2_2,   'rom_r_hip_2_3'   => $request->rom_r_hip_2_3,
                                             'ms_l_hip_2_1'    => $request->ms_l_hip_2_1,      'ms_l_hip_2_2'    => $request->ms_l_hip_2_2,    'ms_l_hip_2_3'     => $request->ms_l_hip_2_3,   'ms_r_hip_2_1'    => $request->ms_r_hip_2_1,     'ms_r_hip_2_2'     => $request->ms_r_hip_2_2,    'ms_r_hip_2_3'    => $request->ms_r_hip_2_3   );
                $lower_limb_row_4   = array( 'rom_l_hip_3_1'   => $request->rom_l_hip_3_1,     'rom_l_hip_3_2'   => $request->rom_l_hip_3_2,   'rom_l_hip_3_3'    => $request->rom_l_hip_3_3,  'rom_r_hip_3_1'   => $request->rom_r_hip_3_1,    'rom_r_hip_3_2'    => $request->rom_r_hip_3_2,   'rom_r_hip_3_3'   => $request->rom_r_hip_3_3,
                                             'ms_l_hip_3_1'    => $request->ms_l_hip_3_1,      'ms_l_hip_3_2'    => $request->ms_l_hip_3_2,    'ms_l_hip_3_3'     => $request->ms_l_hip_3_3,   'ms_r_hip_3_1'    => $request->ms_r_hip_3_1,     'ms_r_hip_3_2'     => $request->ms_r_hip_3_2,    'ms_r_hip_3_3'    => $request->ms_r_hip_3_3   );
                $lower_limb_row_5   = array( 'rom_l_hip_4_1'   => $request->rom_l_hip_4_1,     'rom_l_hip_4_2'   => $request->rom_l_hip_4_2,   'rom_l_hip_4_3'    => $request->rom_l_hip_4_3,  'rom_r_hip_4_1'   => $request->rom_r_hip_4_1,    'rom_r_hip_4_2'    => $request->rom_r_hip_4_2,   'rom_r_hip_4_3'   => $request->rom_r_hip_4_3,
                                             'ms_l_hip_4_1'    => $request->ms_l_hip_4_1,      'ms_l_hip_4_2'    => $request->ms_l_hip_4_2,    'ms_l_hip_4_3'     => $request->ms_l_hip_4_3,   'ms_r_hip_4_1'    => $request->ms_r_hip_4_1,     'ms_r_hip_4_2'     => $request->ms_r_hip_4_2,    'ms_r_hip_4_3'    => $request->ms_r_hip_4_3   );
                $lower_limb_row_6   = array( 'rom_l_hip_5_1'   => $request->rom_l_hip_5_1,     'rom_l_hip_5_2'   => $request->rom_l_hip_5_2,   'rom_l_hip_5_3'    => $request->rom_l_hip_5_3,  'rom_r_hip_5_1'   => $request->rom_r_hip_5_1,    'rom_r_hip_5_2'    => $request->rom_r_hip_5_2,   'rom_r_hip_5_3'   => $request->rom_r_hip_5_3,
                                             'ms_l_hip_5_1'    => $request->ms_l_hip_5_1,      'ms_l_hip_5_2'    => $request->ms_l_hip_5_2,    'ms_l_hip_5_3'     => $request->ms_l_hip_5_3,   'ms_r_hip_5_1'    => $request->ms_r_hip_5_1,     'ms_r_hip_5_2'     => $request->ms_r_hip_5_2,    'ms_r_hip_5_3'    => $request->ms_r_hip_5_3 );
                $lower_limb_row_7   = array( 'rom_l_knee_0_1'  => $request->rom_l_knee_0_1,    'rom_l_knee_0_2'  => $request->rom_l_knee_0_2,  'rom_l_knee_0_3'   => $request->rom_l_knee_0_3, 'rom_r_knee_0_1'  => $request->rom_r_knee_0_1,   'rom_r_knee_0_2'   => $request->rom_r_knee_0_2,  'rom_r_knee_0_3'  => $request->rom_r_knee_0_3,
                                             'ms_l_knee_0_1'   => $request->ms_l_knee_0_1,     'ms_l_knee_0_2'   => $request->ms_l_knee_0_2,   'ms_l_knee_0_3'    => $request->ms_l_knee_0_3,  'ms_r_knee_0_1'   => $request->ms_r_knee_0_1,    'ms_r_knee_0_2'    => $request->ms_r_knee_0_2,   'ms_r_knee_0_3'   => $request->ms_r_knee_0_3 );
                $lower_limb_row_8   = array( 'rom_l_knee_1_1'  => $request->rom_l_knee_1_1,    'rom_l_knee_1_2'  => $request->rom_l_knee_1_2,  'rom_l_knee_1_3'   => $request->rom_l_knee_1_3, 'rom_r_knee_1_1'  => $request->rom_r_knee_1_1,   'rom_r_knee_1_2'   => $request->rom_r_knee_1_2,  'rom_r_knee_1_3'  => $request->rom_r_knee_1_3,
                                             'ms_l_knee_1_1'   => $request->ms_l_knee_1_1,     'ms_l_knee_1_2'   => $request->ms_l_knee_1_2,   'ms_l_knee_1_3'    => $request->ms_l_knee_1_3,  'ms_r_knee_1_1'   => $request->ms_r_knee_1_1,    'ms_r_knee_1_2'    => $request->ms_r_knee_1_2,   'ms_r_knee_1_3'   => $request->ms_r_knee_1_3 );
                $lower_limb_row_9   = array( 'rom_l_foot_0_1'  => $request->rom_l_foot_0_1,    'rom_l_foot_0_2'  => $request->rom_l_foot_0_2,  'rom_l_foot_0_3'   => $request->rom_l_foot_0_3, 'rom_r_foot_0_1'  => $request->rom_r_foot_0_1,   'rom_r_foot_0_2'   => $request->rom_r_foot_0_2,  'rom_r_foot_0_3'  => $request->rom_r_foot_0_3,
                                             'ms_l_foot_0_1'   => $request->ms_l_foot_0_1,     'ms_l_foot_0_2'   => $request->ms_l_foot_0_2,   'ms_l_foot_0_3'    => $request->ms_l_foot_0_3,  'ms_r_foot_0_1'   => $request->ms_r_foot_0_1,    'ms_r_foot_0_2'    => $request->ms_r_foot_0_2,   'ms_r_foot_0_3'   => $request->ms_r_foot_0_3 );
                 $lower_limb_row_10 = array( 'rom_l_foot_1_1'  => $request->rom_l_foot_1_1,    'rom_l_foot_1_2'  => $request->rom_l_foot_1_2,  'rom_l_foot_1_3'   => $request->rom_l_foot_1_3, 'rom_r_foot_1_1'  => $request->rom_r_foot_1_1,   'rom_r_foot_1_2'   => $request->rom_r_foot_1_2,  'rom_r_foot_1_3'  => $request->rom_r_foot_1_3,
                                             'ms_l_foot_1_1'   => $request->ms_l_foot_1_1,     'ms_l_foot_1_2'   => $request->ms_l_foot_1_2,   'ms_l_foot_1_3'    => $request->ms_l_foot_1_3,  'ms_r_foot_1_1'   => $request->ms_r_foot_1_1,    'ms_r_foot_1_2'    => $request->ms_r_foot_1_2,   'ms_r_foot_1_3'   => $request->ms_r_foot_1_3 );
                 $lower_limb_row_11 = array( 'rom_l_foot_2_1'  => $request->rom_l_foot_2_1,    'rom_l_foot_2_2'  => $request->rom_l_foot_2_2,  'rom_l_foot_2_3'   => $request->rom_l_foot_2_3, 'rom_r_foot_2_1'  => $request->rom_r_foot_2_1,   'rom_r_foot_2_2'   => $request->rom_r_foot_2_2,  'rom_r_foot_2_3'  => $request->rom_r_foot_2_3,
                                             'ms_l_foot_2_1'   => $request->ms_l_foot_2_1,     'ms_l_foot_2_2'   => $request->ms_l_foot_2_2,   'ms_l_foot_2_3'    => $request->ms_l_foot_2_3,  'ms_r_foot_2_1'   => $request->ms_r_foot_2_1,    'ms_r_foot_2_2'    => $request->ms_r_foot_2_2,   'ms_r_foot_2_3'   => $request->ms_r_foot_2_3 );
                 $lower_limb_row_12 = array( 'rom_l_foot_3_1'  => $request->rom_l_foot_3_1,    'rom_l_foot_3_2'  => $request->rom_l_foot_3_2,  'rom_l_foot_3_3'   => $request->rom_l_foot_3_3, 'rom_r_foot_3_1'  => $request->rom_r_foot_3_1,   'rom_r_foot_3_2'   => $request->rom_r_foot_3_2,  'rom_r_foot_3_3'  => $request->rom_r_foot_3_3,
                                             'ms_l_foot_3_1'   => $request->ms_l_foot_3_1,     'ms_l_foot_3_2'   => $request->ms_l_foot_3_2,   'ms_l_foot_3_3'    => $request->ms_l_foot_3_3,  'ms_r_foot_3_1'   => $request->ms_r_foot_3_1,    'ms_r_foot_3_2'    => $request->ms_r_foot_3_2,   'ms_r_foot_3_3'   => $request->ms_r_foot_3_3 );
                 $lower_limb_row_13 = array( 'rom_l_trunk_0_1' => $request->rom_l_foot_0_1,    'rom_l_trunk_0_2' => $request->rom_l_trunk_0_2, 'rom_l_trunk_0_3'  => $request->rom_l_trunk_0_3,'rom_r_trunk_0_1' => $request->rom_r_trunk_0_1,  'rom_r_trunk_0_2'  => $request->rom_r_trunk_0_2, 'rom_r_trunk_0_3' => $request->rom_r_trunk_0_3,
                                             'ms_l_trunk_0_1'  => $request->ms_l_trunk_0_1,    'ms_l_trunk_0_2'  => $request->ms_l_trunk_0_2,  'ms_l_trunk_0_3'   => $request->ms_l_trunk_0_3, 'ms_r_trunk_0_1'  => $request->ms_r_trunk_0_1,   'ms_r_trunk_0_2'   => $request->ms_r_trunk_0_2,  'ms_r_trunk_0_3'  => $request->ms_r_trunk_0_3 );
                 $lower_limb_row_14 = array( 'rom_l_trunk_1_1' => $request->rom_l_trunk_1_1,   'rom_l_trunk_1_2' => $request->rom_l_trunk_1_2, 'rom_l_trunk_1_3'  => $request->rom_l_trunk_1_3,'rom_r_trunk_1_1' => $request->rom_r_trunk_1_1,  'rom_r_trunk_1_2'  => $request->rom_r_trunk_1_2, 'rom_r_trunk_1_3' => $request->rom_r_trunk_1_3,
                                             'ms_l_trunk_1_1'  => $request->ms_l_trunk_1_1,    'ms_l_trunk_1_2'  => $request->ms_l_trunk_1_2,  'ms_l_trunk_1_3'   => $request->ms_l_trunk_1_3, 'ms_r_trunk_1_1'  => $request->ms_r_trunk_1_1,   'ms_r_trunk_1_2'   => $request->ms_r_trunk_1_2,  'ms_r_trunk_1_3'  => $request->ms_r_trunk_1_3 );

                 $mpcLowerLimb = new MpcPartARomLower();
                 $mpcLowerLimb->incl_assessment_id    =  $inc_assessment->id;
                 $mpcLowerLimb->lower_limb_row_1  = serialize($lower_limb_row_1);
                 $mpcLowerLimb->lower_limb_row_2  = serialize($lower_limb_row_2);
                 $mpcLowerLimb->lower_limb_row_3  = serialize($lower_limb_row_3);
                 $mpcLowerLimb->lower_limb_row_4  = serialize($lower_limb_row_4);
                 $mpcLowerLimb->lower_limb_row_5  = serialize($lower_limb_row_5);
                 $mpcLowerLimb->lower_limb_row_6  = serialize($lower_limb_row_6);
                 $mpcLowerLimb->lower_limb_row_7  = serialize($lower_limb_row_7);
                 $mpcLowerLimb->lower_limb_row_8  = serialize($lower_limb_row_8);
                 $mpcLowerLimb->lower_limb_row_9  = serialize($lower_limb_row_9);
                 $mpcLowerLimb->lower_limb_row_10 = serialize($lower_limb_row_10);
                 $mpcLowerLimb->lower_limb_row_11 = serialize($lower_limb_row_11);
                 $mpcLowerLimb->lower_limb_row_12 = serialize($lower_limb_row_12);
                 $mpcLowerLimb->lower_limb_row_13 = serialize($lower_limb_row_13);
                 $mpcLowerLimb->lower_limb_row_14 = serialize($lower_limb_row_14);
                 $mpcLowerLimb->save();
                
                 $upper_limb_row_1   = array( 'rom_l_shoulder_and_arm_0_1'=> $request->rom_l_shoulder_and_arm_0_1,  'rom_l_shoulder_and_arm_0_2' => $request->rom_l_shoulder_and_arm_0_2, 'rom_l_shoulder_and_arm_0_3' => $request->rom_l_shoulder_and_arm_0_3,  'rom_r_shoulder_and_arm_0_1' => $request->rom_r_shoulder_and_arm_0_1,   'rom_r_shoulder_and_arm_0_2'  => $request->rom_r_shoulder_and_arm_0_2,   'rom_r_shoulder_and_arm_0_3' => $request->rom_r_shoulder_and_arm_0_3,
                                         'ms_l_shoulder_and_arm_0_1'      => $request->ms_l_shoulder_and_arm_0_1,   'ms_l_shoulder_and_arm_0_2'  => $request->ms_l_shoulder_and_arm_0_2,  'ms_l_shoulder_and_arm_0_3'  => $request->ms_l_shoulder_and_arm_0_3,   'ms_r_shoulder_and_arm_0_1'  => $request->ms_r_shoulder_and_arm_0_1,    'ms_r_shoulder_and_arm_0_2'   => $request->ms_r_shoulder_and_arm_0_2,    'ms_r_shoulder_and_arm_0_3'  => $request->ms_r_shoulder_and_arm_0_3 );
                 $upper_limb_row_2   = array( 'rom_l_shoulder_and_arm_1_1'=> $request->rom_l_shoulder_and_arm_1_1,  'rom_l_shoulder_and_arm_1_2' => $request->rom_l_shoulder_and_arm_1_2, 'rom_l_shoulder_and_arm_1_3' => $request->rom_l_shoulder_and_arm_1_3,  'rom_r_shoulder_and_arm_1_1' => $request->rom_r_shoulder_and_arm_1_1,   'rom_r_shoulder_and_arm_1_2'  => $request->rom_r_shoulder_and_arm_1_2,   'rom_r_shoulder_and_arm_1_3' => $request->rom_r_shoulder_and_arm_1_3,
                                         'ms_l_shoulder_and_arm_1_1'      => $request->ms_l_shoulder_and_arm_1_1,   'ms_l_shoulder_and_arm_1_2'  => $request->ms_l_shoulder_and_arm_1_2,  'ms_l_shoulder_and_arm_1_3'  => $request->ms_l_shoulder_and_arm_1_3,   'ms_r_shoulder_and_arm_1_1'  => $request->ms_r_shoulder_and_arm_1_1,    'ms_r_shoulder_and_arm_1_2'   => $request->ms_r_shoulder_and_arm_1_2,    'ms_r_shoulder_and_arm_1_3'  => $request->ms_r_shoulder_and_arm_1_3 );
                 $upper_limb_row_3   = array( 'rom_l_shoulder_and_arm_2_1'=> $request->rom_l_shoulder_and_arm_2_1,  'rom_l_shoulder_and_arm_2_2' => $request->rom_l_shoulder_and_arm_2_2, 'rom_l_shoulder_and_arm_2_3' => $request->rom_l_shoulder_and_arm_2_3,  'rom_r_shoulder_and_arm_2_1' => $request->rom_r_shoulder_and_arm_2_1,   'rom_r_shoulder_and_arm_2_2'  => $request->rom_r_shoulder_and_arm_2_2,   'rom_r_shoulder_and_arm_2_3' => $request->rom_r_shoulder_and_arm_2_3,
                                         'ms_l_shoulder_and_arm_2_1'      => $request->ms_l_shoulder_and_arm_2_1,   'ms_l_shoulder_and_arm_2_2'  => $request->ms_l_shoulder_and_arm_2_2,  'ms_l_shoulder_and_arm_2_3'  => $request->ms_l_shoulder_and_arm_2_3,   'ms_r_shoulder_and_arm_2_1'  => $request->ms_r_shoulder_and_arm_2_1,    'ms_r_shoulder_and_arm_2_2'   => $request->ms_r_shoulder_and_arm_2_2,    'ms_r_shoulder_and_arm_2_3'  => $request->ms_r_shoulder_and_arm_2_3 );
                 $upper_limb_row_4   = array( 'rom_l_shoulder_and_arm_3_1'=> $request->rom_l_shoulder_and_arm_3_1,  'rom_l_shoulder_and_arm_3_2' => $request->rom_l_shoulder_and_arm_3_2, 'rom_l_shoulder_and_arm_3_3' => $request->rom_l_shoulder_and_arm_3_3,  'rom_r_shoulder_and_arm_3_1' => $request->rom_r_shoulder_and_arm_3_1,   'rom_r_shoulder_and_arm_3_2'  => $request->rom_r_shoulder_and_arm_3_2,   'rom_r_shoulder_and_arm_3_3' => $request->rom_r_shoulder_and_arm_3_3,
                                         'ms_l_shoulder_and_arm_3_1'      => $request->ms_l_shoulder_and_arm_3_1,   'ms_l_shoulder_and_arm_3_2'  => $request->ms_l_shoulder_and_arm_3_2,  'ms_l_shoulder_and_arm_3_3'  => $request->ms_l_shoulder_and_arm_3_3,   'ms_r_shoulder_and_arm_3_1'  => $request->ms_r_shoulder_and_arm_3_1,    'ms_r_shoulder_and_arm_3_2'   => $request->ms_r_shoulder_and_arm_3_2,    'ms_r_shoulder_and_arm_3_3'  => $request->ms_r_shoulder_and_arm_3_3 );
                 $upper_limb_row_5   = array( 'rom_l_elbow_forearm_0_1'   => $request->rom_l_elbow_forearm_0_1,     'rom_l_elbow_forearm_0_2'    => $request->rom_l_elbow_forearm_0_2,    'rom_l_elbow_forearm_0_3'    => $request->rom_l_elbow_forearm_0_3,     'rom_r_elbow_forearm_0_1'    => $request->rom_r_elbow_forearm_0_1,      'rom_r_elbow_forearm_0_2'     => $request->rom_r_elbow_forearm_0_2,      'rom_r_elbow_forearm_0_3'    => $request->rom_r_elbow_forearm_0_3,
                                         'ms_l_elbow_forearm_0_1'         => $request->ms_l_elbow_forearm_0_1,      'ms_l_elbow_forearm_0_2'     => $request->ms_l_elbow_forearm_0_2,     'ms_l_elbow_forearm_0_3'     => $request->ms_l_elbow_forearm_0_3,      'ms_r_elbow_forearm_0_1'     => $request->ms_r_elbow_forearm_0_1,       'ms_r_elbow_forearm_0_2'      => $request->ms_r_elbow_forearm_0_2,       'ms_r_elbow_forearm_0_3'     => $request->ms_r_elbow_forearm_0_3 );
                 $upper_limb_row_6   = array( 'rom_l_elbow_forearm_1_1'   => $request->rom_l_elbow_forearm_1_1,     'rom_l_elbow_forearm_1_2'    => $request->rom_l_elbow_forearm_1_2,    'rom_l_elbow_forearm_1_3'    => $request->rom_l_elbow_forearm_1_3,     'rom_r_elbow_forearm_1_1'    => $request->rom_r_elbow_forearm_1_1,      'rom_r_elbow_forearm_1_2'     => $request->rom_r_elbow_forearm_1_2,      'rom_r_elbow_forearm_1_3'    => $request->rom_r_elbow_forearm_1_3,
                                         'ms_l_elbow_forearm_1_1'         => $request->ms_l_elbow_forearm_1_1,      'ms_l_elbow_forearm_1_2'     => $request->ms_l_elbow_forearm_1_2,     'ms_l_elbow_forearm_1_3'     => $request->ms_l_elbow_forearm_1_3,      'ms_r_elbow_forearm_1_1'     => $request->ms_r_elbow_forearm_1_1,       'ms_r_elbow_forearm_1_2'      => $request->ms_r_elbow_forearm_1_2,       'ms_r_elbow_forearm_1_3'     => $request->ms_r_elbow_forearm_1_3 );
                 $upper_limb_row_7   = array( 'rom_l_elbow_forearm_2_1'   => $request->rom_l_elbow_forearm_2_1,     'rom_l_elbow_forearm_2_2'    => $request->rom_l_elbow_forearm_2_2,    'rom_l_elbow_forearm_2_3'    => $request->rom_l_elbow_forearm_2_3,     'rom_r_elbow_forearm_2_1'    => $request->rom_r_elbow_forearm_2_1,      'rom_r_elbow_forearm_2_2'     => $request->rom_r_elbow_forearm_2_2,      'rom_r_elbow_forearm_2_3'    => $request->rom_r_elbow_forearm_2_3,
                                         'ms_l_elbow_forearm_2_1'         => $request->ms_l_elbow_forearm_2_1,      'ms_l_elbow_forearm_2_2'     => $request->ms_l_elbow_forearm_2_2,     'ms_l_elbow_forearm_2_3'     => $request->ms_l_elbow_forearm_2_3,      'ms_r_elbow_forearm_2_1'     => $request->ms_r_elbow_forearm_2_1,       'ms_r_elbow_forearm_2_2'      => $request->ms_r_elbow_forearm_2_2,       'ms_r_elbow_forearm_2_3'     => $request->ms_r_elbow_forearm_2_3 );
                 $upper_limb_row_8   = array( 'rom_l_elbow_forearm_3_1'   => $request->rom_l_elbow_forearm_3_1,     'rom_l_elbow_forearm_3_2'    => $request->rom_l_elbow_forearm_3_2,    'rom_l_elbow_forearm_3_3'    => $request->rom_l_elbow_forearm_3_3,     'rom_r_elbow_forearm_3_1'    => $request->rom_r_elbow_forearm_3_1,      'rom_r_elbow_forearm_3_2'     => $request->rom_r_elbow_forearm_3_2,      'rom_r_elbow_forearm_3_3'    => $request->rom_r_elbow_forearm_3_3,
                                         'ms_l_elbow_forearm_3_1'         => $request->ms_l_elbow_forearm_3_1,      'ms_l_elbow_forearm_3_2'     => $request->ms_l_elbow_forearm_3_2,     'ms_l_elbow_forearm_3_3'     => $request->ms_l_elbow_forearm_3_3,      'ms_r_elbow_forearm_3_1'     => $request->ms_r_elbow_forearm_3_1,       'ms_r_elbow_forearm_3_2'      => $request->ms_r_elbow_forearm_3_2,       'ms_r_elbow_forearm_3_3'     => $request->ms_r_elbow_forearm_3_3);
                 $upper_limb_row_9   = array( 'rom_l_wirst_0_1'           => $request->rom_l_wirst_0_1,             'rom_l_wirst_0_2'            => $request->rom_l_wirst_0_2,            'rom_l_wirst_0_3'            => $request->rom_l_wirst_0_3,             'rom_r_wirst_0_1'            => $request->rom_r_wirst_0_1,              'rom_r_wirst_0_2'             => $request->rom_r_wirst_0_2,              'rom_r_wirst_0_3'            => $request->rom_r_wirst_0_3,
                                         'ms_l_wirst_0_1'                 => $request->ms_l_wirst_0_1,              'ms_l_wirst_0_2'             => $request->ms_l_wirst_0_2,             'ms_l_wirst_0_3'             => $request->ms_l_wirst_0_3,              'ms_r_wirst_0_1'             => $request->ms_r_wirst_0_1,               'ms_r_wirst_0_2'              => $request->ms_r_wirst_0_2,               'ms_r_wirst_0_3'             => $request->ms_r_wirst_0_3 );
                 $upper_limb_row_10  = array( 'rom_l_wirst_1_1'           => $request->rom_l_wirst_1_1,             'rom_l_wirst_1_2'            => $request->rom_l_wirst_1_2,            'rom_l_wirst_1_3'            => $request->rom_l_wirst_1_3,             'rom_r_wirst_1_1'            => $request->rom_r_wirst_1_1,              'rom_r_wirst_1_2'             => $request->rom_r_wirst_1_2,              'rom_r_wirst_1_3'            => $request->rom_r_wirst_1_3,
                                         'ms_l_wirst_1_1'                 => $request->ms_l_wirst_1_1,              'ms_l_wirst_1_2'             => $request->ms_l_wirst_1_2,             'ms_l_wirst_1_3'             => $request->ms_l_wirst_1_3,              'ms_r_wirst_1_1'             => $request->ms_r_wirst_1_1,               'ms_r_wirst_1_2'              => $request->ms_r_wirst_1_2,               'ms_r_wirst_1_3'             => $request->ms_r_wirst_1_3 );
                 $upper_limb_row_11  = array( 'rom_l_hands_0_1'           => $request->rom_l_hands_0_1,             'rom_l_hands_0_2'            => $request->rom_l_hands_0_2,            'rom_l_hands_0_3'            => $request->rom_l_hands_0_3,             'rom_r_hands_0_1'            => $request->rom_r_hands_0_1,              'rom_r_hands_0_2'             => $request->rom_r_hands_0_2,              'rom_r_hands_0_3'            => $request->rom_r_hands_0_3,
                                         'ms_l_hands_0_1'                 => $request->ms_l_hands_0_1,              'ms_l_hands_0_2'             => $request->ms_l_hands_0_2,             'ms_l_hands_0_3'             => $request->ms_l_hands_0_3,              'ms_r_hands_0_1'             => $request->ms_r_hands_0_1,               'ms_r_hands_0_2'              => $request->ms_r_hands_0_2,               'ms_r_hands_0_3'             => $request->ms_r_hands_0_3 );
                 $upper_limb_row_12  = array( 'rom_l_hands_1_1'           => $request->rom_l_hands_1_1,             'rom_l_hands_1_2'            => $request->rom_l_hands_1_2,            'rom_l_hands_1_3'            => $request->rom_l_hands_1_3,             'rom_r_hands_1_1'            => $request->rom_r_hands_1_1,              'rom_r_hands_1_2'             => $request->rom_r_hands_1_2,              'rom_r_hands_1_3'            => $request->rom_r_hands_1_3,
                                         'ms_l_hands_1_1'                 => $request->ms_l_hands_1_1,              'ms_l_hands_1_2'             => $request->ms_l_hands_1_2,             'ms_l_hands_1_3'             => $request->ms_l_hands_1_3,              'ms_r_hands_1_1'             => $request->ms_r_hands_1_1,               'ms_r_hands_1_2'              => $request->ms_r_hands_1_2,               'ms_r_hands_1_3'             => $request->ms_r_hands_1_3 );

                 $mpcUpperLimb = new MpcPartARomUpper();
                 $mpcUpperLimb->incl_assessment_id    =  $inc_assessment->id;
                 $mpcUpperLimb->upper_limb_row_1 = serialize($upper_limb_row_1);
                 $mpcUpperLimb->upper_limb_row_2 = serialize($upper_limb_row_2);
                 $mpcUpperLimb->upper_limb_row_3 = serialize($upper_limb_row_3);
                 $mpcUpperLimb->upper_limb_row_4 = serialize($upper_limb_row_4);
                 $mpcUpperLimb->upper_limb_row_5 = serialize($upper_limb_row_5);
                 $mpcUpperLimb->upper_limb_row_6 = serialize($upper_limb_row_6);
                 $mpcUpperLimb->upper_limb_row_7 = serialize($upper_limb_row_7);
                 $mpcUpperLimb->upper_limb_row_8 = serialize($upper_limb_row_8);
                 $mpcUpperLimb->upper_limb_row_9 = serialize($upper_limb_row_9);
                 $mpcUpperLimb->upper_limb_row_10 = serialize($upper_limb_row_10);
                 $mpcUpperLimb->upper_limb_row_11 = serialize($upper_limb_row_11);
                 $mpcUpperLimb->upper_limb_row_12 = serialize($upper_limb_row_12);
                 $mpcUpperLimb->save();
                //two more table remain
                return response()->json([
                    'success' => true,
                    'action' => 'add',
                    'message' => "<div class='alert alert-success remove-alert'><strong>Success!</strong> Inclusion Assessment was submitted successifully</div>"
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
                'message' => "<div class='alert alert-danger remove-alert'><strong>Error!</strong> Sorry, No such Inclusion Assessment in our system</div>"
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

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getClientData($id)
    {


        $incl_assessment =  InclusionAssessment::find($id);

      if(!empty($incl_assessment)){
          $client             =   Client::find($incl_assessment->client_id);
          $assessor           =   User::find($incl_assessment->assessor_id);
          $imhistory          =   $incl_assessment->inclusionMedicalHistory;
          $mpc_part_a         =   $incl_assessment->mpcPartA;
          $mpc_part_b         =   $incl_assessment->mpcPartB;
          $mpc_part_c         =   $incl_assessment->mpcPartC;
          $mpc_part_d         =   $incl_assessment->mpcPartD;
          $mpc_part_e         =   $incl_assessment->mpcPartE;
          $mpc_part_f         =   $incl_assessment->mpcPartF;
          $mpc_part_a_posture =   $mpc_part_a ->mpcPartAPosture;
          $moving_pattern     =   $mpc_part_a ->mpcPartAMovingPattern;
          $mpcbody_sense      =   $mpc_part_b ->mpcPartBBodySense;
          $mpc_perf_area      =   $incl_assessment->mpcPerformanceArea;
          $mpc_context        =   $incl_assessment->mpcContext;
          $mpc_swot           =   $incl_assessment->mpcSwot;
          $mpc_short_rehab    =   $incl_assessment->mpcShortRehab;
          $mpc_long_rehab     =   $incl_assessment->mpcLongRehab;
          $mpc_lower_limb     =   $incl_assessment->mpcPartARomLower;
          $mpc_upper_limb     =   $incl_assessment->mpcPartARomUpper;
          
          return view('assessments.inclusion.view', compact(
                                                            'client','mpc_part_a_posture','mpc_swot','incl_assessment',
                                                            'assessor','imhistory','mpc_context',
                                                            'mpc_part_a','mpc_part_b','mpc_perf_area',
                                                            'mpc_part_c','mpc_part_d','mpcbody_sense',
                                                            'mpc_part_e','mpc_part_f', 'moving_pattern',
                                                            'mpc_short_rehab','mpc_long_rehab','mpc_lower_limb','mpc_upper_limb'
                                                            ));
      }else {

       $user_requested_resource = '<div class="alert alert-info">
                                      <strong>Info!</strong> Sorry, the client you are trying to accesss is not registered under inclusion assessment.
                                   </div>';

       return view('assessments.inclusion.not_found', compact('user_requested_resource'));
      }



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
         if($request->ajax()){

              try
                {

                   // $client        = Client::findOrFail($id);
                    $incl_assessment =  InclusionAssessment::findOrFail($id);  // DB::table('wheel_chair_assessments')->where('id',  $client->id )->get();
                
                if(!empty($incl_assessment)){

                  
                $imhistory                                = $incl_assessment->inclusionMedicalHistory;
                $imhistory->incl_assessment_id            = $incl_assessment->id;
                $imhistory->med_history_info_qn_1         = $request->med_history_info_qn_1;
                $imhistory->med_history_info_qn_1_remark  = $request->med_history_info_qn_1_remark;
                $imhistory->med_history_info_qn_2         = $request->med_history_info_qn_2;
                $imhistory->med_history_info_qn_2_remark  = $request->med_history_info_qn_2_remark;
                $imhistory->med_history_info_qn_3         = $request->med_history_info_qn_3;
                $imhistory->med_history_info_qn_3_remark  = $request->med_history_info_qn_3_remark;
                $imhistory->med_history_info_qn_4         = $request->med_history_info_qn_4;
                $imhistory->med_history_info_qn_4_remark  = $request->med_history_info_qn_4_remark;
                $imhistory->med_history_info_qn_5         = $request->med_history_info_qn_5;
                $imhistory->med_history_info_qn_5_remark  = $request->med_history_info_qn_5_remark;
                $imhistory->med_history_info_qn_6         = $request->med_history_info_qn_6;
                $imhistory->med_history_info_qn_6_remark  = $request->med_history_info_qn_6_remark;
                $imhistory->med_history_info_qn_7         = $request->med_history_info_qn_7;
                $imhistory->med_history_info_qn_7_remark  = $request->med_history_info_qn_7_remark;
                $imhistory->med_history_info_qn_8         = $request->med_history_info_qn_8;
                $imhistory->med_history_info_qn_8_remark  = $request->med_history_info_qn_8_remark;
                $imhistory->med_history_info_qn_9         = $request->med_history_info_qn_9;
                $imhistory->med_history_info_qn_9_remark  = $request->med_history_info_qn_9_remark;
                $imhistory->med_history_info_qn_10        = $request->med_history_info_qn_10;
                $imhistory->med_history_info_qn_10_remark = $request->med_history_info_qn_10_remark;
                $imhistory->save();

                $mpc_part_a                      = $incl_assessment->mpcPartA;
                $mpc_part_a->incl_assessment_id  = $incl_assessment->id;
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

                $mpc_part_a_posture                     = $mpc_part_a ->mpcPartAPosture;
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
                $mpc_part_a_posture->mpc_qn_a_41_remark = $request->mpc_qn_a_41_remark;
                $mpc_part_a_posture->save();

                $mpc_part_a_moving_pattern                     = $mpc_part_a ->mpcPartAMovingPattern;
                $mpc_part_a_moving_pattern->mpc_part_a_id      = $mpc_part_a->id;
                $mpc_part_a_moving_pattern->mpc_qn_a_42_remark = $request->mpc_qn_a_42_remark;
                $mpc_part_a_moving_pattern->mpc_qn_a_42        = $request->mpc_qn_a_42;
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
                $mpc_part_a_moving_pattern->mpc_qn_a_53        = $request->mpc_qn_a_53;
                $mpc_part_a_moving_pattern->save();

                $mpc_part_b                       = $incl_assessment->mpcPartB;
                $mpc_part_b->incl_assessment_id   = $incl_assessment->id;
                $mpc_part_b->mpc_qn_b_1           = serialize($request->mpc_qn_b_1);
                $mpc_part_b->mpc_qn_b_1_remark    = $request->mpc_qn_b_1_remark;
                $mpc_part_b->mpc_qn_b_2           = serialize($request->mpc_qn_b_2);
                $mpc_part_b->mpc_qn_b_2_remark    = $request->mpc_qn_b_2_remark;
                $mpc_part_b->mpc_qn_b_3_remark    = $request->mpc_qn_b_3_remark;
                $mpc_part_b->mpc_qn_b_4           = serialize($request->mpc_qn_b_4);
                $mpc_part_b->mpc_qn_b_27_remark    = trim($request->mpc_qn_b_27_remark);
                $mpc_part_b->mpc_qn_b_28          = serialize($request->mpc_qn_b_28);
                $mpc_part_b->save();

                $mpc_part_b_body_sense                      =  $mpc_part_b ->mpcPartBBodySense;
                $mpc_part_b_body_sense->mpc_part_b_id       =  $mpc_part_b->id;
                $mpc_part_b_body_sense->mpc_qn_b_5          =  $request->mpc_qn_b_5;
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
                $mpc_part_b_body_sense->mpc_qn_b_17         =  $request->mpc_qn_b_17;
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

                $mpc_part_c                         =  $incl_assessment->mpcPartC;
                $mpc_part_c->incl_assessment_id     =  $incl_assessment->id;
                $mpc_part_c->mpc_qn_c_1             =  $request->mpc_qn_c_1;
                $mpc_part_c->mpc_qn_c_2             =  $request->mpc_qn_c_2;
                $mpc_part_c->mpc_qn_c_3             =  $request->mpc_qn_c_3;
                $mpc_part_c->mpc_qn_c_4             =  $request->mpc_qn_c_4;
                $mpc_part_c->mpc_qn_c_5             =  $request->mpc_qn_c_5;
                $mpc_part_c->mpc_qn_c_6             =  $request->mpc_qn_c_6;
                $mpc_part_c->mpc_qn_c_7_remark      =  $request->mpc_qn_c_7_remark;
                $mpc_part_c->save();

                $mpc_part_d                       =  $incl_assessment->mpcPartD;
                $mpc_part_d->incl_assessment_id   =  $incl_assessment->id;
                $mpc_part_d->mpc_qn_d_1           =  $request->mpc_qn_d_1;
                $mpc_part_d->mpc_qn_d_2           =  $request->mpc_qn_d_2;
                $mpc_part_d->save();


                $mpc_part_e                         =  $incl_assessment->mpcPartE;
                $mpc_part_e->incl_assessment_id     =  $incl_assessment->id;
                $mpc_part_e->mpc_qn_e_1             =  $request->mpc_qn_e_1;
                $mpc_part_e->mpc_qn_e_2             =  $request->mpc_qn_e_2;
                $mpc_part_e->mpc_qn_e_3             =  $request->mpc_qn_e_3;
                $mpc_part_e->mpc_qn_e_4             =  $request->mpc_qn_e_4;
                $mpc_part_e->mpc_qn_e_5             =  $request->mpc_qn_e_5;
                $mpc_part_e->mpc_qn_e_6             =  $request->mpc_qn_e_6;
                $mpc_part_e->mpc_qn_e_7             =  $request->mpc_qn_e_7;
                $mpc_part_e->mpc_qn_e_8_remark      =  $request->mpc_qn_e_8_remark;
                $mpc_part_e->save();


                $mpc_part_f                       =  $incl_assessment->mpcPartF;
                $mpc_part_f->incl_assessment_id   =  $incl_assessment->id;
                $mpc_part_f->mpc_qn_f_1           =  $request->mpc_qn_f_1;
                $mpc_part_f->mpc_qn_f_2_remark    =  $request->mpc_qn_f_2_remark;
                $mpc_part_f->mpc_qn_f_3           =  $request->mpc_qn_f_3;
                $mpc_part_f->mpc_qn_f_4_remark    =  $request->mpc_qn_f_4_remark;
                $mpc_part_f->mpc_qn_f_5           =  $request->mpc_qn_f_5;
                $mpc_part_f->mpc_qn_f_6           =  $request->mpc_qn_f_6;
                $mpc_part_f->mpc_qn_f_7_remark    =  $request->mpc_qn_f_7_remark;
                $mpc_part_f->save();

                $mpc_perf_area                            =  $incl_assessment->mpcPerformanceArea;
                $mpc_perf_area->incl_assessment_id        =  $incl_assessment->id;
                $mpc_perf_area->mpc_perf_area_1           =  serialize($request->mpc_qn_perf_area_1);
                $mpc_perf_area->mpc_perf_area_2           =  serialize($request->mpc_qn_perf_area_2);
                $mpc_perf_area->mpc_perf_area_3           =  serialize($request->mpc_qn_perf_area_3);
                $mpc_perf_area->mpc_perf_area_4           =  serialize($request->mpc_qn_perf_area_4) ;
                $mpc_perf_area->mpc_perf_area_5           =  serialize($request->mpc_qn_perf_area_5) ;
                $mpc_perf_area->mpc_perf_area_6           =  serialize($request->mpc_qn_perf_area_6);
                $mpc_perf_area->save();


                $mpc_context                           =  $incl_assessment->mpcContext;
                $mpc_context->incl_assessment_id       =  $incl_assessment->id;
                $mpc_context->mpc_context_1            =  $request->mpc_context_1;
                $mpc_context->mpc_context_2            =  $request->mpc_context_2;
                $mpc_context->mpc_context_3_remark     =  $request->mpc_context_3_remark;
                $mpc_context->mpc_context_4            =  $request->mpc_context_4;
                $mpc_context->mpc_context_5            =  serialize($request->mpc_context_5);
                $mpc_context->mpc_context_5_remark     =  $request->mpc_context_5_remark;
                $mpc_context->mpc_context_6            =  $request->mpc_context_6;
                $mpc_context->mpc_context_6_remark     =  $request->mpc_context_6_remark;
                $mpc_context->mpc_context_7            =  $request->mpc_context_7;
                $mpc_context->mpc_context_8            =  $request->mpc_context_8;
                $mpc_context->mpc_context_9            =  $request->mpc_context_9;
                $mpc_context->mpc_context_9_remark     =  $request->mpc_context_9_remark;
                $mpc_context->mpc_context_10           =  $request->mpc_context_10;
                $mpc_context->mpc_context_11           =  $request->mpc_context_11;
                $mpc_context->mpc_context_12           =  $request->mpc_context_12;
                $mpc_context->mpc_context_13           =  $request->mpc_context_13;
                $mpc_context->mpc_context_14           =  $request->mpc_context_14;
                $mpc_context->mpc_context_15_remark    =  $request->mpc_context_15_remark;
                $mpc_context->mpc_context_16           =  $request->mpc_context_16;
                $mpc_context->mpc_context_16_remark    =  $request->mpc_context_16_remark;
                $mpc_context->save();

                $mpc_swot                        =  $incl_assessment->mpcSwot;
                $mpc_swot->incl_assessment_id    =  $incl_assessment->id;
                $mpc_swot->mpc_swot_1_remark     =  $request->mpc_qn_swot_1_remark;
                $mpc_swot->mpc_swot_2_remark     =  $request->mpc_qn_swot_2_remark;
                $mpc_swot->mpc_swot_3_remark     =  $request->mpc_qn_swot_3_remark;
                $mpc_swot->mpc_swot_4_remark     =  $request->mpc_qn_swot_4_remark;
                $mpc_swot->mpc_swot_5_remark     =  $request->mpc_qn_swot_5_remark;
                $mpc_swot->mpc_swot_6_remark     =  $request->mpc_qn_swot_6_remark;
                $mpc_swot->mpc_swot_7_remark     =  $request->mpc_qn_swot_7_remark;
                $mpc_swot->save();


                $mpc_short_rehab                               =  $incl_assessment->mpcShortRehab;
                $mpc_short_rehab->incl_assessment_id           =  $incl_assessment->id;
                $mpc_short_rehab->mpc_short_rehab_1_remark     =  $request->mpc_qn_short_rehab_1_remark;
                $mpc_short_rehab->mpc_short_rehab_2_remark     =  $request->mpc_qn_short_rehab_2_remark;
                $mpc_short_rehab->mpc_short_rehab_3_remark     =  $request->mpc_qn_short_rehab_3_remark;
                $mpc_short_rehab->mpc_short_rehab_4_remark     =  $request->mpc_qn_short_rehab_4_remark;
                $mpc_short_rehab->mpc_short_rehab_5_remark     =  $request->mpc_qn_short_rehab_5_remark;
                $mpc_short_rehab->mpc_short_rehab_6_remark     =  $request->mpc_qn_short_rehab_6_remark;
                $mpc_short_rehab->mpc_short_rehab_7_remark     =  $request->mpc_qn_short_rehab_7_remark;
                $mpc_short_rehab->save();



                $mpc_long_rehab                              =  $incl_assessment->mpcLongRehab;
                $mpc_long_rehab->incl_assessment_id          =  $incl_assessment->id;
                $mpc_long_rehab->mpc_long_rehab_1_remark     =  $request->mpc_qn_long_rehab_1_remark;
                $mpc_long_rehab->mpc_long_rehab_2_remark     =  $request->mpc_qn_long_rehab_2_remark;
                $mpc_long_rehab->mpc_long_rehab_3_remark     =  $request->mpc_qn_long_rehab_3_remark;
                $mpc_long_rehab->mpc_long_rehab_4_remark     =  $request->mpc_qn_long_rehab_4_remark;
                $mpc_long_rehab->mpc_long_rehab_5_remark     =  $request->mpc_qn_long_rehab_5_remark;
                $mpc_long_rehab->mpc_long_rehab_6_remark     =  $request->mpc_qn_long_rehab_6_remark;
                $mpc_long_rehab->mpc_long_rehab_7_remark     =  $request->mpc_qn_long_rehab_7_remark;
                $mpc_long_rehab->mpc_long_rehab_8_remark     =  $request->mpc_qn_long_rehab_8_remark;
                $mpc_long_rehab->mpc_long_rehab_9_remark     =  $request->mpc_qn_long_rehab_9_remark;
                $mpc_long_rehab->save();

                
                $lower_limb_row_1   = array( 'rom_l_hip_0_1'   => $request->rom_l_hip_0_1,     'rom_l_hip_0_2'   => $request->rom_l_hip_0_2,   'rom_l_hip_0_3'    => $request->rom_l_hip_0_3,  'rom_r_hip_0_1'   => $request->rom_r_hip_0_1,    'rom_r_hip_0_2'    => $request->rom_r_hip_0_2,   'rom_r_hip_0_3'   => $request->rom_r_hip_0_3,
                                             'ms_l_hip_0_1'    => $request->ms_l_hip_0_1,      'ms_l_hip_0_2'    => $request->ms_l_hip_0_2,    'ms_l_hip_0_3'     => $request->ms_l_hip_0_3,   'ms_r_hip_0_1'    => $request->ms_r_hip_0_1,     'ms_r_hip_0_2'     => $request->ms_r_hip_0_2,    'ms_r_hip_0_3'    => $request->ms_r_hip_0_3   );
                $lower_limb_row_2   = array( 'rom_l_hip_1_1'   => $request->rom_l_hip_1_1,     'rom_l_hip_1_2'   => $request->rom_l_hip_1_2,   'rom_l_hip_1_3'    => $request->rom_l_hip_1_3,  'rom_r_hip_1_1'   => $request->rom_r_hip_1_1,    'rom_r_hip_1_2'    => $request->rom_r_hip_1_2,   'rom_r_hip_1_3'   => $request->rom_r_hip_1_3,
                                             'ms_l_hip_1_1'    => $request->ms_l_hip_1_1,      'ms_l_hip_1_2'    => $request->ms_l_hip_1_2,    'ms_l_hip_1_3'     => $request->ms_l_hip_1_3,   'ms_r_hip_1_1'    => $request->ms_r_hip_1_1,     'ms_r_hip_1_2'     => $request->ms_r_hip_1_2,    'ms_r_hip_1_3'    => $request->ms_r_hip_1_3   );
                $lower_limb_row_3   = array( 'rom_l_hip_2_1'   => $request->rom_l_hip_2_1,     'rom_l_hip_2_2'   => $request->rom_l_hip_2_2,   'rom_l_hip_2_3'    => $request->rom_l_hip_2_3,  'rom_r_hip_2_1'   => $request->rom_r_hip_2_1,    'rom_r_hip_2_2'    => $request->rom_r_hip_2_2,   'rom_r_hip_2_3'   => $request->rom_r_hip_2_3,
                                             'ms_l_hip_2_1'    => $request->ms_l_hip_2_1,      'ms_l_hip_2_2'    => $request->ms_l_hip_2_2,    'ms_l_hip_2_3'     => $request->ms_l_hip_2_3,   'ms_r_hip_2_1'    => $request->ms_r_hip_2_1,     'ms_r_hip_2_2'     => $request->ms_r_hip_2_2,    'ms_r_hip_2_3'    => $request->ms_r_hip_2_3   );
                $lower_limb_row_4   = array( 'rom_l_hip_3_1'   => $request->rom_l_hip_3_1,     'rom_l_hip_3_2'   => $request->rom_l_hip_3_2,   'rom_l_hip_3_3'    => $request->rom_l_hip_3_3,  'rom_r_hip_3_1'   => $request->rom_r_hip_3_1,    'rom_r_hip_3_2'    => $request->rom_r_hip_3_2,   'rom_r_hip_3_3'   => $request->rom_r_hip_3_3,
                                             'ms_l_hip_3_1'    => $request->ms_l_hip_3_1,      'ms_l_hip_3_2'    => $request->ms_l_hip_3_2,    'ms_l_hip_3_3'     => $request->ms_l_hip_3_3,   'ms_r_hip_3_1'    => $request->ms_r_hip_3_1,     'ms_r_hip_3_2'     => $request->ms_r_hip_3_2,    'ms_r_hip_3_3'    => $request->ms_r_hip_3_3   );
                $lower_limb_row_5   = array( 'rom_l_hip_4_1'   => $request->rom_l_hip_4_1,     'rom_l_hip_4_2'   => $request->rom_l_hip_4_2,   'rom_l_hip_4_3'    => $request->rom_l_hip_4_3,  'rom_r_hip_4_1'   => $request->rom_r_hip_4_1,    'rom_r_hip_4_2'    => $request->rom_r_hip_4_2,   'rom_r_hip_4_3'   => $request->rom_r_hip_4_3,
                                             'ms_l_hip_4_1'    => $request->ms_l_hip_4_1,      'ms_l_hip_4_2'    => $request->ms_l_hip_4_2,    'ms_l_hip_4_3'     => $request->ms_l_hip_4_3,   'ms_r_hip_4_1'    => $request->ms_r_hip_4_1,     'ms_r_hip_4_2'     => $request->ms_r_hip_4_2,    'ms_r_hip_4_3'    => $request->ms_r_hip_4_3   );
                $lower_limb_row_6   = array( 'rom_l_hip_5_1'   => $request->rom_l_hip_5_1,     'rom_l_hip_5_2'   => $request->rom_l_hip_5_2,   'rom_l_hip_5_3'    => $request->rom_l_hip_5_3,  'rom_r_hip_5_1'   => $request->rom_r_hip_5_1,    'rom_r_hip_5_2'    => $request->rom_r_hip_5_2,   'rom_r_hip_5_3'   => $request->rom_r_hip_5_3,
                                             'ms_l_hip_5_1'    => $request->ms_l_hip_5_1,      'ms_l_hip_5_2'    => $request->ms_l_hip_5_2,    'ms_l_hip_5_3'     => $request->ms_l_hip_5_3,   'ms_r_hip_5_1'    => $request->ms_r_hip_5_1,     'ms_r_hip_5_2'     => $request->ms_r_hip_5_2,    'ms_r_hip_5_3'    => $request->ms_r_hip_5_3 );
                $lower_limb_row_7   = array( 'rom_l_knee_0_1'  => $request->rom_l_knee_0_1,    'rom_l_knee_0_2'  => $request->rom_l_knee_0_2,  'rom_l_knee_0_3'   => $request->rom_l_knee_0_3, 'rom_r_knee_0_1'  => $request->rom_r_knee_0_1,   'rom_r_knee_0_2'   => $request->rom_r_knee_0_2,  'rom_r_knee_0_3'  => $request->rom_r_knee_0_3,
                                             'ms_l_knee_0_1'   => $request->ms_l_knee_0_1,     'ms_l_knee_0_2'   => $request->ms_l_knee_0_2,   'ms_l_knee_0_3'    => $request->ms_l_knee_0_3,  'ms_r_knee_0_1'   => $request->ms_r_knee_0_1,    'ms_r_knee_0_2'    => $request->ms_r_knee_0_2,   'ms_r_knee_0_3'   => $request->ms_r_knee_0_3 );
                $lower_limb_row_8   = array( 'rom_l_knee_1_1'  => $request->rom_l_knee_1_1,    'rom_l_knee_1_2'  => $request->rom_l_knee_1_2,  'rom_l_knee_1_3'   => $request->rom_l_knee_1_3, 'rom_r_knee_1_1'  => $request->rom_r_knee_1_1,   'rom_r_knee_1_2'   => $request->rom_r_knee_1_2,  'rom_r_knee_1_3'  => $request->rom_r_knee_1_3,
                                             'ms_l_knee_1_1'   => $request->ms_l_knee_1_1,     'ms_l_knee_1_2'   => $request->ms_l_knee_1_2,   'ms_l_knee_1_3'    => $request->ms_l_knee_1_3,  'ms_r_knee_1_1'   => $request->ms_r_knee_1_1,    'ms_r_knee_1_2'    => $request->ms_r_knee_1_2,   'ms_r_knee_1_3'   => $request->ms_r_knee_1_3 );
                $lower_limb_row_9   = array( 'rom_l_foot_0_1'  => $request->rom_l_foot_0_1,    'rom_l_foot_0_2'  => $request->rom_l_foot_0_2,  'rom_l_foot_0_3'   => $request->rom_l_foot_0_3, 'rom_r_foot_0_1'  => $request->rom_r_foot_0_1,   'rom_r_foot_0_2'   => $request->rom_r_foot_0_2,  'rom_r_foot_0_3'  => $request->rom_r_foot_0_3,
                                             'ms_l_foot_0_1'   => $request->ms_l_foot_0_1,     'ms_l_foot_0_2'   => $request->ms_l_foot_0_2,   'ms_l_foot_0_3'    => $request->ms_l_foot_0_3,  'ms_r_foot_0_1'   => $request->ms_r_foot_0_1,    'ms_r_foot_0_2'    => $request->ms_r_foot_0_2,   'ms_r_foot_0_3'   => $request->ms_r_foot_0_3 );
                $lower_limb_row_10 = array( 'rom_l_foot_1_1'   => $request->rom_l_foot_1_1,    'rom_l_foot_1_2'  => $request->rom_l_foot_1_2,  'rom_l_foot_1_3'   => $request->rom_l_foot_1_3, 'rom_r_foot_1_1'  => $request->rom_r_foot_1_1,   'rom_r_foot_1_2'   => $request->rom_r_foot_1_2,  'rom_r_foot_1_3'  => $request->rom_r_foot_1_3,
                                             'ms_l_foot_1_1'   => $request->ms_l_foot_1_1,     'ms_l_foot_1_2'   => $request->ms_l_foot_1_2,   'ms_l_foot_1_3'    => $request->ms_l_foot_1_3,  'ms_r_foot_1_1'   => $request->ms_r_foot_1_1,    'ms_r_foot_1_2'    => $request->ms_r_foot_1_2,   'ms_r_foot_1_3'   => $request->ms_r_foot_1_3 );
                $lower_limb_row_11 = array( 'rom_l_foot_2_1'   => $request->rom_l_foot_2_1,    'rom_l_foot_2_2'  => $request->rom_l_foot_2_2,  'rom_l_foot_2_3'   => $request->rom_l_foot_2_3, 'rom_r_foot_2_1'  => $request->rom_r_foot_2_1,   'rom_r_foot_2_2'   => $request->rom_r_foot_2_2,  'rom_r_foot_2_3'  => $request->rom_r_foot_2_3,
                                             'ms_l_foot_2_1'   => $request->ms_l_foot_2_1,     'ms_l_foot_2_2'   => $request->ms_l_foot_2_2,   'ms_l_foot_2_3'    => $request->ms_l_foot_2_3,  'ms_r_foot_2_1'   => $request->ms_r_foot_2_1,    'ms_r_foot_2_2'    => $request->ms_r_foot_2_2,   'ms_r_foot_2_3'   => $request->ms_r_foot_2_3 );
                $lower_limb_row_12 = array( 'rom_l_foot_3_1'   => $request->rom_l_foot_3_1,    'rom_l_foot_3_2'  => $request->rom_l_foot_3_2,  'rom_l_foot_3_3'   => $request->rom_l_foot_3_3, 'rom_r_foot_3_1'  => $request->rom_r_foot_3_1,   'rom_r_foot_3_2'   => $request->rom_r_foot_3_2,  'rom_r_foot_3_3'  => $request->rom_r_foot_3_3,
                                             'ms_l_foot_3_1'   => $request->ms_l_foot_3_1,     'ms_l_foot_3_2'   => $request->ms_l_foot_3_2,   'ms_l_foot_3_3'    => $request->ms_l_foot_3_3,  'ms_r_foot_3_1'   => $request->ms_r_foot_3_1,    'ms_r_foot_3_2'    => $request->ms_r_foot_3_2,   'ms_r_foot_3_3'   => $request->ms_r_foot_3_3 );
                $lower_limb_row_13 = array( 'rom_l_trunk_0_1'  => $request->rom_l_foot_0_1,    'rom_l_trunk_0_2' => $request->rom_l_trunk_0_2, 'rom_l_trunk_0_3'  => $request->rom_l_trunk_0_3,'rom_r_trunk_0_1' => $request->rom_r_trunk_0_1,  'rom_r_trunk_0_2'  => $request->rom_r_trunk_0_2, 'rom_r_trunk_0_3' => $request->rom_r_trunk_0_3,
                                             'ms_l_trunk_0_1'  => $request->ms_l_trunk_0_1,    'ms_l_trunk_0_2'  => $request->ms_l_trunk_0_2,  'ms_l_trunk_0_3'   => $request->ms_l_trunk_0_3, 'ms_r_trunk_0_1'  => $request->ms_r_trunk_0_1,   'ms_r_trunk_0_2'   => $request->ms_r_trunk_0_2,  'ms_r_trunk_0_3'  => $request->ms_r_trunk_0_3 );
                $lower_limb_row_14 = array( 'rom_l_trunk_1_1'  => $request->rom_l_trunk_1_1,   'rom_l_trunk_1_2' => $request->rom_l_trunk_1_2, 'rom_l_trunk_1_3'  => $request->rom_l_trunk_1_3,'rom_r_trunk_1_1' => $request->rom_r_trunk_1_1,  'rom_r_trunk_1_2'  => $request->rom_r_trunk_1_2, 'rom_r_trunk_1_3' => $request->rom_r_trunk_1_3,
                                             'ms_l_trunk_1_1'  => $request->ms_l_trunk_1_1,    'ms_l_trunk_1_2'  => $request->ms_l_trunk_1_2,  'ms_l_trunk_1_3'   => $request->ms_l_trunk_1_3, 'ms_r_trunk_1_1'  => $request->ms_r_trunk_1_1,   'ms_r_trunk_1_2'   => $request->ms_r_trunk_1_2,  'ms_r_trunk_1_3'  => $request->ms_r_trunk_1_3 );

                 $mpcLowerLimb                           = $incl_assessment->mpcPartARomLower;
                 $mpcLowerLimb->incl_assessment_id       = $incl_assessment->id;
                 $mpcLowerLimb->lower_limb_row_1         = serialize($lower_limb_row_1);
                 $mpcLowerLimb->lower_limb_row_2         = serialize($lower_limb_row_2);
                 $mpcLowerLimb->lower_limb_row_3         = serialize($lower_limb_row_3);
                 $mpcLowerLimb->lower_limb_row_4         = serialize($lower_limb_row_4);
                 $mpcLowerLimb->lower_limb_row_5         = serialize($lower_limb_row_5);
                 $mpcLowerLimb->lower_limb_row_6         = serialize($lower_limb_row_6);
                 $mpcLowerLimb->lower_limb_row_7         = serialize($lower_limb_row_7);
                 $mpcLowerLimb->lower_limb_row_8         = serialize($lower_limb_row_8);
                 $mpcLowerLimb->lower_limb_row_9         = serialize($lower_limb_row_9);
                 $mpcLowerLimb->lower_limb_row_10        = serialize($lower_limb_row_10);
                 $mpcLowerLimb->lower_limb_row_11        = serialize($lower_limb_row_11);
                 $mpcLowerLimb->lower_limb_row_12        = serialize($lower_limb_row_12);
                 $mpcLowerLimb->lower_limb_row_13        = serialize($lower_limb_row_13);
                 $mpcLowerLimb->lower_limb_row_14        = serialize($lower_limb_row_14);
                 $mpcLowerLimb->save();
                    
                    
                 $upper_limb_row_1   = array( 'rom_l_shoulder_and_arm_0_1'  => $request->rom_l_shoulder_and_arm_0_1,  'rom_l_shoulder_and_arm_0_2' => $request->rom_l_shoulder_and_arm_0_2, 'rom_l_shoulder_and_arm_0_3' => $request->rom_l_shoulder_and_arm_0_3,  'rom_r_shoulder_and_arm_0_1' => $request->rom_r_shoulder_and_arm_0_1,   'rom_r_shoulder_and_arm_0_2'  => $request->rom_r_shoulder_and_arm_0_2,   'rom_r_shoulder_and_arm_0_3' => $request->rom_r_shoulder_and_arm_0_3,
                                         'ms_l_shoulder_and_arm_0_1'        => $request->ms_l_shoulder_and_arm_0_1,   'ms_l_shoulder_and_arm_0_2'  => $request->ms_l_shoulder_and_arm_0_2,  'ms_l_shoulder_and_arm_0_3'  => $request->ms_l_shoulder_and_arm_0_3,   'ms_r_shoulder_and_arm_0_1'  => $request->ms_r_shoulder_and_arm_0_1,    'ms_r_shoulder_and_arm_0_2'   => $request->ms_r_shoulder_and_arm_0_2,    'ms_r_shoulder_and_arm_0_3'  => $request->ms_r_shoulder_and_arm_0_3 );
                 $upper_limb_row_2   = array( 'rom_l_shoulder_and_arm_1_1'  => $request->rom_l_shoulder_and_arm_1_1,  'rom_l_shoulder_and_arm_1_2' => $request->rom_l_shoulder_and_arm_1_2, 'rom_l_shoulder_and_arm_1_3' => $request->rom_l_shoulder_and_arm_1_3,  'rom_r_shoulder_and_arm_1_1' => $request->rom_r_shoulder_and_arm_1_1,   'rom_r_shoulder_and_arm_1_2'  => $request->rom_r_shoulder_and_arm_1_2,   'rom_r_shoulder_and_arm_1_3' => $request->rom_r_shoulder_and_arm_1_3,
                                         'ms_l_shoulder_and_arm_1_1'        => $request->ms_l_shoulder_and_arm_1_1,   'ms_l_shoulder_and_arm_1_2'  => $request->ms_l_shoulder_and_arm_1_2,  'ms_l_shoulder_and_arm_1_3'  => $request->ms_l_shoulder_and_arm_1_3,   'ms_r_shoulder_and_arm_1_1'  => $request->ms_r_shoulder_and_arm_1_1,    'ms_r_shoulder_and_arm_1_2'   => $request->ms_r_shoulder_and_arm_1_2,    'ms_r_shoulder_and_arm_1_3'  => $request->ms_r_shoulder_and_arm_1_3 );
                 $upper_limb_row_3   = array( 'rom_l_shoulder_and_arm_2_1'  => $request->rom_l_shoulder_and_arm_2_1,  'rom_l_shoulder_and_arm_2_2' => $request->rom_l_shoulder_and_arm_2_2, 'rom_l_shoulder_and_arm_2_3' => $request->rom_l_shoulder_and_arm_2_3,  'rom_r_shoulder_and_arm_2_1' => $request->rom_r_shoulder_and_arm_2_1,   'rom_r_shoulder_and_arm_2_2'  => $request->rom_r_shoulder_and_arm_2_2,   'rom_r_shoulder_and_arm_2_3' => $request->rom_r_shoulder_and_arm_2_3,
                                         'ms_l_shoulder_and_arm_2_1'        => $request->ms_l_shoulder_and_arm_2_1,   'ms_l_shoulder_and_arm_2_2'  => $request->ms_l_shoulder_and_arm_2_2,  'ms_l_shoulder_and_arm_2_3'  => $request->ms_l_shoulder_and_arm_2_3,   'ms_r_shoulder_and_arm_2_1'  => $request->ms_r_shoulder_and_arm_2_1,    'ms_r_shoulder_and_arm_2_2'   => $request->ms_r_shoulder_and_arm_2_2,    'ms_r_shoulder_and_arm_2_3'  => $request->ms_r_shoulder_and_arm_2_3 );
                 $upper_limb_row_4   = array( 'rom_l_shoulder_and_arm_3_1'  => $request->rom_l_shoulder_and_arm_3_1,  'rom_l_shoulder_and_arm_3_2' => $request->rom_l_shoulder_and_arm_3_2, 'rom_l_shoulder_and_arm_3_3' => $request->rom_l_shoulder_and_arm_3_3,  'rom_r_shoulder_and_arm_3_1' => $request->rom_r_shoulder_and_arm_3_1,   'rom_r_shoulder_and_arm_3_2'  => $request->rom_r_shoulder_and_arm_3_2,   'rom_r_shoulder_and_arm_3_3' => $request->rom_r_shoulder_and_arm_3_3,
                                         'ms_l_shoulder_and_arm_3_1'        => $request->ms_l_shoulder_and_arm_3_1,   'ms_l_shoulder_and_arm_3_2'  => $request->ms_l_shoulder_and_arm_3_2,  'ms_l_shoulder_and_arm_3_3'  => $request->ms_l_shoulder_and_arm_3_3,   'ms_r_shoulder_and_arm_3_1'  => $request->ms_r_shoulder_and_arm_3_1,    'ms_r_shoulder_and_arm_3_2'   => $request->ms_r_shoulder_and_arm_3_2,    'ms_r_shoulder_and_arm_3_3'  => $request->ms_r_shoulder_and_arm_3_3 );
                 $upper_limb_row_5   = array( 'rom_l_elbow_forearm_0_1'     => $request->rom_l_elbow_forearm_0_1,     'rom_l_elbow_forearm_0_2'    => $request->rom_l_elbow_forearm_0_2,    'rom_l_elbow_forearm_0_3'    => $request->rom_l_elbow_forearm_0_3,     'rom_r_elbow_forearm_0_1'    => $request->rom_r_elbow_forearm_0_1,      'rom_r_elbow_forearm_0_2'     => $request->rom_r_elbow_forearm_0_2,      'rom_r_elbow_forearm_0_3'    => $request->rom_r_elbow_forearm_0_3,
                                         'ms_l_elbow_forearm_0_1'           => $request->ms_l_elbow_forearm_0_1,      'ms_l_elbow_forearm_0_2'     => $request->ms_l_elbow_forearm_0_2,     'ms_l_elbow_forearm_0_3'     => $request->ms_l_elbow_forearm_0_3,      'ms_r_elbow_forearm_0_1'     => $request->ms_r_elbow_forearm_0_1,       'ms_r_elbow_forearm_0_2'      => $request->ms_r_elbow_forearm_0_2,       'ms_r_elbow_forearm_0_3'     => $request->ms_r_elbow_forearm_0_3 );
                 $upper_limb_row_6   = array( 'rom_l_elbow_forearm_1_1'     => $request->rom_l_elbow_forearm_1_1,     'rom_l_elbow_forearm_1_2'    => $request->rom_l_elbow_forearm_1_2,    'rom_l_elbow_forearm_1_3'    => $request->rom_l_elbow_forearm_1_3,     'rom_r_elbow_forearm_1_1'    => $request->rom_r_elbow_forearm_1_1,      'rom_r_elbow_forearm_1_2'     => $request->rom_r_elbow_forearm_1_2,      'rom_r_elbow_forearm_1_3'    => $request->rom_r_elbow_forearm_1_3,
                                         'ms_l_elbow_forearm_1_1'           => $request->ms_l_elbow_forearm_1_1,      'ms_l_elbow_forearm_1_2'     => $request->ms_l_elbow_forearm_1_2,     'ms_l_elbow_forearm_1_3'     => $request->ms_l_elbow_forearm_1_3,      'ms_r_elbow_forearm_1_1'     => $request->ms_r_elbow_forearm_1_1,       'ms_r_elbow_forearm_1_2'      => $request->ms_r_elbow_forearm_1_2,       'ms_r_elbow_forearm_1_3'     => $request->ms_r_elbow_forearm_1_3 );
                 $upper_limb_row_7   = array( 'rom_l_elbow_forearm_2_1'     => $request->rom_l_elbow_forearm_2_1,     'rom_l_elbow_forearm_2_2'    => $request->rom_l_elbow_forearm_2_2,    'rom_l_elbow_forearm_2_3'    => $request->rom_l_elbow_forearm_2_3,     'rom_r_elbow_forearm_2_1'    => $request->rom_r_elbow_forearm_2_1,      'rom_r_elbow_forearm_2_2'     => $request->rom_r_elbow_forearm_2_2,      'rom_r_elbow_forearm_2_3'    => $request->rom_r_elbow_forearm_2_3,
                                         'ms_l_elbow_forearm_2_1'           => $request->ms_l_elbow_forearm_2_1,      'ms_l_elbow_forearm_2_2'     => $request->ms_l_elbow_forearm_2_2,     'ms_l_elbow_forearm_2_3'     => $request->ms_l_elbow_forearm_2_3,      'ms_r_elbow_forearm_2_1'     => $request->ms_r_elbow_forearm_2_1,       'ms_r_elbow_forearm_2_2'      => $request->ms_r_elbow_forearm_2_2,       'ms_r_elbow_forearm_2_3'     => $request->ms_r_elbow_forearm_2_3 );
                 $upper_limb_row_8   = array( 'rom_l_elbow_forearm_3_1'     => $request->rom_l_elbow_forearm_3_1,     'rom_l_elbow_forearm_3_2'    => $request->rom_l_elbow_forearm_3_2,    'rom_l_elbow_forearm_3_3'    => $request->rom_l_elbow_forearm_3_3,     'rom_r_elbow_forearm_3_1'    => $request->rom_r_elbow_forearm_3_1,      'rom_r_elbow_forearm_3_2'     => $request->rom_r_elbow_forearm_3_2,      'rom_r_elbow_forearm_3_3'    => $request->rom_r_elbow_forearm_3_3,
                                         'ms_l_elbow_forearm_3_1'           => $request->ms_l_elbow_forearm_3_1,      'ms_l_elbow_forearm_3_2'     => $request->ms_l_elbow_forearm_3_2,     'ms_l_elbow_forearm_3_3'     => $request->ms_l_elbow_forearm_3_3,      'ms_r_elbow_forearm_3_1'     => $request->ms_r_elbow_forearm_3_1,       'ms_r_elbow_forearm_3_2'      => $request->ms_r_elbow_forearm_3_2,       'ms_r_elbow_forearm_3_3'     => $request->ms_r_elbow_forearm_3_3 );
                 $upper_limb_row_9   = array( 'rom_l_wirst_0_1'             => $request->rom_l_wirst_0_1,             'rom_l_wirst_0_2'            => $request->rom_l_wirst_0_2,            'rom_l_wirst_0_3'            => $request->rom_l_wirst_0_3,             'rom_r_wirst_0_1'            => $request->rom_r_wirst_0_1,              'rom_r_wirst_0_2'             => $request->rom_r_wirst_0_2,              'rom_r_wirst_0_3'            => $request->rom_r_wirst_0_3,
                                         'ms_l_wirst_0_1'                   => $request->ms_l_wirst_0_1,              'ms_l_wirst_0_2'             => $request->ms_l_wirst_0_2,             'ms_l_wirst_0_3'             => $request->ms_l_wirst_0_3,              'ms_r_wirst_0_1'             => $request->ms_r_wirst_0_1,               'ms_r_wirst_0_2'              => $request->ms_r_wirst_0_2,               'ms_r_wirst_0_3'             => $request->ms_r_wirst_0_3 );
                 $upper_limb_row_10  = array( 'rom_l_wirst_1_1'             => $request->rom_l_wirst_1_1,             'rom_l_wirst_1_2'            => $request->rom_l_wirst_1_2,            'rom_l_wirst_1_3'            => $request->rom_l_wirst_1_3,             'rom_r_wirst_1_1'            => $request->rom_r_wirst_1_1,              'rom_r_wirst_1_2'             => $request->rom_r_wirst_1_2,              'rom_r_wirst_1_3'            => $request->rom_r_wirst_1_3,
                                         'ms_l_wirst_1_1'                   => $request->ms_l_wirst_1_1,              'ms_l_wirst_1_2'             => $request->ms_l_wirst_1_2,             'ms_l_wirst_1_3'             => $request->ms_l_wirst_1_3,              'ms_r_wirst_1_1'             => $request->ms_r_wirst_1_1,               'ms_r_wirst_1_2'              => $request->ms_r_wirst_1_2,               'ms_r_wirst_1_3'             => $request->ms_r_wirst_1_3 );
                 $upper_limb_row_11  = array( 'rom_l_hands_0_1'             => $request->rom_l_hands_0_1,             'rom_l_hands_0_2'            => $request->rom_l_hands_0_2,            'rom_l_hands_0_3'            => $request->rom_l_hands_0_3,             'rom_r_hands_0_1'            => $request->rom_r_hands_0_1,              'rom_r_hands_0_2'             => $request->rom_r_hands_0_2,              'rom_r_hands_0_3'            => $request->rom_r_hands_0_3,
                                         'ms_l_hands_0_1'                   => $request->ms_l_hands_0_1,              'ms_l_hands_0_2'             => $request->ms_l_hands_0_2,             'ms_l_hands_0_3'             => $request->ms_l_hands_0_3,              'ms_r_hands_0_1'             => $request->ms_r_hands_0_1,               'ms_r_hands_0_2'              => $request->ms_r_hands_0_2,               'ms_r_hands_0_3'             => $request->ms_r_hands_0_3 );
                 $upper_limb_row_12  = array( 'rom_l_hands_1_1'             => $request->rom_l_hands_1_1,             'rom_l_hands_1_2'            => $request->rom_l_hands_1_2,            'rom_l_hands_1_3'            => $request->rom_l_hands_1_3,             'rom_r_hands_1_1'            => $request->rom_r_hands_1_1,              'rom_r_hands_1_2'             => $request->rom_r_hands_1_2,              'rom_r_hands_1_3'            => $request->rom_r_hands_1_3,
                                         'ms_l_hands_1_1'                   => $request->ms_l_hands_1_1,              'ms_l_hands_1_2'             => $request->ms_l_hands_1_2,             'ms_l_hands_1_3'             => $request->ms_l_hands_1_3,              'ms_r_hands_1_1'             => $request->ms_r_hands_1_1,               'ms_r_hands_1_2'              => $request->ms_r_hands_1_2,               'ms_r_hands_1_3'             => $request->ms_r_hands_1_3 );

                 $mpcUpperLimb = $incl_assessment->mpcPartARomUpper;
                 $mpcUpperLimb->incl_assessment_id    =  $incl_assessment->id;
                 $mpcUpperLimb->upper_limb_row_1 = serialize($upper_limb_row_1);
                 $mpcUpperLimb->upper_limb_row_2 = serialize($upper_limb_row_2);
                 $mpcUpperLimb->upper_limb_row_3 = serialize($upper_limb_row_3);
                 $mpcUpperLimb->upper_limb_row_4 = serialize($upper_limb_row_4);
                 $mpcUpperLimb->upper_limb_row_5 = serialize($upper_limb_row_5);
                 $mpcUpperLimb->upper_limb_row_6 = serialize($upper_limb_row_6);
                 $mpcUpperLimb->upper_limb_row_7 = serialize($upper_limb_row_7);
                 $mpcUpperLimb->upper_limb_row_8 = serialize($upper_limb_row_8);
                 $mpcUpperLimb->upper_limb_row_9 = serialize($upper_limb_row_9);
                 $mpcUpperLimb->upper_limb_row_10 = serialize($upper_limb_row_10);
                 $mpcUpperLimb->upper_limb_row_11 = serialize($upper_limb_row_11);
                 $mpcUpperLimb->upper_limb_row_12 = serialize($upper_limb_row_12);
                 $mpcUpperLimb->save();
               
                       
                            
                        return response()->json([
                                                'success' => true,
                                                'action'  => 'update',
                                                'message' => "<div class='alert alert-success remove-alert'><strong>Success!</strong> Inclusion Assessment was updated successifully</div>"
                                               ], 200);

                     }else{
                            return response()->json([
                                                    'success' => true,
                                                    'message' => "<div class='alert alert-danger remove-alert'><strong>Error!</strong> Sorry, No such Inclusion Assessment in our system</div>"
                                                   ], 200);

                        }

                }catch (\Exception $ex) {

                        return Response::json(array(
                                                     'success' => false,
                                                     'id'      => $id,
                                                     'errors'  => $ex->getMessage()

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
