<?php

namespace App\Http\Controllers;

use App\BudgetActivity;
use App\Camp;
use App\CashProvision;
use App\Client;
use App\ClientReferral;
use App\Country;
use App\District;
use App\HomeAssessment;
use App\InventoryReceived;
use App\ItemsCategories;
use App\ItemsDisbursement;
use App\Region;
use App\VulnerabilityAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class BackupImportExportController extends Controller
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
    }
    public function showExport()
    {
        //
        return view('backups.exports.index');
    }
    public function postExport(Request $request)
    {
        //
        $this->validate($request, [
            'module' => 'required',
        ]);
        if ($request->module == 1) {
            $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $xml .= "<ApplicationData>";
            $xml .= "<Clients>";
            foreach (Client::all() as $client) {
                $xml .= "<Client>";
                $xml .= "<hai_reg_number><![CDATA[" . $client->hai_reg_number . "]]></hai_reg_number>";
                $xml .= "<client_number><![CDATA[" . $client->client_number . "]]></client_number>";
                $xml .= "<full_name><![CDATA[" . $client->full_name . "]]></full_name>";
                $xml .= "<sex><![CDATA[" . $client->sex . "]]></sex>";
                $xml .= "<birth_date><![CDATA[" . $client->birth_date . "]]></birth_date>";
                $xml .= "<age><![CDATA[" . $client->age . "]]></age>";
                $xml .= "<marital_status><![CDATA[" . $client->marital_status . "]]></marital_status>";
                $xml .= "<spouse_name><![CDATA[" . $client->spouse_name . "]]></spouse_name>";
                $xml .= "<care_giver><![CDATA[" . $client->care_giver . "]]></care_giver>";
                $xml .= "<child_care_giver><![CDATA[" . $client->child_care_giver . "]]></child_care_giver>";
                $xml .= "<Origin>";
                if (is_object($client->fromOrigin) && $client->fromOrigin != null) {
                    $origin = $client->fromOrigin;
                    $xml .= "<origin_name><![CDATA[" . $origin->origin_name . "]]></origin_name>";
                    $xml .= "<auth_status><![CDATA[" . $origin->auth_status . "]]></auth_status>";
                    $xml .= "<created_by><![CDATA[" . $origin->created_by . "]]></created_by>";
                    $xml .= "<updated_by><![CDATA[" . $origin->updated_by . "]]></updated_by>";
                    $xml .= "<auth_by><![CDATA[" . $origin->auth_by . "]]></auth_by>";
                }
                $xml .= "</Origin>";
                $xml .= "<Camp>";
                if (is_object($client->camp) && $client->camp != null) {
                    $camp = $client->camp;
                    $xml .= "<reg_no><![CDATA[" . $camp->reg_no . "]]></reg_no>";
                    $xml .= "<camp_name><![CDATA[" . $camp->camp_name . "]]></camp_name>";
                    $xml .= "<description><![CDATA[" . $camp->description . "]]></description>";
                    $xml .= "<address><![CDATA[" . $camp->address . "]]></address>";
                    $xml .= "<tel><![CDATA[" . $camp->tel . "]]></tel>";
                    $xml .= "<zone><![CDATA[" . $camp->zone . "]]></zone>";
                    $xml .= "<status><![CDATA[" . $camp->status . "]]></status>";
                    $xml .= "<auth_status><![CDATA[" . $camp->auth_status . "]]></auth_status>";
                    $xml .= "<created_by><![CDATA[" . $camp->created_by . "]]></created_by>";
                    $xml .= "<updated_by><![CDATA[" . $camp->updated_by . "]]></updated_by>";
                    $xml .= "<auth_by><![CDATA[" . $camp->auth_status . "]]></auth_by>";
                    $xml .= "<Region>";
                    $region = Region::find($camp->region_id);
                    if (count($region) > 0 && $region != null) {
                        $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                    }
                    $xml .= "</Region>";
                    $xml .= "<District>";
                    $district = District::find($camp->district_id);
                    if (count($district) > 0 && $district != null) {
                        $xml .= "<district_name><![CDATA[" . $district->district_name . "]]></district_name>";
                        $xml .= "<Region>";
                        $region = Region::find($district->region_id);
                        if (count($region) > 0 && $region != null) {
                            $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                        }
                        $xml .= "</Region>";
                    }
                    $xml .= "</District>";

                }
                $xml .= "</Camp>";
                $xml .= "<date_arrival><![CDATA[" . $client->date_arrival . "]]></date_arrival>";
                $xml .= "<present_address><![CDATA[" . $client->present_address . "]]></present_address>";
                $xml .= "<females_total><![CDATA[" . $client->females_total . "]]></females_total>";
                $xml .= "<males_total><![CDATA[" . $client->males_total . "]]></males_total>";
                $xml .= "<household_number><![CDATA[" . $client->household_number . "]]></household_number>";
                $xml .= "<ration_card_number><![CDATA[" . $client->ration_card_number . "]]></ration_card_number>";
                $xml .= "<assistance_received><![CDATA[" . $client->assistance_received . "]]></assistance_received>";
                $xml .= "<problem_specification><![CDATA[" . $client->problem_specification . "]]></problem_specification>";
                $xml .= "<status><![CDATA[" . $client->status . "]]></status>";
                $xml .= "<share_info><![CDATA[" . $client->share_info . "]]></share_info>";
                $xml .= "<hh_relation><![CDATA[" . $client->hh_relation . "]]></hh_relation>";
                $xml .= "<auth_status><![CDATA[" . $client->auth_status . "]]></auth_status>";
                $xml .= "<created_by><![CDATA[" . $client->created_by . "]]></created_by>";
                $xml .= "<updated_by><![CDATA[" . $client->updated_by . "]]></updated_by>";
                $xml .= "<auth_by><![CDATA[" . $client->auth_by . "]]></auth_by>";
                $xml .= "<auth_date><![CDATA[" . $client->auth_date . "]]></auth_date>";
                $xml .= "</Client>";
            }
            $xml .= "</Clients>";
            $xml .= "</ApplicationData>";

            File::put(storage_path() . '/SystemClients.xml', $xml);
            return Response::download(storage_path() . '/SystemClients.xml');
        }
        elseif ($request->module == 2) {
            $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $xml .= "<ApplicationData>";
            $xml .= "<VulnerabilityAssessments>";
            foreach (VulnerabilityAssessment::all() as $assessment) {
                $xml .= "<VulnerabilityAssessment>";
                $xml .= "<q1_1><![CDATA[" . $assessment->q1_1 . "]]></q1_1>";
                $xml .= "<q1_2><![CDATA[" . $assessment->q1_4 . "]]></q1_2>";
                $xml .= "<q1_3><![CDATA[" . $assessment->q1_3 . "]]></q1_3>";
                $xml .= "<q1_4><![CDATA[" . $assessment->q1_4 . "]]></q1_4>";
                $xml .= "<q1_5><![CDATA[" . $assessment->q1_5 . "]]></q1_5>";
                $xml .= "<comments><![CDATA[" . $assessment->comments . "]]></comments>";
                $xml .= "<created_by><![CDATA[" . $assessment->created_by . "]]></created_by>";
                if (is_object($assessment->client) && $assessment->client!= null) {
                    $client =$assessment->client;
                    $xml .= "<Client>";
                    $xml .= "<hai_reg_number><![CDATA[" . $client->hai_reg_number . "]]></hai_reg_number>";
                    $xml .= "<client_number><![CDATA[" . $client->client_number . "]]></client_number>";
                    $xml .= "<full_name><![CDATA[" . $client->full_name . "]]></full_name>";
                    $xml .= "<sex><![CDATA[" . $client->sex . "]]></sex>";
                    $xml .= "<birth_date><![CDATA[" . $client->birth_date . "]]></birth_date>";
                    $xml .= "<age><![CDATA[" . $client->age . "]]></age>";
                    $xml .= "<marital_status><![CDATA[" . $client->marital_status . "]]></marital_status>";
                    $xml .= "<spouse_name><![CDATA[" . $client->spouse_name . "]]></spouse_name>";
                    $xml .= "<care_giver><![CDATA[" . $client->care_giver . "]]></care_giver>";
                    $xml .= "<child_care_giver><![CDATA[" . $client->child_care_giver . "]]></child_care_giver>";
                    $xml .= "<Origin>";
                    if (is_object($client->fromOrigin) && $client->fromOrigin != null) {
                        $origin = $client->fromOrigin;
                        $xml .= "<origin_name><![CDATA[" . $origin->origin_name . "]]></origin_name>";
                        $xml .= "<auth_status><![CDATA[" . $origin->auth_status . "]]></auth_status>";
                        $xml .= "<created_by><![CDATA[" . $origin->created_by . "]]></created_by>";
                        $xml .= "<updated_by><![CDATA[" . $origin->updated_by . "]]></updated_by>";
                        $xml .= "<auth_by><![CDATA[" . $origin->auth_by . "]]></auth_by>";
                    }
                    $xml .= "</Origin>";
                    $xml .= "<Camp>";
                    if (is_object($client->camp) && $client->camp != null) {
                        $camp = $client->camp;
                        $xml .= "<reg_no><![CDATA[" . $camp->reg_no . "]]></reg_no>";
                        $xml .= "<camp_name><![CDATA[" . $camp->camp_name . "]]></camp_name>";
                        $xml .= "<description><![CDATA[" . $camp->description . "]]></description>";
                        $xml .= "<address><![CDATA[" . $camp->address . "]]></address>";
                        $xml .= "<tel><![CDATA[" . $camp->tel . "]]></tel>";
                        $xml .= "<zone><![CDATA[" . $camp->zone . "]]></zone>";
                        $xml .= "<status><![CDATA[" . $camp->status . "]]></status>";
                        $xml .= "<auth_status><![CDATA[" . $camp->auth_status . "]]></auth_status>";
                        $xml .= "<created_by><![CDATA[" . $camp->created_by . "]]></created_by>";
                        $xml .= "<updated_by><![CDATA[" . $camp->updated_by . "]]></updated_by>";
                        $xml .= "<auth_by><![CDATA[" . $camp->auth_status . "]]></auth_by>";
                        $xml .= "<Region>";
                        $region = Region::find($camp->region_id);
                        if (count($region) > 0 && $region != null) {
                            $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                        }
                        $xml .= "</Region>";
                        $xml .= "<District>";
                        $district = District::find($camp->district_id);
                        if (count($district) > 0 && $district != null) {
                            $xml .= "<district_name><![CDATA[" . $district->district_name . "]]></district_name>";
                            $xml .= "<Region>";
                            $region = Region::find($district->region_id);
                            if (count($region) > 0 && $region != null) {
                                $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                            }
                            $xml .= "</Region>";
                        }
                        $xml .= "</District>";

                    }
                    $xml .= "</Camp>";
                    $xml .= "<date_arrival><![CDATA[" . $client->date_arrival . "]]></date_arrival>";
                    $xml .= "<present_address><![CDATA[" . $client->present_address . "]]></present_address>";
                    $xml .= "<females_total><![CDATA[" . $client->females_total . "]]></females_total>";
                    $xml .= "<males_total><![CDATA[" . $client->males_total . "]]></males_total>";
                    $xml .= "<household_number><![CDATA[" . $client->household_number . "]]></household_number>";
                    $xml .= "<ration_card_number><![CDATA[" . $client->ration_card_number . "]]></ration_card_number>";
                    $xml .= "<assistance_received><![CDATA[" . $client->assistance_received . "]]></assistance_received>";
                    $xml .= "<problem_specification><![CDATA[" . $client->problem_specification . "]]></problem_specification>";
                    $xml .= "<status><![CDATA[" . $client->status . "]]></status>";
                    $xml .= "<share_info><![CDATA[" . $client->share_info . "]]></share_info>";
                    $xml .= "<hh_relation><![CDATA[" . $client->hh_relation . "]]></hh_relation>";
                    $xml .= "<auth_status><![CDATA[" . $client->auth_status . "]]></auth_status>";
                    $xml .= "<created_by><![CDATA[" . $client->created_by . "]]></created_by>";
                    $xml .= "<updated_by><![CDATA[" . $client->updated_by . "]]></updated_by>";
                    $xml .= "<auth_by><![CDATA[" . $client->auth_by . "]]></auth_by>";
                    $xml .= "<auth_date><![CDATA[" . $client->auth_date . "]]></auth_date>";
                    $xml .= "</Client>";
                }
                if (is_object($assessment->householdProfile) && $assessment->householdProfile!= null) {
                    $profile=$assessment->householdProfile;
                    $xml .= "<AssessmentHousholdProfile>";
                    $xml .= "<q2_1><![CDATA[" . $profile->q2_1 . "]]></q2_1>";
                    $xml .= "<q2_2><![CDATA[" . $profile->q2_2 . "]]></q2_2>";
                    $xml .= "<q2_3><![CDATA[" . $profile->q2_3 . "]]></q2_3>";
                    $xml .= "<q2_4><![CDATA[" . $profile->q2_4 . "]]></q2_4>";
                    $xml .= "<q2_5><![CDATA[" . $profile->q2_5 . "]]></q2_5>";
                    $xml .= "<q2_6><![CDATA[" . $profile->q2_6 . "]]></q2_6>";
                    $xml .= "<q2_7><![CDATA[" . $profile->q2_7 . "]]></q2_7>";
                    $xml .= "<q2_8><![CDATA[" . $profile->q2_8 . "]]></q2_8>";
                    $xml .= "<q2_9><![CDATA[" . $profile->q2_9 . "]]></q2_9>";
                    $xml .= "<q2_10><![CDATA[" . $profile->q2_10 . "]]></q2_10>";
                    $xml .= "<q2_11><![CDATA[" . $profile->q2_11 . "]]></q2_11>";
                    $xml .= "<q2_12><![CDATA[" . $profile->q2_12 . "]]></q2_12>";
                    $xml .= "<q2_13><![CDATA[" . $profile->q2_13 . "]]></q2_13>";
                    $xml .= "<q2_14><![CDATA[" . $profile->q2_14 . "]]></q2_14>";
                    $xml .= "</AssessmentHousholdProfile>";
                }
                if (is_object($assessment->economicSituation) && $assessment->economicSituation!= null) {
                    $economic=$assessment->economicSituation;
                    $xml .= "<AssessmentEconomicSituation>";
                    $xml .= "<q3_1><![CDATA[" . $economic->q3_1 . "]]></q3_1>";
                    $xml .= "<q3_2><![CDATA[" . $economic->q3_2 . "]]></q3_2>";
                    $xml .= "<q3_3><![CDATA[" . $economic->q3_3 . "]]></q3_3>";
                    $xml .= "<q3_4><![CDATA[" . $economic->q3_4 . "]]></q3_4>";
                    $xml .= "<q3_5><![CDATA[" . $economic->q3_5 . "]]></q3_5>";
                    $xml .= "<q3_6><![CDATA[" . $economic->q3_6 . "]]></q3_6>";
                    $xml .= "<q3_7><![CDATA[" . $economic->q3_7 . "]]></q3_7>";
                    $xml .= "<q3_8><![CDATA[" . $economic->q3_8 . "]]></q3_8>";
                    $xml .= "</AssessmentEconomicSituation>";
                }
                if (is_object($assessment->vulnerabilityType) && $assessment->vulnerabilityType!= null) {
                    $vulnerability=$assessment->vulnerabilityType;
                    $xml .= "<AssessmentVulnerabilityType>";
                    $xml .= "<q4_1><![CDATA[" . $vulnerability->q4_1 . "]]></q4_1>";
                    $xml .= "<q4_2><![CDATA[" . $vulnerability->q4_2 . "]]></q4_2>";
                    $xml .= "<q4_3><![CDATA[" . $vulnerability->q4_3 . "]]></q4_3>";
                    $xml .= "<q4_4><![CDATA[" . $vulnerability->q4_4 . "]]></q4_4>";
                    $xml .= "<q4_5><![CDATA[" . $vulnerability->q4_5 . "]]></q4_5>";
                    $xml .= "<q4_6><![CDATA[" . $vulnerability->q4_6 . "]]></q4_6>";
                    $xml .= "<q4_7><![CDATA[" . $vulnerability->q4_7 . "]]></q4_7>";
                    $xml .= "</AssessmentVulnerabilityType>";
                }
                if (is_object($assessment->impairmentType) && $assessment->impairmentType!= null) {
                    $impairment=$assessment->impairmentType;
                    $xml .= "<AssessmentImpairmentType>";
                    $xml .= "<q5_1><![CDATA[" . $impairment->q5_1 . "]]></q5_1>";
                    $xml .= "<q5_2><![CDATA[" . $impairment->q5_2 . "]]></q5_2>";
                    $xml .= "<q5_3><![CDATA[" . $impairment->q5_3 . "]]></q5_3>";
                    $xml .= "<q5_4><![CDATA[" . $impairment->q5_4 . "]]></q5_4>";
                    $xml .= "<q5_5><![CDATA[" . $impairment->q5_5 . "]]></q5_5>";
                    $xml .= "<q5_6><![CDATA[" . $impairment->q5_6 . "]]></q5_6>";
                    $xml .= "<q5_7><![CDATA[" . $impairment->q5_7 . "]]></q5_7>";
                    $xml .= "<q5_8><![CDATA[" . $impairment->q5_8. "]]></q5_8>";
                    $xml .= "<q5_9><![CDATA[" . $impairment->q5_9. "]]></q5_9>";
                    $xml .= "<q5_10><![CDATA[" . $impairment->q5_10 . "]]></q5_10>";
                    $xml .= "</AssessmentImpairmentType>";
                }
                if (is_object($assessment->nutrition) && $assessment->nutrition!= null) {
                    $nutrition=$assessment->nutrition;
                    $xml .= "<AssessmentNutrition>";
                    $xml .= "<q6_1><![CDATA[" . $nutrition->q6_1 . "]]></q6_1>";
                    $xml .= "<q6_2><![CDATA[" . $nutrition->q6_2 . "]]></q6_2>";
                    $xml .= "<q6_3><![CDATA[" . $nutrition->q6_3 . "]]></q6_3>";
                    $xml .= "</AssessmentNutrition>";
                }
                if (is_object($assessment->independenceParticipation) && $assessment->independenceParticipation!= null) {
                    $participation=$assessment->independenceParticipation;
                    $xml .= "<AssessmentIndependenceParticipation>";
                    $xml .= "<q7_1><![CDATA[" . $participation->q7_1 . "]]></q7_1>";
                    $xml .= "<q7_2><![CDATA[" . $participation->q7_2 . "]]></q7_2>";
                    $xml .= "<q7_3><![CDATA[" . $participation->q7_3 . "]]></q7_3>";
                    $xml .= "<q7_4><![CDATA[" . $participation->q7_4 . "]]></q7_4>";
                    $xml .= "<q7_5><![CDATA[" . $participation->q7_5 . "]]></q7_5>";
                    $xml .= "<q7_6><![CDATA[" . $participation->q7_6 . "]]></q7_6>";
                    $xml .= "<q7_7><![CDATA[" . $participation->q7_7 . "]]></q7_7>";
                    $xml .= "<q7_8><![CDATA[" . $participation->q7_8 . "]]></q7_8>";
                    $xml .= "</AssessmentIndependenceParticipation>";
                }
                if (is_object($assessment->psychosocial) && $assessment->psychosocial!= null) {
                    $psychosocial=$assessment->psychosocial;
                    $xml .= "<AssessmentIndependenceParticipation>";
                    $xml .= "<q8_1><![CDATA[" . $psychosocial->q8_1 . "]]></q8_1>";
                    $xml .= "<q8_2><![CDATA[" . $psychosocial->q8_2 . "]]></q8_2>";
                    $xml .= "<q8_3><![CDATA[" . $psychosocial->q8_3 . "]]></q8_3>";
                    $xml .= "<q8_4><![CDATA[" . $psychosocial->q8_4 . "]]></q8_4>";
                    $xml .= "<q8_5><![CDATA[" . $psychosocial->q8_5 . "]]></q8_5>";
                    $xml .= "<q8_6><![CDATA[" . $psychosocial->q8_6 . "]]></q8_6>";
                    $xml .= "<q8_7><![CDATA[" . $psychosocial->q8_7 . "]]></q8_7>";
                    $xml .= "<q8_8><![CDATA[" . $psychosocial->q8_8 . "]]></q8_8>";
                    $xml .= "</AssessmentIndependenceParticipation>";
                }
                if (is_object($assessment->psychosocial) && $assessment->psychosocial!= null) {
                    $protection=$assessment->psychosocial;
                    $xml .= "<AssessmentProtection>";
                    $xml .= "<q9_1><![CDATA[" . $protection->q9_1 . "]]></q9_1>";
                    $xml .= "<q9_2><![CDATA[" . $protection->q9_2 . "]]></q9_2>";
                    $xml .= "<q9_3><![CDATA[" . $protection->q9_3 . "]]></q9_3>";
                    $xml .= "<q9_4><![CDATA[" . $protection->q9_4 . "]]></q9_4>";
                    $xml .= "<q9_5><![CDATA[" . $protection->q9_5 . "]]></q9_5>";
                    $xml .= "<q9_6><![CDATA[" . $protection->q9_6 . "]]></q9_6>";
                    $xml .= "<q9_7><![CDATA[" . $protection->q9_7 . "]]></q9_7>";
                    $xml .= "<q9_8><![CDATA[" . $protection->q9_8 . "]]></q9_8>";
                    $xml .= "</AssessmentProtection>";
                }
                if (is_object($assessment->needs) && $assessment->needs!= null) {
                    $xml .= "<ClientNeeds>";
                    foreach ($assessment->needs as $need){
                        $xml .= "<ClientNeed>";
                        $xml .= "<status><![CDATA[" . $need->status . "]]></status>";
                        $xml .= "<location><![CDATA[" . $need->location . "]]></location>";
                        if (is_object($need->need) && $need->need!= null) {
                            $cneed=$need->need;
                            $xml .= "<Need>";
                            $xml .= "<need_name><![CDATA[" . $cneed->need_name . "]]></need_name>";
                            if (is_object($cneed->category) && $cneed->category!= null) {
                                $xml .= "<Category>";
                                $xml .= "<category_name><![CDATA[" . $need->category_name . "]]></category_name>";
                                $xml .= "</Category>";
                            }
                            $xml .= "</Need>";
                        }
                        $xml .= "</ClientNeed>";
                    }
                    $xml .= "</ClientNeeds>";
                }
                $xml .= "</VulnerabilityAssessment>";
            }
            $xml .= "</VulnerabilityAssessments>";
            $xml .= "<VulnerabilityAssessments>";
            $xml .= "<HomeAssessments>";
            foreach (HomeAssessment::all() as $home_assessment) {
                $xml .= "<HomeAssessment>";
                $xml .= "<case_code><![CDATA[" . $home_assessment->case_code . "]]></case_code>";
                $xml .= "<linked_case_code><![CDATA[" . $home_assessment->linked_case_code . "]]></linked_case_code>";
                $xml .= "<assessment_date><![CDATA[" . $home_assessment->assessment_date . "]]></assessment_date>";
                $xml .= "<needs_description><![CDATA[" . $home_assessment->needs_description . "]]></needs_description>";
                $xml .= "<findings><![CDATA[" . $home_assessment->findings . "]]></findings>";
                $xml .= "<diagnosis><![CDATA[" . $home_assessment->diagnosis . "]]></diagnosis>";
                $xml .= "<recommendations><![CDATA[" . $home_assessment->recommendations . "]]></recommendations>";
                $xml .= "<final_decision><![CDATA[" . $home_assessment->final_decision . "]]></final_decision>";
                $xml .= "<case_worker_name><![CDATA[" . $home_assessment->case_worker_name . "]]></case_worker_name>";
                $xml .= "<project_coordinator><![CDATA[" . $home_assessment->project_coordinator . "]]></project_coordinator>";
                $xml .= "<organization><![CDATA[" . $home_assessment->organization . "]]></organization>";
                $xml .= "<auth_status><![CDATA[" . $home_assessment->auth_status . "]]></auth_status>";
                $xml .= "<created_by><![CDATA[" . $home_assessment->created_by . "]]></created_by>";
                $xml .= "<updated_by><![CDATA[" . $home_assessment->updated_by . "]]></updated_by>";
                $xml .= "<auth_by><![CDATA[" . $home_assessment->auth_by . "]]></auth_by>";
                $xml .= "<auth_date><![CDATA[" . $home_assessment->auth_date . "]]></auth_date>";
                if (is_object($home_assessment->client) && $home_assessment->client!= null) {
                    $client =$home_assessment->client;
                    $xml .= "<Client>";
                    $xml .= "<hai_reg_number><![CDATA[" . $client->hai_reg_number . "]]></hai_reg_number>";
                    $xml .= "<client_number><![CDATA[" . $client->client_number . "]]></client_number>";
                    $xml .= "<full_name><![CDATA[" . $client->full_name . "]]></full_name>";
                    $xml .= "<sex><![CDATA[" . $client->sex . "]]></sex>";
                    $xml .= "<birth_date><![CDATA[" . $client->birth_date . "]]></birth_date>";
                    $xml .= "<age><![CDATA[" . $client->age . "]]></age>";
                    $xml .= "<marital_status><![CDATA[" . $client->marital_status . "]]></marital_status>";
                    $xml .= "<spouse_name><![CDATA[" . $client->spouse_name . "]]></spouse_name>";
                    $xml .= "<care_giver><![CDATA[" . $client->care_giver . "]]></care_giver>";
                    $xml .= "<child_care_giver><![CDATA[" . $client->child_care_giver . "]]></child_care_giver>";
                    $xml .= "<Origin>";
                    if (is_object($client->fromOrigin) && $client->fromOrigin != null) {
                        $origin = $client->fromOrigin;
                        $xml .= "<origin_name><![CDATA[" . $origin->origin_name . "]]></origin_name>";
                        $xml .= "<auth_status><![CDATA[" . $origin->auth_status . "]]></auth_status>";
                        $xml .= "<created_by><![CDATA[" . $origin->created_by . "]]></created_by>";
                        $xml .= "<updated_by><![CDATA[" . $origin->updated_by . "]]></updated_by>";
                        $xml .= "<auth_by><![CDATA[" . $origin->auth_by . "]]></auth_by>";
                    }
                    $xml .= "</Origin>";
                    $xml .= "<Camp>";
                    if (is_object($client->camp) && $client->camp != null) {
                        $camp = $client->camp;
                        $xml .= "<reg_no><![CDATA[" . $camp->reg_no . "]]></reg_no>";
                        $xml .= "<camp_name><![CDATA[" . $camp->camp_name . "]]></camp_name>";
                        $xml .= "<description><![CDATA[" . $camp->description . "]]></description>";
                        $xml .= "<address><![CDATA[" . $camp->address . "]]></address>";
                        $xml .= "<tel><![CDATA[" . $camp->tel . "]]></tel>";
                        $xml .= "<zone><![CDATA[" . $camp->zone . "]]></zone>";
                        $xml .= "<status><![CDATA[" . $camp->status . "]]></status>";
                        $xml .= "<auth_status><![CDATA[" . $camp->auth_status . "]]></auth_status>";
                        $xml .= "<created_by><![CDATA[" . $camp->created_by . "]]></created_by>";
                        $xml .= "<updated_by><![CDATA[" . $camp->updated_by . "]]></updated_by>";
                        $xml .= "<auth_by><![CDATA[" . $camp->auth_status . "]]></auth_by>";
                        $xml .= "<Region>";
                        $region = Region::find($camp->region_id);
                        if (count($region) > 0 && $region != null) {
                            $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                        }
                        $xml .= "</Region>";
                        $xml .= "<District>";
                        $district = District::find($camp->district_id);
                        if (count($district) > 0 && $district != null) {
                            $xml .= "<district_name><![CDATA[" . $district->district_name . "]]></district_name>";
                            $xml .= "<Region>";
                            $region = Region::find($district->region_id);
                            if (count($region) > 0 && $region != null) {
                                $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                            }
                            $xml .= "</Region>";
                        }
                        $xml .= "</District>";

                    }
                    $xml .= "</Camp>";
                    $xml .= "<date_arrival><![CDATA[" . $client->date_arrival . "]]></date_arrival>";
                    $xml .= "<present_address><![CDATA[" . $client->present_address . "]]></present_address>";
                    $xml .= "<females_total><![CDATA[" . $client->females_total . "]]></females_total>";
                    $xml .= "<males_total><![CDATA[" . $client->males_total . "]]></males_total>";
                    $xml .= "<household_number><![CDATA[" . $client->household_number . "]]></household_number>";
                    $xml .= "<ration_card_number><![CDATA[" . $client->ration_card_number . "]]></ration_card_number>";
                    $xml .= "<assistance_received><![CDATA[" . $client->assistance_received . "]]></assistance_received>";
                    $xml .= "<problem_specification><![CDATA[" . $client->problem_specification . "]]></problem_specification>";
                    $xml .= "<status><![CDATA[" . $client->status . "]]></status>";
                    $xml .= "<share_info><![CDATA[" . $client->share_info . "]]></share_info>";
                    $xml .= "<hh_relation><![CDATA[" . $client->hh_relation . "]]></hh_relation>";
                    $xml .= "<auth_status><![CDATA[" . $client->auth_status . "]]></auth_status>";
                    $xml .= "<created_by><![CDATA[" . $client->created_by . "]]></created_by>";
                    $xml .= "<updated_by><![CDATA[" . $client->updated_by . "]]></updated_by>";
                    $xml .= "<auth_by><![CDATA[" . $client->auth_by . "]]></auth_by>";
                    $xml .= "<auth_date><![CDATA[" . $client->auth_date . "]]></auth_date>";
                    $xml .= "</Client>";
                }
                $xml .= "</HomeAssessment>";
            }
            $xml .= "</HomeAssessments>";
            $xml .= "</ApplicationData>";
            File::put(storage_path() . '/SystemAssessments.xml', $xml);
            return Response::download(storage_path() . '/SystemAssessments.xml');
        }
        elseif ($request->module == 3) {
            $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $xml .= "<ApplicationData>";
            $xml .= "<ClientReferrals>";
            foreach (ClientReferral::all() as $referral){
                $xml .= "<ClientReferral>";
                $xml .= "<reference_no><![CDATA[" . $referral->reference_no . "]]></reference_no>";
                $xml .= "<referral_type><![CDATA[" . $referral->referral_type . "]]></referral_type>";
                $xml .= "<referral_date><![CDATA[" . $referral->referral_date . "]]></referral_date>";
                $xml .= "<status><![CDATA[" . $referral->status . "]]></status>";
                $xml .= "<created_by><![CDATA[" . $referral->created_by . "]]></created_by>";
                $xml .= "<updated_by><![CDATA[" . $referral->updated_by . "]]></updated_by>";
                $xml .= "<auth_by><![CDATA[" . $referral->auth_by . "]]></auth_by>";
                $xml .= "<auth_date><![CDATA[" . $referral->auth_date . "]]></auth_date>";
                if (is_object($referral->client) && $referral->client!= null) {
                    $client =$referral->client;
                    $xml .= "<Client>";
                    $xml .= "<hai_reg_number><![CDATA[" . $client->hai_reg_number . "]]></hai_reg_number>";
                    $xml .= "<client_number><![CDATA[" . $client->client_number . "]]></client_number>";
                    $xml .= "<full_name><![CDATA[" . $client->full_name . "]]></full_name>";
                    $xml .= "<sex><![CDATA[" . $client->sex . "]]></sex>";
                    $xml .= "<birth_date><![CDATA[" . $client->birth_date . "]]></birth_date>";
                    $xml .= "<age><![CDATA[" . $client->age . "]]></age>";
                    $xml .= "<marital_status><![CDATA[" . $client->marital_status . "]]></marital_status>";
                    $xml .= "<spouse_name><![CDATA[" . $client->spouse_name . "]]></spouse_name>";
                    $xml .= "<care_giver><![CDATA[" . $client->care_giver . "]]></care_giver>";
                    $xml .= "<child_care_giver><![CDATA[" . $client->child_care_giver . "]]></child_care_giver>";
                    $xml .= "<Origin>";
                    if (is_object($client->fromOrigin) && $client->fromOrigin != null) {
                        $origin = $client->fromOrigin;
                        $xml .= "<origin_name><![CDATA[" . $origin->origin_name . "]]></origin_name>";
                        $xml .= "<auth_status><![CDATA[" . $origin->auth_status . "]]></auth_status>";
                        $xml .= "<created_by><![CDATA[" . $origin->created_by . "]]></created_by>";
                        $xml .= "<updated_by><![CDATA[" . $origin->updated_by . "]]></updated_by>";
                        $xml .= "<auth_by><![CDATA[" . $origin->auth_by . "]]></auth_by>";
                    }
                    $xml .= "</Origin>";
                    $xml .= "<Camp>";
                    if (is_object($client->camp) && $client->camp != null) {
                        $camp = $client->camp;
                        $xml .= "<reg_no><![CDATA[" . $camp->reg_no . "]]></reg_no>";
                        $xml .= "<camp_name><![CDATA[" . $camp->camp_name . "]]></camp_name>";
                        $xml .= "<description><![CDATA[" . $camp->description . "]]></description>";
                        $xml .= "<address><![CDATA[" . $camp->address . "]]></address>";
                        $xml .= "<tel><![CDATA[" . $camp->tel . "]]></tel>";
                        $xml .= "<zone><![CDATA[" . $camp->zone . "]]></zone>";
                        $xml .= "<status><![CDATA[" . $camp->status . "]]></status>";
                        $xml .= "<auth_status><![CDATA[" . $camp->auth_status . "]]></auth_status>";
                        $xml .= "<created_by><![CDATA[" . $camp->created_by . "]]></created_by>";
                        $xml .= "<updated_by><![CDATA[" . $camp->updated_by . "]]></updated_by>";
                        $xml .= "<auth_by><![CDATA[" . $camp->auth_status . "]]></auth_by>";
                        $xml .= "<Region>";
                        $region = Region::find($camp->region_id);
                        if (count($region) > 0 && $region != null) {
                            $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                        }
                        $xml .= "</Region>";
                        $xml .= "<District>";
                        $district = District::find($camp->district_id);
                        if (count($district) > 0 && $district != null) {
                            $xml .= "<district_name><![CDATA[" . $district->district_name . "]]></district_name>";
                            $xml .= "<Region>";
                            $region = Region::find($district->region_id);
                            if (count($region) > 0 && $region != null) {
                                $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                            }
                            $xml .= "</Region>";
                        }
                        $xml .= "</District>";

                    }
                    $xml .= "</Camp>";
                    $xml .= "<date_arrival><![CDATA[" . $client->date_arrival . "]]></date_arrival>";
                    $xml .= "<present_address><![CDATA[" . $client->present_address . "]]></present_address>";
                    $xml .= "<females_total><![CDATA[" . $client->females_total . "]]></females_total>";
                    $xml .= "<males_total><![CDATA[" . $client->males_total . "]]></males_total>";
                    $xml .= "<household_number><![CDATA[" . $client->household_number . "]]></household_number>";
                    $xml .= "<ration_card_number><![CDATA[" . $client->ration_card_number . "]]></ration_card_number>";
                    $xml .= "<assistance_received><![CDATA[" . $client->assistance_received . "]]></assistance_received>";
                    $xml .= "<problem_specification><![CDATA[" . $client->problem_specification . "]]></problem_specification>";
                    $xml .= "<status><![CDATA[" . $client->status . "]]></status>";
                    $xml .= "<share_info><![CDATA[" . $client->share_info . "]]></share_info>";
                    $xml .= "<hh_relation><![CDATA[" . $client->hh_relation . "]]></hh_relation>";
                    $xml .= "<auth_status><![CDATA[" . $client->auth_status . "]]></auth_status>";
                    $xml .= "<created_by><![CDATA[" . $client->created_by . "]]></created_by>";
                    $xml .= "<updated_by><![CDATA[" . $client->updated_by . "]]></updated_by>";
                    $xml .= "<auth_by><![CDATA[" . $client->auth_by . "]]></auth_by>";
                    $xml .= "<auth_date><![CDATA[" . $client->auth_date . "]]></auth_date>";
                    $xml .= "</Client>";
                }
                if (is_object($referral->receivingAgency) && $referral->receivingAgency!= null) {
                    $agency=$referral->receivingAgency;
                    $xml .= "<ReceivingAgency>";
                    $xml .= "<rec_organisation><![CDATA[" . $agency->rec_organisation . "]]></rec_organisation>";
                    $xml .= "<rec_phone><![CDATA[" . $agency->rec_phone . "]]></rec_phone>";
                    $xml .= "<rec_contact><![CDATA[" . $agency->rec_contact . "]]></rec_contact>";
                    $xml .= "<rec_email><![CDATA[" . $agency->rec_email . "]]></rec_email>";
                    $xml .= "<rec_location><![CDATA[" . $agency->rec_location . "]]></rec_location>";
                    $xml .= "</ReceivingAgency>";
                }
                if (is_object($referral->referringAgency) && $referral->referringAgency!= null) {
                    $ref_agency=$referral->referringAgency;
                    $xml .= "<ReceivingAgency>";
                    $xml .= "<ref_organisation><![CDATA[" . $ref_agency->ref_organisation . "]]></ref_organisation>";
                    $xml .= "<ref_phone><![CDATA[" . $ref_agency->ref_phone . "]]></ref_phone>";
                    $xml .= "<ref_contact><![CDATA[" . $ref_agency->ref_contact . "]]></ref_contact>";
                    $xml .= "<ref_email><![CDATA[" . $ref_agency->ref_email . "]]></ref_email>";
                    $xml .= "<ref_location><![CDATA[" . $ref_agency->ref_location . "]]></ref_location>";
                    $xml .= "</ReceivingAgency>";
                }
                if (is_object($referral->clientInformation) && $referral->clientInformation!= null) {
                    $refClient=$referral->clientInformation;
                    $xml .= "<ClientInformation>";
                    $xml .= "<cl_name><![CDATA[" . $refClient->cl_name . "]]></cl_name>";
                    $xml .= "<cl_address><![CDATA[" . $refClient->cl_address . "]]></cl_address>";
                    $xml .= "<cl_phone><![CDATA[" . $refClient->cl_phone . "]]></cl_phone>";
                    $xml .= "<cl_age><![CDATA[" . $refClient->cl_age . "]]></cl_age>";
                    $xml .= "<cl_sex><![CDATA[" . $refClient->cl_sex . "]]></cl_sex>";
                    $xml .= "<cl_nationality><![CDATA[" . $refClient->cl_nationality . "]]></cl_nationality>";
                    $xml .= "<cl_language><![CDATA[" . $refClient->cl_language . "]]></cl_language>";
                    $xml .= "<cl_id_number><![CDATA[" . $refClient->cl_id_number . "]]></cl_id_number>";
                    $xml .= "<cl_care_giver><![CDATA[" . $refClient->cl_care_giver . "]]></cl_care_giver>";
                    $xml .= "<cl_care_giver_relationship><![CDATA[" . $refClient->cl_care_giver_relationship . "]]></cl_care_giver_relationship>";
                    $xml .= "<cl_care_giver_contact><![CDATA[" . $refClient->cl_care_giver_contact . "]]></cl_care_giver_contact>";
                    $xml .= "<cl_child_separated><![CDATA[" . $refClient->cl_child_separated . "]]></cl_child_separated>";
                    $xml .= "<cl_care_giver_informed><![CDATA[" . $refClient->cl_care_giver_informed . "]]></cl_care_giver_informed>";
                    $xml .= "</ClientInformation>";
                }
                if (is_object($referral->referralReason) && $referral->referralReason!= null) {
                    $reason=$referral->referralReason;
                    $xml .= "<ReferralReason>";
                    $xml .= "<client_referral_info><![CDATA[" . $reason->client_referral_info . "]]></client_referral_info>";
                    $xml .= "<client_referral_status><![CDATA[" . $reason->client_referral_status . "]]></client_referral_status>";
                    $xml .= "<client_referral_info_text><![CDATA[" . $reason->client_referral_info_text . "]]></client_referral_info_text>";
                    $xml .= "<client_referral_status_text><![CDATA[" . $reason->client_referral_status_text . "]]></client_referral_status_text>";
                    $xml .= "</ReferralReason>";
                }
                if (is_object($referral->referralServiceRequested) && $referral->referralServiceRequested!= null) {
                    $service=$referral->referralServiceRequested;
                    $xml .= "<ReferralServiceRequested>";
                    $xml .= "<comments><![CDATA[" . $service->comments . "]]></comments>";
                    $xml .= "<RequestedServicies>";
                    foreach ($service->services as $service) {
                        $xml .= "<RequestedService>";
                        $xml .= "<service_request><![CDATA[" . $service->service_request . "]]></service_request>";
                        $xml .= "<RequestedService>";
                    }
                    $xml .= "</RequestedServicies>";
                    $xml .= "</ReferralServiceRequested>";
                }
                $xml .= "</ClientReferral>";
            }
            $xml .= "</ClientReferrals>";
            $xml .= "</ApplicationData>";
            File::put(storage_path() . '/ClientReferrals.xml', $xml);
            return Response::download(storage_path() . '/ClientReferrals.xml');
        }
        elseif ($request->module == 4){
            $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $xml .= "<ApplicationData>";
            $xml .= "<ItemsCategories>";
             foreach (ItemsCategories::all() as $category){
                 $xml .= "</ItemsCategory>";
                 $xml .= "<category_name><![CDATA[" . $category->category_name . "]]></category_name>";
                 $xml .= "<status><![CDATA[" . $category->status . "]]></status>";
                 $xml .= "<description><![CDATA[" . $category->description . "]]></description>";
                 if (is_object($category->items) && $category->items){
                     $xml .= "<ItemsInventories>";
                     foreach ($category->items as $item){
                         $xml .= "<ItemsInventory>";
                         $xml .= "<item_name><![CDATA[" . $item->item_name . "]]></item_name>";
                         $xml .= "<description><![CDATA[" . $item->description . "]]></description>";
                         $xml .= "<quantity><![CDATA[" . $item->quantity . "]]></quantity>";
                         $xml .= "<unit><![CDATA[" . $item->unit . "]]></unit>";
                         $xml .= "<remarks><![CDATA[" . $item->remarks . "]]></remarks>";
                         $xml .= "<status><![CDATA[" . $item->status . "]]></status>";
                         $xml .= "<redistribution_limit><![CDATA[" . $item->redistribution_limit . "]]></redistribution_limit>";
                         $xml .= "</ItemsInventory>";
                     }
                     $xml .= "</ItemsInventories>";
                 }
                 $xml .= "</ItemsCategory>";
             }
            $xml .= "</ItemsCategories>";
            $xml .= "<InventoriesReceived>";
            foreach (InventoryReceived::all() as $item){
                $xml .= "<InventoryReceived>";
                $xml .= "<reference_number><![CDATA[" . $item->reference_number . "]]></reference_number>";
                $xml .= "<date_received><![CDATA[" . $item->date_received . "]]></date_received>";
                $xml .= "<donor_ref><![CDATA[" . $item->donor_ref . "]]></donor_ref>";
                $xml .= "<received_from><![CDATA[" . $item->received_from . "]]></received_from>";
                $xml .= "<receiving_officer><![CDATA[" . $item->receiving_officer . "]]></receiving_officer>";
                $xml .= "<received_from><![CDATA[" . $item->received_from . "]]></received_from>";
                $xml .= "<project><![CDATA[" . $item->project . "]]></project>";
                $xml .= "<onward_delivery><![CDATA[" . $item->onward_delivery . "]]></onward_delivery>";
                $xml .= "<comments><![CDATA[" . $item->comments . "]]></comments>";
                $xml .= "<created_by><![CDATA[" . $item->created_by . "]]></created_by>";
                $xml .= "<ItemsReceived>";
                if (is_object($item->items)){
                    foreach ($item->items as $item_received){
                        $xml .= "<ItemReceived>";
                        $xml .= "<quantity><![CDATA[" . $item_received->quantity . "]]></quantity>";
                        $xml .= "<description><![CDATA[" . $item_received->description . "]]></description>";
                        if (is_object($item_received->item) && $item_received->item != null){
                            $xml .= "<ItemsInventory>";
                            $xml .= "<item_name><![CDATA[" . $item_received->item->item_name . "]]></item_name>";
                            $xml .= "<description><![CDATA[" . $item_received->item->description . "]]></description>";
                            $xml .= "<quantity><![CDATA[" . $item_received->item->quantity . "]]></quantity>";
                            $xml .= "<unit><![CDATA[" . $item_received->item->unit . "]]></unit>";
                            $xml .= "<remarks><![CDATA[" . $item_received->item->remarks . "]]></remarks>";
                            $xml .= "<status><![CDATA[" . $item_received->item->status . "]]></status>";
                            $xml .= "<redistribution_limit><![CDATA[" . $item->redistribution_limit . "]]></redistribution_limit>";
                            $xml .= "</ItemsInventory>";
                        }
                        $xml .= "</ItemReceived>";
                    }
                }
                $xml .= "</ItemsReceived>";
                $xml .= "</InventoryReceived>";
            }
            $xml .= "</InventoriesReceived>";
            $xml .= "<ItemsDisbursement>";
            foreach (ItemsDisbursement::all() as $item) {
                $xml .= "<ItemDisbursement>";
                $xml .= "<disbursements_date><![CDATA[" . $item->disbursements_date . "]]></disbursements_date>";
                $xml .= "<comments><![CDATA[" . $item->comments . "]]></comments>";
                $xml .= "<disbursements_by><![CDATA[" . $item->disbursements_by . "]]></disbursements_by>";
                if (is_object($item->camp)) {
                    $xml .= "<Camp>";
                    $camp = $item->camp;
                    $xml .= "<reg_no><![CDATA[" . $camp->reg_no . "]]></reg_no>";
                    $xml .= "<camp_name><![CDATA[" . $camp->camp_name . "]]></camp_name>";
                    $xml .= "<description><![CDATA[" . $camp->description . "]]></description>";
                    $xml .= "<address><![CDATA[" . $camp->address . "]]></address>";
                    $xml .= "<tel><![CDATA[" . $camp->tel . "]]></tel>";
                    $xml .= "<zone><![CDATA[" . $camp->zone . "]]></zone>";
                    $xml .= "<status><![CDATA[" . $camp->status . "]]></status>";
                    $xml .= "<auth_status><![CDATA[" . $camp->auth_status . "]]></auth_status>";
                    $xml .= "<created_by><![CDATA[" . $camp->created_by . "]]></created_by>";
                    $xml .= "<updated_by><![CDATA[" . $camp->updated_by . "]]></updated_by>";
                    $xml .= "<auth_by><![CDATA[" . $camp->auth_status . "]]></auth_by>";
                    $xml .= "<Region>";
                    $region = Region::find($camp->region_id);
                    if (count($region) > 0 && $region != null) {
                        $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                    }
                    $xml .= "</Region>";
                    $xml .= "<District>";
                    $district = District::find($camp->district_id);
                    if (count($district) > 0 && $district != null) {
                        $xml .= "<district_name><![CDATA[" . $district->district_name . "]]></district_name>";
                        $xml .= "<Region>";
                        $region = Region::find($district->region_id);
                        if (count($region) > 0 && $region != null) {
                            $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                        }
                        $xml .= "</Region>";
                    }
                    $xml .= "</District>";
                    $xml .= "</Camp>";

                }
                $xml .= "</ItemDisbursement>";
                if (is_object($item->distributions)) {
                    foreach ($item->distributions as $distribution){
                        $xml .= "<ItemsDisbursementItems>";
                        $xml .= "<quantity><![CDATA[" . $distribution->quantity . "]]></quantity>";
                        $xml .= "<distribution_date><![CDATA[" . $distribution->distribution_date . "]]></distribution_date>";
                        if (is_object($distribution->client)) {
                            $client=$distribution->client;
                            $xml .= "<Client>";
                            $xml .= "<hai_reg_number><![CDATA[" . $client->hai_reg_number . "]]></hai_reg_number>";
                            $xml .= "<client_number><![CDATA[" . $client->client_number . "]]></client_number>";
                            $xml .= "<full_name><![CDATA[" . $client->full_name . "]]></full_name>";
                            $xml .= "<sex><![CDATA[" . $client->sex . "]]></sex>";
                            $xml .= "<birth_date><![CDATA[" . $client->birth_date . "]]></birth_date>";
                            $xml .= "<age><![CDATA[" . $client->age . "]]></age>";
                            $xml .= "<marital_status><![CDATA[" . $client->marital_status . "]]></marital_status>";
                            $xml .= "<spouse_name><![CDATA[" . $client->spouse_name . "]]></spouse_name>";
                            $xml .= "<care_giver><![CDATA[" . $client->care_giver . "]]></care_giver>";
                            $xml .= "<child_care_giver><![CDATA[" . $client->child_care_giver . "]]></child_care_giver>";
                            $xml .= "<Origin>";
                            if (is_object($client->fromOrigin) && $client->fromOrigin != null) {
                                $origin = $client->fromOrigin;
                                $xml .= "<origin_name><![CDATA[" . $origin->origin_name . "]]></origin_name>";
                                $xml .= "<auth_status><![CDATA[" . $origin->auth_status . "]]></auth_status>";
                                $xml .= "<created_by><![CDATA[" . $origin->created_by . "]]></created_by>";
                                $xml .= "<updated_by><![CDATA[" . $origin->updated_by . "]]></updated_by>";
                                $xml .= "<auth_by><![CDATA[" . $origin->auth_by . "]]></auth_by>";
                            }
                            $xml .= "</Origin>";
                            $xml .= "<Camp>";
                            if (is_object($client->camp) && $client->camp != null) {
                                $camp = $client->camp;
                                $xml .= "<reg_no><![CDATA[" . $camp->reg_no . "]]></reg_no>";
                                $xml .= "<camp_name><![CDATA[" . $camp->camp_name . "]]></camp_name>";
                                $xml .= "<description><![CDATA[" . $camp->description . "]]></description>";
                                $xml .= "<address><![CDATA[" . $camp->address . "]]></address>";
                                $xml .= "<tel><![CDATA[" . $camp->tel . "]]></tel>";
                                $xml .= "<zone><![CDATA[" . $camp->zone . "]]></zone>";
                                $xml .= "<status><![CDATA[" . $camp->status . "]]></status>";
                                $xml .= "<auth_status><![CDATA[" . $camp->auth_status . "]]></auth_status>";
                                $xml .= "<created_by><![CDATA[" . $camp->created_by . "]]></created_by>";
                                $xml .= "<updated_by><![CDATA[" . $camp->updated_by . "]]></updated_by>";
                                $xml .= "<auth_by><![CDATA[" . $camp->auth_status . "]]></auth_by>";
                                $xml .= "<Region>";
                                $region = Region::find($camp->region_id);
                                if (count($region) > 0 && $region != null) {
                                    $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                                }
                                $xml .= "</Region>";
                                $xml .= "<District>";
                                $district = District::find($camp->district_id);
                                if (count($district) > 0 && $district != null) {
                                    $xml .= "<district_name><![CDATA[" . $district->district_name . "]]></district_name>";
                                    $xml .= "<Region>";
                                    $region = Region::find($district->region_id);
                                    if (count($region) > 0 && $region != null) {
                                        $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                                    }
                                    $xml .= "</Region>";
                                }
                                $xml .= "</District>";

                            }
                            $xml .= "</Camp>";
                            $xml .= "<date_arrival><![CDATA[" . $client->date_arrival . "]]></date_arrival>";
                            $xml .= "<present_address><![CDATA[" . $client->present_address . "]]></present_address>";
                            $xml .= "<females_total><![CDATA[" . $client->females_total . "]]></females_total>";
                            $xml .= "<males_total><![CDATA[" . $client->males_total . "]]></males_total>";
                            $xml .= "<household_number><![CDATA[" . $client->household_number . "]]></household_number>";
                            $xml .= "<ration_card_number><![CDATA[" . $client->ration_card_number . "]]></ration_card_number>";
                            $xml .= "<assistance_received><![CDATA[" . $client->assistance_received . "]]></assistance_received>";
                            $xml .= "<problem_specification><![CDATA[" . $client->problem_specification . "]]></problem_specification>";
                            $xml .= "<status><![CDATA[" . $client->status . "]]></status>";
                            $xml .= "<share_info><![CDATA[" . $client->share_info . "]]></share_info>";
                            $xml .= "<hh_relation><![CDATA[" . $client->hh_relation . "]]></hh_relation>";
                            $xml .= "<auth_status><![CDATA[" . $client->auth_status . "]]></auth_status>";
                            $xml .= "<created_by><![CDATA[" . $client->created_by . "]]></created_by>";
                            $xml .= "<updated_by><![CDATA[" . $client->updated_by . "]]></updated_by>";
                            $xml .= "<auth_by><![CDATA[" . $client->auth_by . "]]></auth_by>";
                            $xml .= "<auth_date><![CDATA[" . $client->auth_date . "]]></auth_date>";
                            $xml .= "</Client>";
                        }
                        if (is_object($distribution->items) && $distribution->items){
                                $xml .= "<ItemsInventory>";
                                $xml .= "<item_name><![CDATA[" . $item->item_name . "]]></item_name>";
                                $xml .= "<description><![CDATA[" . $item->description . "]]></description>";
                                $xml .= "<quantity><![CDATA[" . $item->quantity . "]]></quantity>";
                                $xml .= "<unit><![CDATA[" . $item->unit . "]]></unit>";
                                $xml .= "<remarks><![CDATA[" . $item->remarks . "]]></remarks>";
                                $xml .= "<status><![CDATA[" . $item->status . "]]></status>";
                                $xml .= "<redistribution_limit><![CDATA[" . $item->redistribution_limit . "]]></redistribution_limit>";
                                $xml .= "</ItemsInventory>";
                        }
                        $xml .= "</ItemsDisbursementItems>";
                    }

                }
            }
            $xml .= "</ItemsDisbursement>";
            $xml .= "</ApplicationData>";
            File::put(storage_path() . '/SystemNFIsInventory.xml', $xml);
            return Response::download(storage_path() . '/SystemNFIsInventory.xml');
        }
        elseif ($request->module == 5){
            $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $xml .= "<ApplicationData>";
            $xml .= "<BudgetActivities>";
            foreach (BudgetActivity::all() as $activity){

                $xml .= "<BudgetActivity>";
                $xml .= "<activity_name><![CDATA[" . $activity->activity_name . "]]></activity_name>";
                $xml .= "<description><![CDATA[" . $activity->description . "]]></description>";
                $xml .= "<amount><![CDATA[" . $activity->amount . "]]></amount>";
                $xml .= "<currency><![CDATA[" . $activity->currency . "]]></currency>";
                $xml .= "<remarks><![CDATA[" . $activity->remarks . "]]></remarks>";
                $xml .= "<provision_limit><![CDATA[" . $activity->provision_limit . "]]></provision_limit>";
                $xml .= "<status><![CDATA[" . $activity->status . "]]></status>";
                $xml .= "<donor><![CDATA[" . $activity->donor . "]]></donor>";
                $xml .= "<auth_status><![CDATA[" . $activity->auth_status . "]]></auth_status>";
                $xml .= "<created_by><![CDATA[" . $activity->created_by . "]]></created_by>";
                $xml .= "<updated_by><![CDATA[" . $activity->updated_by . "]]></updated_by>";
                $xml .= "<CashProvisions>";
                if (is_object($activity->provisions)) {
                    foreach ($activity->provisions as $provision) {
                        $xml .= "<CashProvision>";
                        $xml .= "<provision_date><![CDATA[" . $provision->provision_date . "]]></provision_date>";
                        $xml .= "<provided_by><![CDATA[" . $provision->provided_by . "]]></provided_by>";
                        $xml .= "<comments><![CDATA[" . $provision->comments . "]]></comments>";
                        $xml .= "<created_by><![CDATA[" . $provision->created_by . "]]></created_by>";
                        $xml .= "<Camp>";
                        if (is_object($provision->camp)) {
                            $camp = $provision->camp;
                            $xml .= "<reg_no><![CDATA[" . $camp->reg_no . "]]></reg_no>";
                            $xml .= "<camp_name><![CDATA[" . $camp->camp_name . "]]></camp_name>";
                            $xml .= "<description><![CDATA[" . $camp->description . "]]></description>";
                            $xml .= "<address><![CDATA[" . $camp->address . "]]></address>";
                            $xml .= "<tel><![CDATA[" . $camp->tel . "]]></tel>";
                            $xml .= "<zone><![CDATA[" . $camp->zone . "]]></zone>";
                            $xml .= "<status><![CDATA[" . $camp->status . "]]></status>";
                            $xml .= "<auth_status><![CDATA[" . $camp->auth_status . "]]></auth_status>";
                            $xml .= "<created_by><![CDATA[" . $camp->created_by . "]]></created_by>";
                            $xml .= "<updated_by><![CDATA[" . $camp->updated_by . "]]></updated_by>";
                            $xml .= "<auth_by><![CDATA[" . $camp->auth_status . "]]></auth_by>";
                            $xml .= "<Region>";
                            $region = Region::find($camp->region_id);
                            if (count($region) > 0 && $region != null) {
                                $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                            }
                            $xml .= "</Region>";
                            $xml .= "<District>";
                            $district = District::find($camp->district_id);
                            if (count($district) > 0 && $district != null) {
                                $xml .= "<district_name><![CDATA[" . $district->district_name . "]]></district_name>";
                                $xml .= "<Region>";
                                $region = Region::find($district->region_id);
                                if (count($region) > 0 && $region != null) {
                                    $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                                }
                                $xml .= "</Region>";
                            }
                            $xml .= "</District>";

                        }
                        $xml .= "</Camp>";
                        $xml .= "<CashProvisionClients>";
                        if (is_object($provision->provisions)) {
                            foreach ($provision->provisions as $provision_client) {
                                $xml .= "<CashProvisionClient>";
                                $xml .= "<amount><![CDATA[" . $provision_client->amount . "]]></amount>";
                                $xml .= "<provision_date><![CDATA[" . $provision_client->provision_date . "]]></provision_date>";
                                if (is_object($provision_client->client)) {
                                    $client = $provision_client->client;
                                    $xml .= "<Client>";
                                    $xml .= "<hai_reg_number><![CDATA[" . $client->hai_reg_number . "]]></hai_reg_number>";
                                    $xml .= "<client_number><![CDATA[" . $client->client_number . "]]></client_number>";
                                    $xml .= "<full_name><![CDATA[" . $client->full_name . "]]></full_name>";
                                    $xml .= "<sex><![CDATA[" . $client->sex . "]]></sex>";
                                    $xml .= "<birth_date><![CDATA[" . $client->birth_date . "]]></birth_date>";
                                    $xml .= "<age><![CDATA[" . $client->age . "]]></age>";
                                    $xml .= "<marital_status><![CDATA[" . $client->marital_status . "]]></marital_status>";
                                    $xml .= "<spouse_name><![CDATA[" . $client->spouse_name . "]]></spouse_name>";
                                    $xml .= "<care_giver><![CDATA[" . $client->care_giver . "]]></care_giver>";
                                    $xml .= "<child_care_giver><![CDATA[" . $client->child_care_giver . "]]></child_care_giver>";
                                    $xml .= "<Origin>";
                                    if (is_object($client->fromOrigin) && $client->fromOrigin != null) {
                                        $origin = $client->fromOrigin;
                                        $xml .= "<origin_name><![CDATA[" . $origin->origin_name . "]]></origin_name>";
                                        $xml .= "<auth_status><![CDATA[" . $origin->auth_status . "]]></auth_status>";
                                        $xml .= "<created_by><![CDATA[" . $origin->created_by . "]]></created_by>";
                                        $xml .= "<updated_by><![CDATA[" . $origin->updated_by . "]]></updated_by>";
                                        $xml .= "<auth_by><![CDATA[" . $origin->auth_by . "]]></auth_by>";
                                    }
                                    $xml .= "</Origin>";
                                    $xml .= "<Camp>";
                                    if (is_object($client->camp) && $client->camp != null) {
                                        $camp = $client->camp;
                                        $xml .= "<reg_no><![CDATA[" . $camp->reg_no . "]]></reg_no>";
                                        $xml .= "<camp_name><![CDATA[" . $camp->camp_name . "]]></camp_name>";
                                        $xml .= "<description><![CDATA[" . $camp->description . "]]></description>";
                                        $xml .= "<address><![CDATA[" . $camp->address . "]]></address>";
                                        $xml .= "<tel><![CDATA[" . $camp->tel . "]]></tel>";
                                        $xml .= "<zone><![CDATA[" . $camp->zone . "]]></zone>";
                                        $xml .= "<status><![CDATA[" . $camp->status . "]]></status>";
                                        $xml .= "<auth_status><![CDATA[" . $camp->auth_status . "]]></auth_status>";
                                        $xml .= "<created_by><![CDATA[" . $camp->created_by . "]]></created_by>";
                                        $xml .= "<updated_by><![CDATA[" . $camp->updated_by . "]]></updated_by>";
                                        $xml .= "<auth_by><![CDATA[" . $camp->auth_status . "]]></auth_by>";
                                        $xml .= "<Region>";
                                        $region = Region::find($camp->region_id);
                                        if (count($region) > 0 && $region != null) {
                                            $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                                        }
                                        $xml .= "</Region>";
                                        $xml .= "<District>";
                                        $district = District::find($camp->district_id);
                                        if (count($district) > 0 && $district != null) {
                                            $xml .= "<district_name><![CDATA[" . $district->district_name . "]]></district_name>";
                                            $xml .= "<Region>";
                                            $region = Region::find($district->region_id);
                                            if (count($region) > 0 && $region != null) {
                                                $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                                            }
                                            $xml .= "</Region>";
                                        }
                                        $xml .= "</District>";

                                    }
                                    $xml .= "</Camp>";
                                    $xml .= "<date_arrival><![CDATA[" . $client->date_arrival . "]]></date_arrival>";
                                    $xml .= "<present_address><![CDATA[" . $client->present_address . "]]></present_address>";
                                    $xml .= "<females_total><![CDATA[" . $client->females_total . "]]></females_total>";
                                    $xml .= "<males_total><![CDATA[" . $client->males_total . "]]></males_total>";
                                    $xml .= "<household_number><![CDATA[" . $client->household_number . "]]></household_number>";
                                    $xml .= "<ration_card_number><![CDATA[" . $client->ration_card_number . "]]></ration_card_number>";
                                    $xml .= "<assistance_received><![CDATA[" . $client->assistance_received . "]]></assistance_received>";
                                    $xml .= "<problem_specification><![CDATA[" . $client->problem_specification . "]]></problem_specification>";
                                    $xml .= "<status><![CDATA[" . $client->status . "]]></status>";
                                    $xml .= "<share_info><![CDATA[" . $client->share_info . "]]></share_info>";
                                    $xml .= "<hh_relation><![CDATA[" . $client->hh_relation . "]]></hh_relation>";
                                    $xml .= "<auth_status><![CDATA[" . $client->auth_status . "]]></auth_status>";
                                    $xml .= "<created_by><![CDATA[" . $client->created_by . "]]></created_by>";
                                    $xml .= "<updated_by><![CDATA[" . $client->updated_by . "]]></updated_by>";
                                    $xml .= "<auth_by><![CDATA[" . $client->auth_by . "]]></auth_by>";
                                    $xml .= "<auth_date><![CDATA[" . $client->auth_date . "]]></auth_date>";
                                    $xml .= "</Client>";
                                }
                                $xml .= "</CashProvisionClient>";
                            }
                        }
                        $xml .= "<CashProvisionClients>";
                        $xml .= "</CashProvision>";
                    }
                }
                $xml .= "</CashProvisions>";
                $xml .= "</BudgetActivity>";
            }
            $xml .= "</BudgetActivities>";
            $xml .= "</ApplicationData>";

            File::put(storage_path() . '/SystemCashDistributionsData.xml', $xml);
            return Response::download(storage_path() . '/SystemData.xml');
        }
        else {
            $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $xml .= "<ApplicationData>";
            $xml .= "<Countries>";
            foreach (Country::all() as $country)
            {
                $xml .= "<Country>";
                $xml .= "<country_name><![CDATA[" . $country->country_name . "]]></country_name>";
                $xml .= "<country_code><![CDATA[" . $country->country_code . "]]></country_code>";
                $xml .= "<auth_status><![CDATA[" . $country->auth_status . "]]></auth_status>";
                $xml .= "<created_by><![CDATA[" . $country->created_by . "]]></created_by>";
                $xml .= "<updated_by><![CDATA[" . $country->updated_by . "]]></updated_by>";
                $xml .= "<auth_by><![CDATA[" . $country->auth_by . "]]></auth_by>";
                $xml .= "</Country>";
                $xml .= "<Regions>";
                foreach (Region::where('country_id','=',$country->id)->get() as $region)
                {
                    $xml .= "<Region>";
                    $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                    $xml .= "<auth_status><![CDATA[" . $region->auth_status . "]]></auth_status>";
                    $xml .= "<created_by><![CDATA[" . $region->created_by . "]]></created_by>";
                    $xml .= "<updated_by><![CDATA[" . $region->updated_by . "]]></updated_by>";
                    $xml .= "<auth_by><![CDATA[" . $region->auth_by . "]]></auth_by>";
                    $xml .= "<Districts>";
                    foreach (District::where('region_id','=',$region->id)->get() as $district)
                    {
                        $xml .= "<District>";
                        $xml .= "<district_name><![CDATA[" . $district->district_name . "]]></district_name>";
                        $xml .= "<auth_status><![CDATA[" . $district->auth_status . "]]></auth_status>";
                        $xml .= "<created_by><![CDATA[" . $district->created_by . "]]></created_by>";
                        $xml .= "<updated_by><![CDATA[" . $district->updated_by . "]]></updated_by>";
                        $xml .= "<auth_by><![CDATA[" . $district->auth_by . "]]></auth_by>";
                        $xml .= "<Camps>";
                        foreach (Camp::where('district_id','=',$district->id)->get() as $camp)
                        {
                            $xml .= "<Camp>";
                            $xml .= "<reg_no><![CDATA[" . $camp->reg_no . "]]></reg_no>";
                            $xml .= "<camp_name><![CDATA[" . $camp->camp_name . "]]></camp_name>";
                            $xml .= "<description><![CDATA[" . $camp->description . "]]></description>";
                            $xml .= "<address><![CDATA[" . $camp->address . "]]></address>";
                            $xml .= "<tel><![CDATA[" . $camp->tel . "]]></tel>";
                            $xml .= "<status><![CDATA[" . $camp->status . "]]></status>";
                            $xml .= "<auth_status><![CDATA[" . $camp->auth_status . "]]></auth_status>";
                            $xml .= "<created_by><![CDATA[" . $camp->created_by . "]]></created_by>";
                            $xml .= "<updated_by><![CDATA[" . $camp->updated_by . "]]></updated_by>";
                            $xml .= "<auth_by><![CDATA[" . $camp->auth_status . "]]></auth_by>";
                            $xml .= "<Clients>";
                            foreach (Client::where('camp_id','=',$camp->id)->get() as $client)
                            {
                                $xml .= "<Client>";
                                $xml .= "<hai_reg_number><![CDATA[" . $client->hai_reg_number . "]]></hai_reg_number>";
                                $xml .= "<client_number><![CDATA[" . $client->client_number . "]]></client_number>";
                                $xml .= "<full_name><![CDATA[" . $client->full_name . "]]></full_name>";
                                $xml .= "<sex><![CDATA[" . $client->sex . "]]></sex>";
                                $xml .= "<birth_date><![CDATA[" . $client->birth_date . "]]></birth_date>";
                                $xml .= "<age><![CDATA[" . $client->age . "]]></age>";
                                $xml .= "<marital_status><![CDATA[" . $client->marital_status . "]]></marital_status>";
                                $xml .= "<spouse_name><![CDATA[" . $client->spouse_name . "]]></spouse_name>";
                                $xml .= "<care_giver><![CDATA[" . $client->care_giver . "]]></care_giver>";
                                $xml .= "<child_care_giver><![CDATA[" . $client->child_care_giver . "]]></child_care_giver>";
                                $xml .= "<date_arrival><![CDATA[" . $client->date_arrival . "]]></date_arrival>";
                                $xml .= "<present_address><![CDATA[" . $client->present_address . "]]></present_address>";
                                $xml .= "<females_total><![CDATA[" . $client->females_total . "]]></females_total>";
                                $xml .= "<males_total><![CDATA[" . $client->males_total . "]]></males_total>";
                                $xml .= "<household_number><![CDATA[" . $client->household_number . "]]></household_number>";
                                $xml .= "<ration_card_number><![CDATA[" . $client->ration_card_number . "]]></ration_card_number>";
                                $xml .= "<assistance_received><![CDATA[" . $client->assistance_received . "]]></assistance_received>";
                                $xml .= "<problem_specification><![CDATA[" . $client->problem_specification . "]]></problem_specification>";
                                $xml .= "<status><![CDATA[" . $client->status . "]]></status>";
                                $xml .= "<share_info><![CDATA[" . $client->share_info . "]]></share_info>";
                                $xml .= "<hh_relation><![CDATA[" . $client->hh_relation . "]]></hh_relation>";
                                $xml .= "<auth_status><![CDATA[" . $client->auth_status . "]]></auth_status>";
                                $xml .= "<created_by><![CDATA[" . $client->created_by . "]]></created_by>";
                                $xml .= "<updated_by><![CDATA[" . $client->updated_by . "]]></updated_by>";
                                $xml .= "<auth_by><![CDATA[" . $client->auth_by . "]]></auth_by>";
                                $xml .= "<auth_date><![CDATA[" . $client->auth_date . "]]></auth_date>";
                                $xml .= "<Origin>";
                                if (is_object($client->fromOrigin) && $client->fromOrigin != null)
                                {
                                    $origin = $client->fromOrigin;
                                    $xml .= "<origin_name><![CDATA[" . $origin->origin_name . "]]></origin_name>";
                                    $xml .= "<auth_status><![CDATA[" . $origin->auth_status . "]]></auth_status>";
                                    $xml .= "<created_by><![CDATA[" . $origin->created_by . "]]></created_by>";
                                    $xml .= "<updated_by><![CDATA[" . $origin->updated_by . "]]></updated_by>";
                                    $xml .= "<auth_by><![CDATA[" . $origin->auth_by . "]]></auth_by>";
                                }
                                $xml .= "</Origin>";
                                $xml .= "</Client>";
                            }
                            $xml .= "</Clients>";
                            $xml .= "</Camp>";
                        }
                        $xml .= "</Camps>";
                        $xml .= "</District>";
                    }
                    $xml .= "</Districts>";
                    $xml .= "</Region>";
                }
                $xml .= "<Regions>";
                $xml .= "<Country>";
            }
            $xml .= "<Countries>";
            $xml .= "</ApplicationData>";

            File::put(storage_path() . '/SystemData.xml', $xml);
            return Response::download(storage_path() . '/SystemData.xml');
        }

    }
    //Data export
    public function showImport()
    {
        //
        return view('backups.imports.index');
    }
    public function postImport(Request $request)
    {
        //
        $this->validate($request, [
            'system_data_file' => 'required|mimes:xml',
        ]);

        return redirect('home');
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
