<?php

namespace App\Http\Controllers;

use App\AssessmentEconomicSituation;
use App\AssessmentHousholdProfile;
use App\AssessmentImpairmentType;
use App\AssessmentIndependenceParticipation;
use App\AssessmentNutrition;
use App\AssessmentProtection;
use App\AssessmentPsychosocial;
use App\AssessmentVulnerabilityType;
use App\BudgetActivity;
use App\Camp;
use App\CashProvision;
use App\CashProvisionClient;
use App\Client;
use App\ClientCase;
use App\ClientInformation;
use App\ClientNeed;
use App\ClientReferral;
use App\ClientVulnerabilityCode;
use App\Country;
use App\District;
use App\HomeAssessment;
use App\InventoryReceived;
use App\ItemReceived;
use App\ItemsCategories;
use App\ItemsDisbursement;
use App\ItemsDisbursementItems;
use App\ItemsInventory;
use App\NeedCategory;
use App\Origin;
use App\PCCashUsage;
use App\PCCashUsageCategory;
use App\PCCashWithdrawal;
use App\PCCategories;
use App\PCCommunalRelations;
use App\PCDemographicDetails;
use App\PCPhysicallyReceivingCash;
use App\PostCashAssessment;
use App\ProgressNote;
use App\PSNCode;
use App\PSNCodeCategory;
use App\ReceivingAgency;
use App\ReferralReason;
use App\ReferralServiceRequested;
use App\ReferringAgency;
use App\Region;
use App\RequestedService;
use App\VulnerabilityAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use Log;
use App\Helpers\ExportXMLGeneratorUtility;

class BackupImportExportController extends Controller {

    private $uploadDir = '/uploads';
    private $storage = null;
    private $xmlGenerator = null;

    public function __construct() {
        $this->middleware('auth');
        $this->storage = Storage::disk('local');
        $this->xmlGenerator = new ExportXMLGeneratorUtility();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadDocs() {
        try {

            return response()->json([
                'docs' => $this->storage->allFiles('/uploads'),
                'storage_path' => storage_path('app' . $this->uploadDir)
            ]);
        } catch (\Exception $ex) {
            return response()->json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 400); // 400 being the HTTP code for an invalid request.
        }
    }

    public function showExport() {
        return view('backups.exports.index');
    }

    public function postExport(Request $request) {
        ob_clean();
        try {
            $this->validate($request, [
                'module' => 'required',
            ]);

            if ($request->module == 1) {
                Client::chunk(1000, function($clients) {
                    $this->xmlGenerator->generateClients($clients);
                });
                return response()->json([
                    'success' => true,
                    'message' => 'Client XML file has been scheduled for downloads'
                ]);
            } elseif ($request->module == 2) {

                VulnerabilityAssessment::chunk(1000, function($assessments) {
                    $this->xmlGenerator->generateVulnerabilityAssessments($assessments);
                });
                HomeAssessment::chunk(1000, function($homeAssessments) {
                    $this->xmlGenerator->generateHomeAssessments($homeAssessments);
                });
                return response()->json([
                    'success' => true,
                    'message' => 'Assessments XML file has been scheduled for downloads'
                ], 200);
            } elseif ($request->module == 3) {
                ClientReferral::chunk(1000, function($clientReferrals) {
                    $this->xmlGenerator->generateClientReferrals($clientReferrals);
                });
                return response()->json([
                    'success' => true,
                    'message' => 'Client Referrals XML file has been scheduled for downloads'
                ], 200);
            } elseif ($request->module == 4) {

                ItemsInventory::chunk(1000, function($itemInventories) {
                    $this->xmlGenerator->generateClientReferrals($clientReferrals);
                });

                InventoryReceived::chunk(1000, function($receivedItems) {
                    $this->xmlGenerator->generateClientReferrals($clientReferrals);
                });

                ItemsDisbursement::chunk(1000, function($itemDisbursements) {
                    $this->xmlGenerator->generateItemDisbursements($itemDisbursements);
                });
                return response()->json([
                    'success' => true,
                    'message' => 'Client Referrals XML file has been scheduled for downloads'
                ], 200);
            } elseif ($request->module == 5) {
                BudgetActivity::chunk(1000, function($budgetActivities) {
                    $this->xmlGenerator->generateBudgetActivities($budgetActivities);
                });

                CashProvision::chunk(1000, function($cashProvisions) {
                    $this->xmlGenerator->generateCashProvisions($cashProvisions);
                });

                PostCashAssessment::chunk(1000, function($postCashAssessments) {
                    $this->xmlGenerator->generatePostCashAssessments($postCashAssessments);
                });
                return response()->json([
                    'success' => true,
                    'message' => 'Client Referrals XML file has been scheduled for downloads'
                ], 200);
            } elseif ($request->module == 6) {
                ClientCase::chunk(1000, function($clientCases) {
                    $this->xmlGenerator->generateClientCases($clientCases);
                });
                ProgressNote::chunk(1000, function($progressNotes) {
                    $this->xmlGenerator->generateProgressNotes($progressNotes);
                });

                return response()->json([
                    'success' => true,
                    'message' => 'Client Referrals XML file has been scheduled for downloads'
                ], 200);
            } else {
                Client::chunk(1000, function($clients) {
                    $this->xmlGenerator->generateClients($clients);
                });

                VulnerabilityAssessment::chunk(1000, function($assessments) {
                    $this->xmlGenerator->generateVulnerabilityAssessments($assessments);
                });
                HomeAssessment::chunk(1000, function($homeAssessments) {
                    $this->xmlGenerator->generateHomeAssessments($homeAssessments);
                });

                ClientReferral::chunk(1000, function($clientReferrals) {
                    $this->xmlGenerator->generateClientReferrals($clientReferrals);
                });

                ItemsInventory::chunk(1000, function($itemInventories) {
                    $this->xmlGenerator->generateClientReferrals($clientReferrals);
                });

                InventoryReceived::chunk(1000, function($receivedItems) {
                    $this->xmlGenerator->generateClientReferrals($clientReferrals);
                });

                ItemsDisbursement::chunk(1000, function($itemDisbursements) {
                    $this->xmlGenerator->generateItemDisbursements($itemDisbursements);
                });

                BudgetActivity::chunk(1000, function($budgetActivities) {
                    $this->xmlGenerator->generateBudgetActivities($budgetActivities);
                });

                CashProvision::chunk(1000, function($cashProvisions) {
                    $this->xmlGenerator->generateCashProvisions($cashProvisions);
                });

                PostCashAssessment::chunk(1000, function($postCashAssessments) {
                    $this->xmlGenerator->generatePostCashAssessments($postCashAssessments);
                });

                ClientCase::chunk(1000, function($clientCases) {
                    $this->xmlGenerator->generateClientCases($clientCases);
                });
                ProgressNote::chunk(1000, function($progressNotes) {
                    $this->xmlGenerator->generateProgressNotes($progressNotes);
                });

                return response()->json([
                    'success' => true,
                    'message' => 'Client Referrals XML file has been scheduled for downloads'
                ], 200);
            }
        }
        catch (\Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage(),
                'success' => false,
            ], 502);
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
        try {
            $this->validate($request, [
                'system_data_file' => 'required',
                'module' => 'required'
            ]);

                $extension = strtolower($request->file('system_data_file')->getClientOriginalExtension());
                if ($extension != "xml" && $extension != "xml") {
                    return redirect()->back()->with('message', 'Invalid file type! allowed only xml')->withInput();
                }
            $file= $request->file('system_data_file');
            $destinationPath = public_path() . '/uploads/temp/';
            $filename   = str_replace(' ', '_', $file->getClientOriginalName());

            $file->move($destinationPath, $filename);
            $requiredFile=$destinationPath.$filename;
            $xml = simplexml_load_file($requiredFile,'SimpleXMLElement',LIBXML_NOCDATA);

            if($request->module =="1") {
                foreach ($xml->Clients as $clients) {
                    foreach ($clients as $clnt) {

						$client_id = $this->ImportClient($clnt);
                    }
                }
            }
            elseif($request->module =="2") {
                foreach ($xml->VulnerabilityAssessments as $vassessments) {
                    foreach ($vassessments as $vassessment) {


						$vulAssessment=$vassessment;
                        $client=$vulAssessment->Client;
                        $vprofile =$vulAssessment->AssessmentHousholdProfile;
                        $veconomic =$vulAssessment->AssessmentEconomicSituation;
                        $vulnerability_type =$vulAssessment->AssessmentVulnerabilityType;
                        $vimpairment =$vulAssessment->AssessmentImpairmentType;
                        $vnutrition =$vulAssessment->AssessmentNutrition;
                        $vparticipation =$vulAssessment->independenceParticipation;
                        $vpsychosocial =$vulAssessment->AssessmentPsychosocial;
                        $vprotection =$vulAssessment->AssessmentProtection;
                        $vneeds=$vulAssessment->ClientNeeds;
                        $client_id="";

                        $client_id=$this->ImportClient($client);


						if(count(VulnerabilityAssessment::where('client_id','=',$client_id)
                                                        ->where('q1_5','=',$vulAssessment->q1_5)
                                ->where('q1_1','=',$vulAssessment->q1_1)
                                ->where('q1_2','=',$vulAssessment->q1_2)
                                ->where('q1_3','=',$vulAssessment->q1_3)
                                ->where('q1_4','=',$vulAssessment->q1_4)->get()) <=0 ){

                            $assessment = new VulnerabilityAssessment;
                            $assessment->client_id = $client_id;
                            $assessment->q1_1 = $vulAssessment->q1_1;
                            $assessment->q1_2 = $vulAssessment->q1_2;
                            $assessment->q1_3 = $vulAssessment->q1_3;
                            $assessment->q1_4 = $vulAssessment->q1_4;
                            $assessment->q1_5 = date("Y-m-d", strtotime($vulAssessment->q1_5));
                            $assessment->comments = $vulAssessment->comments;
                            $assessment->created_by=Auth::user()->username;
                            $assessment->save();

                            $profile = new AssessmentHousholdProfile;
                            $profile->assessment_id = $assessment->id;
                            $profile->q2_1 = $vprofile->q2_1;
                            $profile->q2_2 = $vprofile->q2_2;
                            $profile->q2_3 = $vprofile->q2_3;
                            $profile->q2_4 = $vprofile->q2_4;
                            $profile->q2_5 = $vprofile->q2_5;
                            $profile->q2_6 = $vprofile->q2_6;
                            $profile->q2_7 = $vprofile->q2_7;
                            $profile->q2_8 = $vprofile->q2_8;
                            $profile->q2_9 = $vprofile->q2_9;
                            $profile->q2_10 = $vprofile->q2_10;
                            $profile->q2_11 = $vprofile->q2_11;
                            $profile->q2_12 = $vprofile->q2_12;
                            $profile->q2_13 = $vprofile->q2_13;
                            $profile->q2_14 = $vprofile->q2_14;
                            $profile->save();

                            $economic = new AssessmentEconomicSituation;
                            $economic->assessment_id = $assessment->id;
                            $economic->q3_1 = $veconomic->q3_1;
                            $economic->q3_2 = $veconomic->q3_2;
                            $economic->q3_3 = $veconomic->q3_3;
                            $economic->q3_4 = $veconomic->q3_4;
                            $economic->q3_5 = $veconomic->q3_5;
                            $economic->q3_6 = $veconomic->q3_6;
                            $economic->q3_7 = $veconomic->q3_7;
                            $economic->q3_8 = $veconomic->q3_8;
                            $economic->save();

                            $vulnerability = new AssessmentVulnerabilityType;
                            $vulnerability->assessment_id = $assessment->id;
                            $vulnerability->q4_1 = $vulnerability_type->q4_1;
                            $vulnerability->q4_2 = $vulnerability_type->q4_2;
                            $vulnerability->q4_3 = $vulnerability_type->q4_3;
                            $vulnerability->q4_4 = $vulnerability_type->q4_4;
                            $vulnerability->q4_5 = $vulnerability_type->q4_5;
                            $vulnerability->q4_6 = $vulnerability_type->q4_6;
                            $vulnerability->q4_7 = $vulnerability_type->q4_7;
                            $vulnerability->save();

                            $impairment = new AssessmentImpairmentType;
                            $impairment->assessment_id = $assessment->id;
                            $impairment->q5_1 = $vimpairment->q5_1;
                            $impairment->q5_2 = $vimpairment->q5_2;
                            $impairment->q5_3 = $vimpairment->q5_3;
                            $impairment->q5_4 = $vimpairment->q5_4;
                            $impairment->q5_5 = $vimpairment->q5_5;
                            $impairment->q5_6 = $vimpairment->q5_6;
                            $impairment->q5_7 = $vimpairment->q5_7;
                            $impairment->q5_8 = $vimpairment->q5_8;
                            $impairment->q5_9 = $vimpairment->q5_9;
                            $impairment->q5_10 = $vimpairment->q5_10;
                            $impairment->save();

                            $nutrition = new AssessmentNutrition;
                            $nutrition->assessment_id = $assessment->id;
                            $nutrition->q6_1 = $vnutrition->q6_1;
                            $nutrition->q6_2 = $vnutrition->q6_2;
                            $nutrition->q6_3 = $vnutrition->q6_3;
                            $nutrition->save();

                            $participation = new AssessmentIndependenceParticipation;
                            $participation->assessment_id = $assessment->id;
                            $participation->q7_1 = $vparticipation->q7_1;
                            $participation->q7_2 = $vparticipation->q7_2;
                            $participation->q7_3 = $vparticipation->q7_3;
                            $participation->q7_4 = $vparticipation->q7_4;
                            $participation->q7_5 = $vparticipation->q7_5;
                            $participation->q7_6 = $vparticipation->q7_6;
                            $participation->q7_7 = $vparticipation->q7_7;
                            $participation->q7_8 = $vparticipation->q7_8;
                            $participation->save();

                            $psychosocial = new AssessmentPsychosocial;
                            $psychosocial->assessment_id = $assessment->id;
                            $psychosocial->q8_1 = $vpsychosocial->q8_1;
                            $psychosocial->q8_2 = $vpsychosocial->q8_2;
                            $psychosocial->q8_3 = $vpsychosocial->q8_3;
                            $psychosocial->q8_4 = $vpsychosocial->q8_4;
                            $psychosocial->q8_5 = $vpsychosocial->q8_5;
                            $psychosocial->q8_6 = $vpsychosocial->q8_6;
                            $psychosocial->q8_7 = $vpsychosocial->q8_7;
                            $psychosocial->q8_8 = $vpsychosocial->q8_8;
                            $psychosocial->save();

                            $protection = new AssessmentProtection;
                            $protection->assessment_id = $assessment->id;
                            $protection->q9_1 = $vprotection->q9_1;
                            $protection->q9_2 = $vprotection->q9_2;
                            $protection->q9_3 = $vprotection->q9_3;
                            $protection->q9_4 = $vprotection->q9_4;
                            $protection->q9_5 = $vprotection->q9_5;
                            $protection->q9_6 = $vprotection->q9_6;
                            $protection->q9_7 = $vprotection->q9_7;
                            $protection->q9_8 = $vprotection->q9_8;
                            $protection->save();

                            $need_count=0;
                            foreach ($vneeds as $vneed){

                                $clientNeed=$vneed->ClientNeed;
                                $need=$clientNeed->Need;
                                $category=$clientNeed->Category;
                                $need_category_id="";
                                $need_id="";
                               if(count(NeedCategory::where('category_name','=',$category->category_name)->get()) >0)
                               {
                                   $cat_need=NeedCategory::where('category_name','=',$category->category_name)->get()->first();
                                   $need_category_id=$cat_need->id;
                               }
                               else
                               {
                                   $cat_need=new \App\NeedCategory;
                                   $cat_need->category_name=$category;
                                   $cat_need->save();
                                   $need_category_id=$cat_need->id;
                               }

                                if(count(\App\Need::where('need_name','=',$need->need_name)->get()) >0)
                                {
                                    $cl_need=\App\Need::where('need_name','=',$need->need_name)->get()->first();
                                    $need_id=$cl_need->id;
                                }
                                else
                                {
                                    $ref_need=new \App\Need;
                                    $ref_need->need_name=$need->need_name;
                                    $ref_need->category_id=$need_category_id;
                                    $ref_need->save();
                                }

                                if(count(ClientNeed::where('client_id','=',$assessment->client_id)
                                        ->where('need_id','=',$need_id)
                                        ->where('assessment_id','=',$assessment->id)->get()) <=0) {
                                    $cl_need = new ClientNeed();
                                    $cl_need->need_id = $need_id;
                                    $cl_need->status = $clientNeed->status;
                                    $cl_need->location = $clientNeed->location;
                                    $cl_need->assessment_id = $assessment->id;
                                    $cl_need->client_id = $assessment->client_id;
                                    $cl_need->save();
                                }
                            }
                        }

                    }
                }
                foreach ($xml->HomeAssessments as $homeAssessments) {
                    foreach ($homeAssessments as $homeAssessment) {

						$ha=$homeAssessment;
                        $client_id = $this->ImportClient($ha->Client);

                        if(count(HomeAssessment::where('client_id','=',$client_id)
							                   ->where('assessment_date','=',$ha->assessment_date)
											   ->where('case_code','=',$ha->case_code)
											   ->where('case_worker_name','=',$ha->case_worker_name)
											   ->where('organization','=',$ha->organization)
											   ->where('project_coordinator','=',$ha->project_coordinator)->get()) <=0)
						{

						$assessment = new HomeAssessment;
                        $assessment->client_id = $client_id;
                        $assessment->case_code = $ha->case_code;
                        $assessment->linked_case_code = $ha->Linked_case_code;
                        $assessment->assessment_date = $ha->assessment_date;
                        $assessment->needs_description = $ha->needs_description;
                        $assessment->findings = $ha->findings;
                        $assessment->diagnosis = $ha->diagnosis;
                        $assessment->recommendations = $ha->recommendations;
                        $assessment->final_decision = $ha->final_decision;
                        $assessment->case_worker_name = $ha->case_worker_name;
                        $assessment->project_coordinator = $ha->project_coordinator;
                        $assessment->organization = $ha->organization;
                        $assessment->created_by = $ha->created_by;
                        $assessment->updated_by = $ha->updated_by;
                        $assessment->save();
						}
                    }
                }

            }
            elseif($request->module =="3") {
                foreach ($xml->ClientReferrals as $clientReferrals) {
                    foreach ($clientReferrals as $clientReferral) {
                        $cl_referral = $clientReferral;
                        $client_id = $this->ImportClient($cl_referral->Client);
                        $receivingAgency = $cl_referral->ReceivingAgency;
                        $referringAgency = $cl_referral->ReferringAgency;
                        $clientInformation = $cl_referral->ClientInformation;
                        $referralReason = $cl_referral->ReferralReason;
                        $referralServiceRequested = $cl_referral->ReferralServiceRequested;

                        if (!count(ClientReferral::where('client_id', '=', $client_id)
                                ->where('referral_type', '=', $cl_referral->referral_type)
                                ->where('referral_date', '=', $cl_referral->referral_date)
                                ->where('status', '=', $cl_referral->status)
                                ->where('created_by', '=', $cl_referral->created_by)
                                ->get()) > 0)
                        {

							$referral = new ClientReferral;
                            $referral->client_id = $client_id;
                            $referral->referral_type = $cl_referral->referral_type;
                            $referral->referral_date = $cl_referral->referral_date;
                            $referral->created_by = $cl_referral->created_by;
                            $referral->status = $cl_referral->status;
                            $referral->updated_by = $cl_referral->updated_by;

                            $referral->save();

                            //Create references
                            $referral->reference_no = "HAI/" . date("Y") . "/RF-" . str_pad($referral->id, 4, '0', STR_PAD_LEFT);
                            $referral->save();

                            $ref_agency = new ReferringAgency();
                            $ref_agency->referral_id = $referral->id;
                            $ref_agency->ref_organisation = $referringAgency->ref_organisation;
                            $ref_agency->ref_phone = $referringAgency->ref_phone;
                            $ref_agency->ref_contact = $referringAgency->ref_contact;
                            $ref_agency->ref_email = $referringAgency->ref_email;
                            $ref_agency->ref_location = $referringAgency->ref_location;
                            $ref_agency->save();

                            $agency = new ReceivingAgency();
                            $agency->referral_id = $referral->id;
                            $agency->rec_organisation = $receivingAgency->rec_organisation;
                            $agency->rec_phone = $receivingAgency->rec_phone;
                            $agency->rec_contact = $receivingAgency->rec_contact;
                            $agency->rec_email = $receivingAgency->rec_email;
                            $agency->rec_location = $receivingAgency->rec_location;
                            $agency->save();

                            $client = new ClientInformation();
                            $client->referral_id = $referral->id;
                            $client->cl_name = $clientInformation->cl_name;
                            $client->cl_address = $clientInformation->cl_address;
                            $client->cl_phone = $clientInformation->cl_phone;
                            $client->cl_age = $clientInformation->cl_age;
                            $client->cl_sex = $clientInformation->cl_sex;
                            $client->cl_nationality = $clientInformation->cl_nationality;
                            $client->cl_language = $clientInformation->cl_language;
                            $client->cl_id_number = $clientInformation->cl_id_number;
                            $client->cl_care_giver = $clientInformation->cl_care_giver;
                            $client->cl_care_giver_relationship = $clientInformation->cl_care_giver_relationship;
                            $client->cl_care_giver_contact = $clientInformation->cl_care_giver_contact;
                            $client->cl_child_separated = $clientInformation->cl_child_separated;
                            $client->cl_care_giver_informed = $clientInformation->cl_care_giver_informed;
                            $client->save();

                            $reason = new ReferralReason();
                            $reason->referral_id = $referral->id;
                            $reason->client_referral_info = $referralReason->client_referral_info;
                            $reason->client_referral_status = $referralReason->client_referral_status;
                            $reason->client_referral_info_text = $referralReason->client_referral_info_text;
                            $reason->client_referral_status_text = $referralReason->client_referral_status_text;
                            $reason->save();

                            $service = new ReferralServiceRequested();
                            $service->referral_id = $referral->id;
                            $service->comments = $referralServiceRequested->comments;
                            $service->save();


                            foreach ($referralServiceRequested->RequestedServicies->RequestedService as $service_req)
							{

                                $servicereq = new RequestedService();
                                $servicereq->requested_id = $service->id;
                                $servicereq->service_request = $service_req->service_request;
                                $servicereq->save();
                            }
							exit;

                        }
                    }
                }

            }
            elseif($request->module =="4") {
                foreach ($xml->ItemsInventories as $itemsInventories) {
                    foreach ($itemsInventories as $itemsInventory) {

                        $item_id= $this->ImportInventoryItem($itemsInventory);
                    }
                }
                foreach ($xml->InventoriesReceived as $InventoriesReceived) {
                    foreach ($InventoriesReceived as $inventory_received) {



                        if(count(InventoryReceived::where('reference_number','=',$inventory_received->reference_number)
                                ->where('donor_ref','=',$inventory_received->donor_ref)
                                ->where('received_from','=',$inventory_received->received_from)
                                ->where('receiving_officer','=',$inventory_received->receiving_officer)
                                ->where('project','=',$inventory_received->project)
                                ->where('date_received','=',date("Y-m-d",strtotime($inventory_received->date_received)))->get()) <= 0)
                        {

                            $inventoryReceived = new InventoryReceived;
                            $inventoryReceived->reference_number = $inventory_received->reference_number;
                            $inventoryReceived->date_received = date("Y-m-d", strtotime($inventory_received->date_received));
                            $inventoryReceived->donor_ref = $inventory_received->donor_ref;
                            $inventoryReceived->received_from = $inventory_received->received_from;
                            $inventoryReceived->receiving_officer = $inventory_received->receiving_officer;
                            $inventoryReceived->project = $inventory_received->project;
                            $inventoryReceived->onward_delivery = $inventory_received->onward_delivery;
                            $inventoryReceived->comments = $inventory_received->comments;
                            $inventoryReceived->created_by = $inventory_received->created_by;
                            $inventoryReceived->save();

                            foreach($inventory_received->ItemsReceived->ItemReceived as $item)
                            {

                                $itemReceived=$item;
                                $item_id= $this->ImportInventoryItem($itemReceived->ItemsInventory);

                                if (count(ItemReceived::where('received_id','=',$itemReceived->id)
                                        ->where('item_id','=',$item_id)
                                        ->where('quantity','=',$itemReceived->quantity)
                                        ->where('description','=',$itemReceived->description)->get()) <= 0) {
                                    $tmreceived = new ItemReceived;
                                    $tmreceived->received_id = $inventoryReceived->id;
                                    $tmreceived->item_id = $item_id;
                                    $tmreceived->quantity = intval($itemReceived->quantity);
                                    $tmreceived->description = $itemReceived->description;
                                    $tmreceived->save();

                                    //Increase inventory
                                    $invItem=ItemsInventory::find($item_id);
                                    $invItem->quantity = intval($invItem->quantity) + intval($itemReceived->quantity);
                                    $invItem->status = "Available";
                                    $invItem->save();
                                }

                            }
                        }
                    }
                }
                foreach ($xml->ItemsDisbursements as $itemsDisbursements) {
                    foreach ($itemsDisbursements as $itemDisbursement) {


                        $camp_id=$this->ImportCamp($itemDisbursement->Camp);

                        if(count(ItemsDisbursement::where('disbursements_date','=',date('Y-m-d', strtotime($itemDisbursement->disbursements_date)))
                                ->where('disbursements_by','=',ucwords(strtolower($itemDisbursement->disbursements_by)))
                                ->where('camp_id','=',$camp_id)
                                ->where('comments','=',$itemDisbursement->comments)->get()) <=0 )
                        {
                            $distribution = new ItemsDisbursement;
                            $distribution->disbursements_date = date('Y-m-d', strtotime($itemDisbursement->disbursements_date));
                            $distribution->camp_id =  $camp_id;
                            $distribution->comments = $itemDisbursement->comments;
                            $distribution->disbursements_by = ucwords(strtolower($itemDisbursement->disbursements_by));
                            $distribution->save();

                            foreach ($itemDisbursement->ItemsDisbursementItems->ItemsDisbursementItem as $itemsDisbursementItem)
                            {


                                $client_id=$this->ImportClient($itemsDisbursementItem->Client);
                                $item_id= $this->ImportInventoryItem($itemsDisbursementItem->ItemsInventory);

                                if (count(ItemsDisbursementItems::where('item_id', '=', $item_id)
                                        ->where('distribution_id', '=', $distribution->id)
                                        ->where('client_id', '=', $client_id)
                                        ->where('distribution_date', '=', $itemsDisbursementItem->distribution_date)
                                        ->where('quantity', '=', $itemsDisbursementItem->quantity)->get()) <=0
                                ) {
                                    $dist_items = new ItemsDisbursementItems;
                                    $dist_items->client_id = $client_id;
                                    $dist_items->item_id = $item_id;
                                    $dist_items->quantity = $itemsDisbursementItem->quantity;
                                    $dist_items->distribution_id = $distribution->id;
                                    $dist_items->distribution_date = $itemsDisbursementItem->distribution_date;
                                    $dist_items->save();
                                    if (!isItemOutOfStock($item_id,intval($itemsDisbursementItem->quantity))) {
                                        deductItems($item_id,intval($itemsDisbursementItem->quantity));
                                    }
                                }
                            }


                        }
                    }
                }
            }
            elseif($request->module =="5") {

                foreach ($xml->BudgetActivities as $budgetActivities) {
                    foreach ($budgetActivities as $b_activity) {


                        $activity_id=$this->ImportActivity($b_activity);
                    }
                }


                foreach ($xml->CashProvisions as $cashProvisions) {
                    foreach ($cashProvisions as $cashProvision) {




                        $activity_id=$this->ImportActivity($cashProvision->BudgetActivity);
                            $camp_id=$this->ImportCamp($cashProvision->Camp);


                            if(!count(CashProvision::where('provision_date','=',$cashProvision->provision_date)
                                    ->where('camp_id','=',$camp_id)
                                    ->where('activity_id','=',$activity_id)
                                    ->where('provided_by','=',$cashProvision->provided_by)->get()) > 0)
                            {
                                $provision = new CashProvision;
                                $provision->provision_date = $cashProvision->provision_date;
                                $provision->provided_by = $cashProvision->provided_by;
                                $provision->comments = $cashProvision->comments;
                                $provision->camp_id = $camp_id;
                                $provision->created_by = $cashProvision->created_by;
                                $provision->activity_id = $activity_id;
                                $provision->save();


                            }
                            else
                            {
                                $provision = CashProvision::where('provision_date','=',$cashProvision->provision_date)
                                    ->where('camp_id','=',$camp_id)
                                    ->where('activity_id','=',$activity_id)
                                    ->where('provided_by','=',$cashProvision->provided_by)->get()->first();
                            }
                            if(count($provision) >0 && $provision != null)
                            {
                                foreach ($cashProvision->CashProvisionClients->CashProvisionClient as $cashProvisionClient) {


                                    $client_id = $this->ImportClient($cashProvisionClient->Client);



                                    if (count(CashProvisionClient::where('client_id','=',$client_id)
                                            ->where('activity_id','=',$provision->activity_id)
                                            ->where('amount','=',$cashProvisionClient->amount)
                                            ->where('provision_id','=',$provision->id)
                                            ->where('provision_date','=',$provision->provision_date)->get()) <=0 )
                                    {
                                        $provision_client = new CashProvisionClient;
                                        $provision_client->client_id = $client_id;
                                        $provision_client->activity_id = $provision->activity_id;
                                        $provision_client->amount = $cashProvisionClient->amount;
                                        $provision_client->provision_id = $provision->id;
                                        $provision_client->provision_date = $provision->provision_date;
                                        $provision_client->save();


                                    }
                                }
                            }



                    }
                }
                foreach ($xml->PostCashAssessments as $postCashAssessments) {
                    foreach ($postCashAssessments as $post_cash_assessment) {


                        $client_id=$this->ImportClient($post_cash_assessment->Client);
                        $camp_id=$this->ImportCamp($post_cash_assessment->Camp);
                        $district_id="";
                        $region_id="";
                        $pm_district=$post_cash_assessment->District;
                        $pm_region=$pm_district->Region;

                        $country=Country::where('country_name','LIKE','%anzani%')->get()->first();
                        if(count(Region::where('region_name','=',ucwords($pm_region->region_name))
                                ->where('country_id','=',$country->id)->get()) >0){
                            $region = Region::where('region_name','=',ucwords($pm_region->region_name))
                                ->where('country_id','=',$country->id)->get()->first();

                            $region_id=$region->id;
                        }
                        else {
                            $region=new Region;
                            $region->region_name =ucwords($pm_region->region_name);
                            $region->country_id =$country->id;
                            $region->created_by =Auth::user()->username;
                            $region->save();
                            $region_id=$region->id;
                        }
                        if(count(District::where('district_name','=',ucwords($pm_district->district_name))
                                ->where('region_id','=',$region_id)->get()) >0){
                            $district = District::where('district_name','=',ucwords($pm_district->district_name))
                                ->where('region_id','=',$region_id)->get()->first();
                            $district_id=$district->id;
                        }
                        else {
                            $district = new District;
                            $district->district_name = ucwords($pm_district->district_name);
                            $district->region_id = $region_id;
                            $district->created_by = Auth::user()->username;
                            $district->save();
                            $district_id=$district->id;
                        }

                        $pCDemographicDetails=$post_cash_assessment->PCDemographicDetails;
                        $pCCashWithdrawal=$post_cash_assessment->PCCashWithdrawal;
                        $pCPhysicallyReceivingCash=$post_cash_assessment->PCPhysicallyReceivingCash;
                        $pCCommunalRelations=$post_cash_assessment->PCCommunalRelations;
                        $pCCashUsage=$post_cash_assessment->PCCashUsage;
                   if(count(PostCashAssessment::where('client_id','=',$client_id)->where('camp_id','=',$camp_id)
                           ->where('interview_date','=',$post_cash_assessment->interview_date)
                           ->where('interview_start_time','=',$post_cash_assessment->interview_start_time)
                           ->where('interview_end_time','=',$post_cash_assessment->interview_end_time)
                           ->where('organisation','=',$post_cash_assessment->organisation)
                           ->where('enumerator_name','=',$post_cash_assessment->enumerator_name)
                           ->where('respondent_name','=',$post_cash_assessment->respondent_name)->get()) <=0 ) {

                       $assessment = new PostCashAssessment;
                       $assessment->client_id = $client_id;
                       $assessment->camp_id = $camp_id;
                       $assessment->district_id = $district_id;
                       $assessment->interview_date = $post_cash_assessment->interview_date;
                       $assessment->interview_start_time = $post_cash_assessment->interview_start_time;
                       $assessment->interview_end_time = $post_cash_assessment->interview_end_time;
                       $assessment->organisation = $post_cash_assessment->organisation;
                       $assessment->enumerator_name = $post_cash_assessment->enumerator_name;
                       $assessment->respondent_name = $post_cash_assessment->respondent_name;
                       $assessment->enumerator_observations = $post_cash_assessment->enumerator_observations;
                       $assessment->created_by = Auth::user()->username;
                       $assessment->save();

                       $domographic = new PCDemographicDetails;
                       $domographic->assessment_id = $assessment->id;
                       $domographic->q2_1 = $pCDemographicDetails->q2_1;
                       $domographic->q2_2 = $pCDemographicDetails->q2_2;
                       $domographic->q2_3 = $pCDemographicDetails->q2_3;
                       $domographic->q2_4 = $pCDemographicDetails->q2_4;
                       $domographic->q2_5 = $pCDemographicDetails->q2_5;
                       $domographic->q2_6 = $pCDemographicDetails->q2_6;
                       $domographic->q2_7 = $pCDemographicDetails->q2_7;
                       $domographic->q2_8 = $pCDemographicDetails->q2_8;
                       $domographic->save();

                       $withdraw = new PCCashWithdrawal;
                       $withdraw->assessment_id = $assessment->id;
                       $withdraw->q3_1 = $pCCashWithdrawal->q3_1;
                       $withdraw->q3_2 = $pCCashWithdrawal->q3_2;
                       $withdraw->q3_3 = $pCCashWithdrawal->q3_3;
                       $withdraw->q3_4 = $pCCashWithdrawal->q3_4;
                       $withdraw->q3_5 = $pCCashWithdrawal->q3_5;
                       $withdraw->q3_6 = $pCCashWithdrawal->q3_6;
                       $withdraw->save();


                       $physical_receiving = new PCPhysicallyReceivingCash;
                       $physical_receiving->assessment_id = $assessment->id;
                       $physical_receiving->q4_1 = $pCPhysicallyReceivingCash->q4_1;
                       $physical_receiving->q4_2 = $pCPhysicallyReceivingCash->q4_2;
                       $physical_receiving->q4_3 = $pCPhysicallyReceivingCash->q4_3;
                       $physical_receiving->q4_4 = $pCPhysicallyReceivingCash->q4_4;
                       $physical_receiving->q4_5 = $pCPhysicallyReceivingCash->q4_5;
                       $physical_receiving->q4_6 = $pCPhysicallyReceivingCash->q4_6;
                       $physical_receiving->q4_7 = $pCPhysicallyReceivingCash->q4_7;
                       $physical_receiving->q4_8 = $pCPhysicallyReceivingCash->q4_8;
                       $physical_receiving->q4_9 = $pCPhysicallyReceivingCash->q4_9;
                       $physical_receiving->q4_10 = $pCPhysicallyReceivingCash->q4_10;
                       $physical_receiving->q4_10_1 = $pCPhysicallyReceivingCash->q4_10_1;
                       $physical_receiving->q4_11 = $pCPhysicallyReceivingCash->q4_11;
                       $physical_receiving->q4_12 = $pCPhysicallyReceivingCash->q4_12;
                       $physical_receiving->q4_13 = $pCPhysicallyReceivingCash->q4_13;
                       $physical_receiving->q4_14 = $pCPhysicallyReceivingCash->q4_14;
                       $physical_receiving->q4_15 = $pCPhysicallyReceivingCash->q4_15;
                       $physical_receiving->q4_16 = $pCPhysicallyReceivingCash->q4_16;
                       $physical_receiving->q4_17 = $pCPhysicallyReceivingCash->q4_17;
                       $physical_receiving->q4_18 = $pCPhysicallyReceivingCash->q4_18;
                       $physical_receiving->q4_19 = $pCPhysicallyReceivingCash->q4_19;
                       $physical_receiving->q4_20 = $pCPhysicallyReceivingCash->q4_20;
                       $physical_receiving->q4_21 = $pCPhysicallyReceivingCash->q4_21;
                       $physical_receiving->q4_22 = $pCPhysicallyReceivingCash->q4_22;
                       $physical_receiving->save();




                       $communal_relation = new PCCommunalRelations;
                       $communal_relation->assessment_id = $assessment->id;
                       $communal_relation->q5_1 = $request->q5_1;
                       $communal_relation->q5_2 = $pCCommunalRelations->q5_2;
                       $communal_relation->q5_3 = $pCCommunalRelations->q5_3;
                       $communal_relation->q5_4 = $pCCommunalRelations->q5_4;
                       $communal_relation->q5_5 = $pCCommunalRelations->q5_5;
                       $communal_relation->q5_6 = $pCCommunalRelations->q5_6;
                       $communal_relation->save();


                       $cash_usage = new PCCashUsage;
                       $cash_usage->assessment_id = $assessment->id;
                       $cash_usage->q6_1 = $pCCashUsage->q6_1;
                       $cash_usage->q6_2 = $pCCashUsage->q6_2;
                       $cash_usage->q6_3 = $pCCashUsage->q6_3;
                       $cash_usage->q6_4 = $pCCashUsage->q6_4;
                       $cash_usage->save();


                       foreach ($pCCashUsage->PCCashUsageCategories as $cashUsageCategory) {

                           $pc_usage_category=$cashUsageCategory->PCCashUsageCategory;
                           $usage_category_id="";
                           $pCCategory=$pc_usage_category->PCCategories;
                           if(count(PCCategories::where('category_name','=',$pCCategory->category_name)->get()) >0)
                           {
                               $ucaategory=PCCategories::where('category_name','=',$pCCategory->category_name)->get()->first();
                               $usage_category_id=$ucaategory->id;
                           }
                           else
                           {
                               $ucaategory=new PCCategories;
                               $ucaategory->category_name=$pCCategory->category_name;
                               $ucaategory->save();
                               $usage_category_id=$ucaategory->id;
                           }
                           $usage_category = new PCCashUsageCategory;
                           $usage_category->usage_id = $cash_usage->id;
                           $usage_category->category_id = $usage_category_id;
                           $usage_category->currency = $pc_usage_category->currency;
                           $usage_category->save();
                       }
                   }

                    }
                }
            }
            elseif($request->module =="6") {

                foreach ($xml->ClientCases as $clientCases)
				{
                    foreach ($clientCases as $c_case) {

                        $client_id=$this->ImportClient($c_case->Client);
                        $camp_id=$this->ImportCamp($c_case->Camp);

                        if(count(ClientCase::where('open_date','=',date("Y-m-d", strtotime($c_case->open_date)))
                                ->where('case_type','=',$c_case->case_type)
                                ->where('client_id','=',$client_id)
                                ->where('status','=',$c_case->status)
                                ->where('camp_id','=',$camp_id)
                                ->where('case_worker_name','=',$c_case->case_worker_name)
                                ->where('created_by','=',$c_case->created_by)->get()) <=0)
                        {
                            $case = new ClientCase;
                            $case->open_date = date("Y-m-d", strtotime($c_case->open_date));
                            $case->case_type = $c_case->case_type;
                            $case->descriptions = $c_case->descriptions;
                            $case->initial_action = $c_case->initial_action;
                            $case->feedback = $c_case->feedback;
                            $case->planning = $c_case->planning;
                            $case->case_worker_name = $c_case->case_worker_name;
                            $case->status = $c_case->status;
                            $case->created_by = Auth::user()->id;
                            $case->camp_id = $camp_id;
                            $case->client_id = $client_id;
                            $case->save();
                        }

                    }
                }
				foreach ($xml->ProgressNotes as $progressNotes)
                {
                    foreach ($progressNotes as $p_note)
                    {

                        $client_id=$this->ImportClient($p_note->Client);
                        $camp_id=$this->ImportCamp($p_note->Camp);

                        if(count(ProgressNote::where('open_date','=',$p_note->open_date)
                                ->where('status','=',$p_note->status)
                                ->where('created_by','=',$p_note->created_by)
                                ->where('camp_id','=',$camp_id)
                                ->where('client_id','=',$client_id)->get()) <=0)
                        {
                            $note = new ProgressNote;
                            $note->open_date = date('Y-m-d',strtotime($p_note->open_date));
                            $note->subjective_information = $p_note->subjective_information;
                            $note->objective_information = $p_note->objective_information;
                            $note->analysis = $p_note->analysis;
                            $note->planning = $p_note->planning;
                            $note->case_worker_name = $p_note->case_worker_name;
                            $note->status = $p_note->status;
                            $note->created_by = $p_note->created_by;
                            $note->camp_id= $camp_id;
                            $note->client_id = $client_id;
                            $note->save();
                        }

                    }
                }
            }
			else
			{
                foreach ($xml->Clients as $clients) {
                    foreach ($clients as $clnt) {

                        $client_id = $this->ImportClient($clnt);
                    }
                }
                //2

                foreach ($xml->VulnerabilityAssessments as $vassessments) {
                    foreach ($vassessments as $vassessment) {


                        $vulAssessment=$vassessment;
                        $client=$vulAssessment->Client;
                        $vprofile =$vulAssessment->AssessmentHousholdProfile;
                        $veconomic =$vulAssessment->AssessmentEconomicSituation;
                        $vulnerability_type =$vulAssessment->AssessmentVulnerabilityType;
                        $vimpairment =$vulAssessment->AssessmentImpairmentType;
                        $vnutrition =$vulAssessment->AssessmentNutrition;
                        $vparticipation =$vulAssessment->independenceParticipation;
                        $vpsychosocial =$vulAssessment->AssessmentPsychosocial;
                        $vprotection =$vulAssessment->AssessmentProtection;
                        $vneeds=$vulAssessment->ClientNeeds;
                        $client_id="";

                        $client_id=$this->ImportClient($client);


                        if(count(VulnerabilityAssessment::where('client_id','=',$client_id)
                                ->where('q1_5','=',$vulAssessment->q1_5)
                                ->where('q1_1','=',$vulAssessment->q1_1)
                                ->where('q1_2','=',$vulAssessment->q1_2)
                                ->where('q1_3','=',$vulAssessment->q1_3)
                                ->where('q1_4','=',$vulAssessment->q1_4)->get()) <=0 ){

                            $assessment = new VulnerabilityAssessment;
                            $assessment->client_id = $client_id;
                            $assessment->q1_1 = $vulAssessment->q1_1;
                            $assessment->q1_2 = $vulAssessment->q1_2;
                            $assessment->q1_3 = $vulAssessment->q1_3;
                            $assessment->q1_4 = $vulAssessment->q1_4;
                            $assessment->q1_5 = date("Y-m-d", strtotime($vulAssessment->q1_5));
                            $assessment->comments = $vulAssessment->comments;
                            $assessment->created_by=Auth::user()->username;
                            $assessment->save();

                            $profile = new AssessmentHousholdProfile;
                            $profile->assessment_id = $assessment->id;
                            $profile->q2_1 = $vprofile->q2_1;
                            $profile->q2_2 = $vprofile->q2_2;
                            $profile->q2_3 = $vprofile->q2_3;
                            $profile->q2_4 = $vprofile->q2_4;
                            $profile->q2_5 = $vprofile->q2_5;
                            $profile->q2_6 = $vprofile->q2_6;
                            $profile->q2_7 = $vprofile->q2_7;
                            $profile->q2_8 = $vprofile->q2_8;
                            $profile->q2_9 = $vprofile->q2_9;
                            $profile->q2_10 = $vprofile->q2_10;
                            $profile->q2_11 = $vprofile->q2_11;
                            $profile->q2_12 = $vprofile->q2_12;
                            $profile->q2_13 = $vprofile->q2_13;
                            $profile->q2_14 = $vprofile->q2_14;
                            $profile->save();

                            $economic = new AssessmentEconomicSituation;
                            $economic->assessment_id = $assessment->id;
                            $economic->q3_1 = $veconomic->q3_1;
                            $economic->q3_2 = $veconomic->q3_2;
                            $economic->q3_3 = $veconomic->q3_3;
                            $economic->q3_4 = $veconomic->q3_4;
                            $economic->q3_5 = $veconomic->q3_5;
                            $economic->q3_6 = $veconomic->q3_6;
                            $economic->q3_7 = $veconomic->q3_7;
                            $economic->q3_8 = $veconomic->q3_8;
                            $economic->save();

                            $vulnerability = new AssessmentVulnerabilityType;
                            $vulnerability->assessment_id = $assessment->id;
                            $vulnerability->q4_1 = $vulnerability_type->q4_1;
                            $vulnerability->q4_2 = $vulnerability_type->q4_2;
                            $vulnerability->q4_3 = $vulnerability_type->q4_3;
                            $vulnerability->q4_4 = $vulnerability_type->q4_4;
                            $vulnerability->q4_5 = $vulnerability_type->q4_5;
                            $vulnerability->q4_6 = $vulnerability_type->q4_6;
                            $vulnerability->q4_7 = $vulnerability_type->q4_7;
                            $vulnerability->save();

                            $impairment = new AssessmentImpairmentType;
                            $impairment->assessment_id = $assessment->id;
                            $impairment->q5_1 = $vimpairment->q5_1;
                            $impairment->q5_2 = $vimpairment->q5_2;
                            $impairment->q5_3 = $vimpairment->q5_3;
                            $impairment->q5_4 = $vimpairment->q5_4;
                            $impairment->q5_5 = $vimpairment->q5_5;
                            $impairment->q5_6 = $vimpairment->q5_6;
                            $impairment->q5_7 = $vimpairment->q5_7;
                            $impairment->q5_8 = $vimpairment->q5_8;
                            $impairment->q5_9 = $vimpairment->q5_9;
                            $impairment->q5_10 = $vimpairment->q5_10;
                            $impairment->save();

                            $nutrition = new AssessmentNutrition;
                            $nutrition->assessment_id = $assessment->id;
                            $nutrition->q6_1 = $vnutrition->q6_1;
                            $nutrition->q6_2 = $vnutrition->q6_2;
                            $nutrition->q6_3 = $vnutrition->q6_3;
                            $nutrition->save();

                            $participation = new AssessmentIndependenceParticipation;
                            $participation->assessment_id = $assessment->id;
                            $participation->q7_1 = $vparticipation->q7_1;
                            $participation->q7_2 = $vparticipation->q7_2;
                            $participation->q7_3 = $vparticipation->q7_3;
                            $participation->q7_4 = $vparticipation->q7_4;
                            $participation->q7_5 = $vparticipation->q7_5;
                            $participation->q7_6 = $vparticipation->q7_6;
                            $participation->q7_7 = $vparticipation->q7_7;
                            $participation->q7_8 = $vparticipation->q7_8;
                            $participation->save();

                            $psychosocial = new AssessmentPsychosocial;
                            $psychosocial->assessment_id = $assessment->id;
                            $psychosocial->q8_1 = $vpsychosocial->q8_1;
                            $psychosocial->q8_2 = $vpsychosocial->q8_2;
                            $psychosocial->q8_3 = $vpsychosocial->q8_3;
                            $psychosocial->q8_4 = $vpsychosocial->q8_4;
                            $psychosocial->q8_5 = $vpsychosocial->q8_5;
                            $psychosocial->q8_6 = $vpsychosocial->q8_6;
                            $psychosocial->q8_7 = $vpsychosocial->q8_7;
                            $psychosocial->q8_8 = $vpsychosocial->q8_8;
                            $psychosocial->save();

                            $protection = new AssessmentProtection;
                            $protection->assessment_id = $assessment->id;
                            $protection->q9_1 = $vprotection->q9_1;
                            $protection->q9_2 = $vprotection->q9_2;
                            $protection->q9_3 = $vprotection->q9_3;
                            $protection->q9_4 = $vprotection->q9_4;
                            $protection->q9_5 = $vprotection->q9_5;
                            $protection->q9_6 = $vprotection->q9_6;
                            $protection->q9_7 = $vprotection->q9_7;
                            $protection->q9_8 = $vprotection->q9_8;
                            $protection->save();

                            $need_count=0;
                            foreach ($vneeds as $vneed){

                                $clientNeed=$vneed->ClientNeed;
                                $need=$clientNeed->Need;
                                $category=$clientNeed->Category;
                                $need_category_id="";
                                $need_id="";
                                if(count(NeedCategory::where('category_name','=',$category->category_name)->get()) >0)
                                {
                                    $cat_need=NeedCategory::where('category_name','=',$category->category_name)->get()->first();
                                    $need_category_id=$cat_need->id;
                                }
                                else
                                {
                                    $cat_need=new \App\NeedCategory;
                                    $cat_need->category_name=$category;
                                    $cat_need->save();
                                    $need_category_id=$cat_need->id;
                                }

                                if(count(\App\Need::where('need_name','=',$need->need_name)->get()) >0)
                                {
                                    $cl_need=\App\Need::where('need_name','=',$need->need_name)->get()->first();
                                    $need_id=$cl_need->id;
                                }
                                else
                                {
                                    $ref_need=new \App\Need;
                                    $ref_need->need_name=$need->need_name;
                                    $ref_need->category_id=$need_category_id;
                                    $ref_need->save();
                                }

                                if(count(ClientNeed::where('client_id','=',$assessment->client_id)
                                        ->where('need_id','=',$need_id)
                                        ->where('assessment_id','=',$assessment->id)->get()) <=0) {
                                    $cl_need = new ClientNeed();
                                    $cl_need->need_id = $need_id;
                                    $cl_need->status = $clientNeed->status;
                                    $cl_need->location = $clientNeed->location;
                                    $cl_need->assessment_id = $assessment->id;
                                    $cl_need->client_id = $assessment->client_id;
                                    $cl_need->save();
                                }
                            }
                        }

                    }
                }
                foreach ($xml->HomeAssessments as $homeAssessments) {
                    foreach ($homeAssessments as $homeAssessment) {

                        $ha=$homeAssessment;
                        $client_id = $this->ImportClient($ha->Client);

                        if(count(HomeAssessment::where('client_id','=',$client_id)
                                ->where('assessment_date','=',$ha->assessment_date)
                                ->where('case_code','=',$ha->case_code)
                                ->where('case_worker_name','=',$ha->case_worker_name)
                                ->where('organization','=',$ha->organization)
                                ->where('project_coordinator','=',$ha->project_coordinator)->get()) <=0)
                        {

                            $assessment = new HomeAssessment;
                            $assessment->client_id = $client_id;
                            $assessment->case_code = $ha->case_code;
                            $assessment->linked_case_code = $ha->Linked_case_code;
                            $assessment->assessment_date = $ha->assessment_date;
                            $assessment->needs_description = $ha->needs_description;
                            $assessment->findings = $ha->findings;
                            $assessment->diagnosis = $ha->diagnosis;
                            $assessment->recommendations = $ha->recommendations;
                            $assessment->final_decision = $ha->final_decision;
                            $assessment->case_worker_name = $ha->case_worker_name;
                            $assessment->project_coordinator = $ha->project_coordinator;
                            $assessment->organization = $ha->organization;
                            $assessment->created_by = $ha->created_by;
                            $assessment->updated_by = $ha->updated_by;
                            $assessment->save();
                        }
                    }
                }
                //3
                foreach ($xml->ClientReferrals as $clientReferrals) {
                    foreach ($clientReferrals as $clientReferral) {
                        $cl_referral = $clientReferral;
                        $client_id = $this->ImportClient($cl_referral->Client);
                        $receivingAgency = $cl_referral->ReceivingAgency;
                        $referringAgency = $cl_referral->ReferringAgency;
                        $clientInformation = $cl_referral->ClientInformation;
                        $referralReason = $cl_referral->ReferralReason;
                        $referralServiceRequested = $cl_referral->ReferralServiceRequested;

                        if (!count(ClientReferral::where('client_id', '=', $client_id)
                                ->where('referral_type', '=', $cl_referral->referral_type)
                                ->where('referral_date', '=', $cl_referral->referral_date)
                                ->where('status', '=', $cl_referral->status)
                                ->where('created_by', '=', $cl_referral->created_by)
                                ->get()) > 0)
                        {

                            $referral = new ClientReferral;
                            $referral->client_id = $client_id;
                            $referral->referral_type = $cl_referral->referral_type;
                            $referral->referral_date = $cl_referral->referral_date;
                            $referral->created_by = $cl_referral->created_by;
                            $referral->status = $cl_referral->status;
                            $referral->updated_by = $cl_referral->updated_by;

                            $referral->save();

                            //Create references
                            $referral->reference_no = "HAI/" . date("Y") . "/RF-" . str_pad($referral->id, 4, '0', STR_PAD_LEFT);
                            $referral->save();

                            $ref_agency = new ReferringAgency();
                            $ref_agency->referral_id = $referral->id;
                            $ref_agency->ref_organisation = $referringAgency->ref_organisation;
                            $ref_agency->ref_phone = $referringAgency->ref_phone;
                            $ref_agency->ref_contact = $referringAgency->ref_contact;
                            $ref_agency->ref_email = $referringAgency->ref_email;
                            $ref_agency->ref_location = $referringAgency->ref_location;
                            $ref_agency->save();

                            $agency = new ReceivingAgency();
                            $agency->referral_id = $referral->id;
                            $agency->rec_organisation = $receivingAgency->rec_organisation;
                            $agency->rec_phone = $receivingAgency->rec_phone;
                            $agency->rec_contact = $receivingAgency->rec_contact;
                            $agency->rec_email = $receivingAgency->rec_email;
                            $agency->rec_location = $receivingAgency->rec_location;
                            $agency->save();

                            $client = new ClientInformation();
                            $client->referral_id = $referral->id;
                            $client->cl_name = $clientInformation->cl_name;
                            $client->cl_address = $clientInformation->cl_address;
                            $client->cl_phone = $clientInformation->cl_phone;
                            $client->cl_age = $clientInformation->cl_age;
                            $client->cl_sex = $clientInformation->cl_sex;
                            $client->cl_nationality = $clientInformation->cl_nationality;
                            $client->cl_language = $clientInformation->cl_language;
                            $client->cl_id_number = $clientInformation->cl_id_number;
                            $client->cl_care_giver = $clientInformation->cl_care_giver;
                            $client->cl_care_giver_relationship = $clientInformation->cl_care_giver_relationship;
                            $client->cl_care_giver_contact = $clientInformation->cl_care_giver_contact;
                            $client->cl_child_separated = $clientInformation->cl_child_separated;
                            $client->cl_care_giver_informed = $clientInformation->cl_care_giver_informed;
                            $client->save();

                            $reason = new ReferralReason();
                            $reason->referral_id = $referral->id;
                            $reason->client_referral_info = $referralReason->client_referral_info;
                            $reason->client_referral_status = $referralReason->client_referral_status;
                            $reason->client_referral_info_text = $referralReason->client_referral_info_text;
                            $reason->client_referral_status_text = $referralReason->client_referral_status_text;
                            $reason->save();

                            $service = new ReferralServiceRequested();
                            $service->referral_id = $referral->id;
                            $service->comments = $referralServiceRequested->comments;
                            $service->save();


                            foreach ($referralServiceRequested->RequestedServicies->RequestedService as $service_req)
                            {

                                $servicereq = new RequestedService();
                                $servicereq->requested_id = $service->id;
                                $servicereq->service_request = $service_req->service_request;
                                $servicereq->save();
                            }
                            exit;

                        }
                    }
                }

                //4
                foreach ($xml->ItemsInventories as $itemsInventories) {
                    foreach ($itemsInventories as $itemsInventory) {

                        $item_id= $this->ImportInventoryItem($itemsInventory);
                    }
                }
                foreach ($xml->InventoriesReceived as $InventoriesReceived) {
                    foreach ($InventoriesReceived as $inventory_received) {



                        if(count(InventoryReceived::where('reference_number','=',$inventory_received->reference_number)
                                ->where('donor_ref','=',$inventory_received->donor_ref)
                                ->where('received_from','=',$inventory_received->received_from)
                                ->where('receiving_officer','=',$inventory_received->receiving_officer)
                                ->where('project','=',$inventory_received->project)
                                ->where('date_received','=',date("Y-m-d",strtotime($inventory_received->date_received)))->get()) <= 0)
                        {

                            $inventoryReceived = new InventoryReceived;
                            $inventoryReceived->reference_number = $inventory_received->reference_number;
                            $inventoryReceived->date_received = date("Y-m-d", strtotime($inventory_received->date_received));
                            $inventoryReceived->donor_ref = $inventory_received->donor_ref;
                            $inventoryReceived->received_from = $inventory_received->received_from;
                            $inventoryReceived->receiving_officer = $inventory_received->receiving_officer;
                            $inventoryReceived->project = $inventory_received->project;
                            $inventoryReceived->onward_delivery = $inventory_received->onward_delivery;
                            $inventoryReceived->comments = $inventory_received->comments;
                            $inventoryReceived->created_by = $inventory_received->created_by;
                            $inventoryReceived->save();

                            foreach($inventory_received->ItemsReceived->ItemReceived as $item)
                            {

                                $itemReceived=$item;
                                $item_id= $this->ImportInventoryItem($itemReceived->ItemsInventory);

                                if (count(ItemReceived::where('received_id','=',$itemReceived->id)
                                        ->where('item_id','=',$item_id)
                                        ->where('quantity','=',$itemReceived->quantity)
                                        ->where('description','=',$itemReceived->description)->get()) <= 0) {
                                    $tmreceived = new ItemReceived;
                                    $tmreceived->received_id = $inventoryReceived->id;
                                    $tmreceived->item_id = $item_id;
                                    $tmreceived->quantity = intval($itemReceived->quantity);
                                    $tmreceived->description = $itemReceived->description;
                                    $tmreceived->save();

                                    //Increase inventory
                                    $invItem=ItemsInventory::find($item_id);
                                    $invItem->quantity = intval($invItem->quantity) + intval($itemReceived->quantity);
                                    $invItem->status = "Available";
                                    $invItem->save();
                                }

                            }
                        }
                    }
                }
                foreach ($xml->ItemsDisbursements as $itemsDisbursements) {
                    foreach ($itemsDisbursements as $itemDisbursement) {


                        $camp_id=$this->ImportCamp($itemDisbursement->Camp);

                        if(count(ItemsDisbursement::where('disbursements_date','=',date('Y-m-d', strtotime($itemDisbursement->disbursements_date)))
                                ->where('disbursements_by','=',ucwords(strtolower($itemDisbursement->disbursements_by)))
                                ->where('camp_id','=',$camp_id)
                                ->where('comments','=',$itemDisbursement->comments)->get()) <=0 )
                        {
                            $distribution = new ItemsDisbursement;
                            $distribution->disbursements_date = date('Y-m-d', strtotime($itemDisbursement->disbursements_date));
                            $distribution->camp_id =  $camp_id;
                            $distribution->comments = $itemDisbursement->comments;
                            $distribution->disbursements_by = ucwords(strtolower($itemDisbursement->disbursements_by));
                            $distribution->save();

                            foreach ($itemDisbursement->ItemsDisbursementItems->ItemsDisbursementItem as $itemsDisbursementItem)
                            {


                                $client_id=$this->ImportClient($itemsDisbursementItem->Client);
                                $item_id= $this->ImportInventoryItem($itemsDisbursementItem->ItemsInventory);

                                if (count(ItemsDisbursementItems::where('item_id', '=', $item_id)
                                        ->where('distribution_id', '=', $distribution->id)
                                        ->where('client_id', '=', $client_id)
                                        ->where('distribution_date', '=', $itemsDisbursementItem->distribution_date)
                                        ->where('quantity', '=', $itemsDisbursementItem->quantity)->get()) <=0
                                ) {
                                    $dist_items = new ItemsDisbursementItems;
                                    $dist_items->client_id = $client_id;
                                    $dist_items->item_id = $item_id;
                                    $dist_items->quantity = $itemsDisbursementItem->quantity;
                                    $dist_items->distribution_id = $distribution->id;
                                    $dist_items->distribution_date = $itemsDisbursementItem->distribution_date;
                                    $dist_items->save();
                                    if (!isItemOutOfStock($item_id,intval($itemsDisbursementItem->quantity))) {
                                        deductItems($item_id,intval($itemsDisbursementItem->quantity));
                                    }
                                }
                            }


                        }
                    }
                }


                //5
                foreach ($xml->BudgetActivities as $budgetActivities) {
                    foreach ($budgetActivities as $b_activity) {


                        $activity_id=$this->ImportActivity($b_activity);
                    }
                }


                foreach ($xml->CashProvisions as $cashProvisions) {
                    foreach ($cashProvisions as $cashProvision) {




                        $activity_id=$this->ImportActivity($cashProvision->BudgetActivity);
                        $camp_id=$this->ImportCamp($cashProvision->Camp);


                        if(!count(CashProvision::where('provision_date','=',$cashProvision->provision_date)
                                ->where('camp_id','=',$camp_id)
                                ->where('activity_id','=',$activity_id)
                                ->where('provided_by','=',$cashProvision->provided_by)->get()) > 0)
                        {
                            $provision = new CashProvision;
                            $provision->provision_date = $cashProvision->provision_date;
                            $provision->provided_by = $cashProvision->provided_by;
                            $provision->comments = $cashProvision->comments;
                            $provision->camp_id = $camp_id;
                            $provision->created_by = $cashProvision->created_by;
                            $provision->activity_id = $activity_id;
                            $provision->save();


                        }
                        else
                        {
                            $provision = CashProvision::where('provision_date','=',$cashProvision->provision_date)
                                ->where('camp_id','=',$camp_id)
                                ->where('activity_id','=',$activity_id)
                                ->where('provided_by','=',$cashProvision->provided_by)->get()->first();
                        }
                        if(count($provision) >0 && $provision != null)
                        {
                            foreach ($cashProvision->CashProvisionClients->CashProvisionClient as $cashProvisionClient) {


                                $client_id = $this->ImportClient($cashProvisionClient->Client);



                                if (count(CashProvisionClient::where('client_id','=',$client_id)
                                        ->where('activity_id','=',$provision->activity_id)
                                        ->where('amount','=',$cashProvisionClient->amount)
                                        ->where('provision_id','=',$provision->id)
                                        ->where('provision_date','=',$provision->provision_date)->get()) <=0 )
                                {
                                    $provision_client = new CashProvisionClient;
                                    $provision_client->client_id = $client_id;
                                    $provision_client->activity_id = $provision->activity_id;
                                    $provision_client->amount = $cashProvisionClient->amount;
                                    $provision_client->provision_id = $provision->id;
                                    $provision_client->provision_date = $provision->provision_date;
                                    $provision_client->save();


                                }
                            }
                        }



                    }
                }
                foreach ($xml->PostCashAssessments as $postCashAssessments) {
                    foreach ($postCashAssessments as $post_cash_assessment) {


                        $client_id=$this->ImportClient($post_cash_assessment->Client);
                        $camp_id=$this->ImportCamp($post_cash_assessment->Camp);
                        $district_id="";
                        $region_id="";
                        $pm_district=$post_cash_assessment->District;
                        $pm_region=$pm_district->Region;

                        $country=Country::where('country_name','LIKE','%anzani%')->get()->first();
                        if(count(Region::where('region_name','=',ucwords($pm_region->region_name))
                                ->where('country_id','=',$country->id)->get()) >0){
                            $region = Region::where('region_name','=',ucwords($pm_region->region_name))
                                ->where('country_id','=',$country->id)->get()->first();

                            $region_id=$region->id;
                        }
                        else {
                            $region=new Region;
                            $region->region_name =ucwords($pm_region->region_name);
                            $region->country_id =$country->id;
                            $region->created_by =Auth::user()->username;
                            $region->save();
                            $region_id=$region->id;
                        }
                        if(count(District::where('district_name','=',ucwords($pm_district->district_name))
                                ->where('region_id','=',$region_id)->get()) >0){
                            $district = District::where('district_name','=',ucwords($pm_district->district_name))
                                ->where('region_id','=',$region_id)->get()->first();
                            $district_id=$district->id;
                        }
                        else {
                            $district = new District;
                            $district->district_name = ucwords($pm_district->district_name);
                            $district->region_id = $region_id;
                            $district->created_by = Auth::user()->username;
                            $district->save();
                            $district_id=$district->id;
                        }

                        $pCDemographicDetails=$post_cash_assessment->PCDemographicDetails;
                        $pCCashWithdrawal=$post_cash_assessment->PCCashWithdrawal;
                        $pCPhysicallyReceivingCash=$post_cash_assessment->PCPhysicallyReceivingCash;
                        $pCCommunalRelations=$post_cash_assessment->PCCommunalRelations;
                        $pCCashUsage=$post_cash_assessment->PCCashUsage;
                        if(count(PostCashAssessment::where('client_id','=',$client_id)->where('camp_id','=',$camp_id)
                                ->where('interview_date','=',$post_cash_assessment->interview_date)
                                ->where('interview_start_time','=',$post_cash_assessment->interview_start_time)
                                ->where('interview_end_time','=',$post_cash_assessment->interview_end_time)
                                ->where('organisation','=',$post_cash_assessment->organisation)
                                ->where('enumerator_name','=',$post_cash_assessment->enumerator_name)
                                ->where('respondent_name','=',$post_cash_assessment->respondent_name)->get()) <=0 ) {

                            $assessment = new PostCashAssessment;
                            $assessment->client_id = $client_id;
                            $assessment->camp_id = $camp_id;
                            $assessment->district_id = $district_id;
                            $assessment->interview_date = $post_cash_assessment->interview_date;
                            $assessment->interview_start_time = $post_cash_assessment->interview_start_time;
                            $assessment->interview_end_time = $post_cash_assessment->interview_end_time;
                            $assessment->organisation = $post_cash_assessment->organisation;
                            $assessment->enumerator_name = $post_cash_assessment->enumerator_name;
                            $assessment->respondent_name = $post_cash_assessment->respondent_name;
                            $assessment->enumerator_observations = $post_cash_assessment->enumerator_observations;
                            $assessment->created_by = Auth::user()->username;
                            $assessment->save();

                            $domographic = new PCDemographicDetails;
                            $domographic->assessment_id = $assessment->id;
                            $domographic->q2_1 = $pCDemographicDetails->q2_1;
                            $domographic->q2_2 = $pCDemographicDetails->q2_2;
                            $domographic->q2_3 = $pCDemographicDetails->q2_3;
                            $domographic->q2_4 = $pCDemographicDetails->q2_4;
                            $domographic->q2_5 = $pCDemographicDetails->q2_5;
                            $domographic->q2_6 = $pCDemographicDetails->q2_6;
                            $domographic->q2_7 = $pCDemographicDetails->q2_7;
                            $domographic->q2_8 = $pCDemographicDetails->q2_8;
                            $domographic->save();

                            $withdraw = new PCCashWithdrawal;
                            $withdraw->assessment_id = $assessment->id;
                            $withdraw->q3_1 = $pCCashWithdrawal->q3_1;
                            $withdraw->q3_2 = $pCCashWithdrawal->q3_2;
                            $withdraw->q3_3 = $pCCashWithdrawal->q3_3;
                            $withdraw->q3_4 = $pCCashWithdrawal->q3_4;
                            $withdraw->q3_5 = $pCCashWithdrawal->q3_5;
                            $withdraw->q3_6 = $pCCashWithdrawal->q3_6;
                            $withdraw->save();


                            $physical_receiving = new PCPhysicallyReceivingCash;
                            $physical_receiving->assessment_id = $assessment->id;
                            $physical_receiving->q4_1 = $pCPhysicallyReceivingCash->q4_1;
                            $physical_receiving->q4_2 = $pCPhysicallyReceivingCash->q4_2;
                            $physical_receiving->q4_3 = $pCPhysicallyReceivingCash->q4_3;
                            $physical_receiving->q4_4 = $pCPhysicallyReceivingCash->q4_4;
                            $physical_receiving->q4_5 = $pCPhysicallyReceivingCash->q4_5;
                            $physical_receiving->q4_6 = $pCPhysicallyReceivingCash->q4_6;
                            $physical_receiving->q4_7 = $pCPhysicallyReceivingCash->q4_7;
                            $physical_receiving->q4_8 = $pCPhysicallyReceivingCash->q4_8;
                            $physical_receiving->q4_9 = $pCPhysicallyReceivingCash->q4_9;
                            $physical_receiving->q4_10 = $pCPhysicallyReceivingCash->q4_10;
                            $physical_receiving->q4_10_1 = $pCPhysicallyReceivingCash->q4_10_1;
                            $physical_receiving->q4_11 = $pCPhysicallyReceivingCash->q4_11;
                            $physical_receiving->q4_12 = $pCPhysicallyReceivingCash->q4_12;
                            $physical_receiving->q4_13 = $pCPhysicallyReceivingCash->q4_13;
                            $physical_receiving->q4_14 = $pCPhysicallyReceivingCash->q4_14;
                            $physical_receiving->q4_15 = $pCPhysicallyReceivingCash->q4_15;
                            $physical_receiving->q4_16 = $pCPhysicallyReceivingCash->q4_16;
                            $physical_receiving->q4_17 = $pCPhysicallyReceivingCash->q4_17;
                            $physical_receiving->q4_18 = $pCPhysicallyReceivingCash->q4_18;
                            $physical_receiving->q4_19 = $pCPhysicallyReceivingCash->q4_19;
                            $physical_receiving->q4_20 = $pCPhysicallyReceivingCash->q4_20;
                            $physical_receiving->q4_21 = $pCPhysicallyReceivingCash->q4_21;
                            $physical_receiving->q4_22 = $pCPhysicallyReceivingCash->q4_22;
                            $physical_receiving->save();




                            $communal_relation = new PCCommunalRelations;
                            $communal_relation->assessment_id = $assessment->id;
                            $communal_relation->q5_1 = $request->q5_1;
                            $communal_relation->q5_2 = $pCCommunalRelations->q5_2;
                            $communal_relation->q5_3 = $pCCommunalRelations->q5_3;
                            $communal_relation->q5_4 = $pCCommunalRelations->q5_4;
                            $communal_relation->q5_5 = $pCCommunalRelations->q5_5;
                            $communal_relation->q5_6 = $pCCommunalRelations->q5_6;
                            $communal_relation->save();


                            $cash_usage = new PCCashUsage;
                            $cash_usage->assessment_id = $assessment->id;
                            $cash_usage->q6_1 = $pCCashUsage->q6_1;
                            $cash_usage->q6_2 = $pCCashUsage->q6_2;
                            $cash_usage->q6_3 = $pCCashUsage->q6_3;
                            $cash_usage->q6_4 = $pCCashUsage->q6_4;
                            $cash_usage->save();


                            foreach ($pCCashUsage->PCCashUsageCategories as $cashUsageCategory) {

                                $pc_usage_category=$cashUsageCategory->PCCashUsageCategory;
                                $usage_category_id="";
                                $pCCategory=$pc_usage_category->PCCategories;
                                if(count(PCCategories::where('category_name','=',$pCCategory->category_name)->get()) >0)
                                {
                                    $ucaategory=PCCategories::where('category_name','=',$pCCategory->category_name)->get()->first();
                                    $usage_category_id=$ucaategory->id;
                                }
                                else
                                {
                                    $ucaategory=new PCCategories;
                                    $ucaategory->category_name=$pCCategory->category_name;
                                    $ucaategory->save();
                                    $usage_category_id=$ucaategory->id;
                                }
                                $usage_category = new PCCashUsageCategory;
                                $usage_category->usage_id = $cash_usage->id;
                                $usage_category->category_id = $usage_category_id;
                                $usage_category->currency = $pc_usage_category->currency;
                                $usage_category->save();
                            }
                        }

                    }
                }

                //6

                foreach ($xml->ClientCases as $clientCases)
                {
                    foreach ($clientCases as $c_case) {

                        $client_id=$this->ImportClient($c_case->Client);
                        $camp_id=$this->ImportCamp($c_case->Camp);

                        if(count(ClientCase::where('open_date','=',date("Y-m-d", strtotime($c_case->open_date)))
                                ->where('case_type','=',$c_case->case_type)
                                ->where('client_id','=',$client_id)
                                ->where('status','=',$c_case->status)
                                ->where('camp_id','=',$camp_id)
                                ->where('case_worker_name','=',$c_case->case_worker_name)
                                ->where('created_by','=',$c_case->created_by)->get()) <=0)
                        {
                            $case = new ClientCase;
                            $case->open_date = date("Y-m-d", strtotime($c_case->open_date));
                            $case->case_type = $c_case->case_type;
                            $case->descriptions = $c_case->descriptions;
                            $case->initial_action = $c_case->initial_action;
                            $case->feedback = $c_case->feedback;
                            $case->planning = $c_case->planning;
                            $case->case_worker_name = $c_case->case_worker_name;
                            $case->status = $c_case->status;
                            $case->created_by = Auth::user()->id;
                            $case->camp_id = $camp_id;
                            $case->client_id = $client_id;
                            $case->save();
                        }

                    }
                }
                foreach ($xml->ProgressNotes as $progressNotes)
                {
                    foreach ($progressNotes as $p_note)
                    {

                        $client_id=$this->ImportClient($p_note->Client);
                        $camp_id=$this->ImportCamp($p_note->Camp);

                        if(count(ProgressNote::where('open_date','=',$p_note->open_date)
                                ->where('status','=',$p_note->status)
                                ->where('created_by','=',$p_note->created_by)
                                ->where('camp_id','=',$camp_id)
                                ->where('client_id','=',$client_id)->get()) <=0)
                        {
                            $note = new ProgressNote;
                            $note->open_date = date('Y-m-d',strtotime($p_note->open_date));
                            $note->subjective_information = $p_note->subjective_information;
                            $note->objective_information = $p_note->objective_information;
                            $note->analysis = $p_note->analysis;
                            $note->planning = $p_note->planning;
                            $note->case_worker_name = $p_note->case_worker_name;
                            $note->status = $p_note->status;
                            $note->created_by = $p_note->created_by;
                            $note->camp_id= $camp_id;
                            $note->client_id = $client_id;
                            $note->save();
                        }

                    }
                }
			}


            if (File::exists($requiredFile))
            {
                File::delete($requiredFile);
            }

            return redirect('home');
        }
        catch (\Exception $ex) {
            \Log::info('Export failed: ', $ex->getMessage());
            return redirect()->back()->with('message',$ex->getMessage());
        }

    }
    public function ImportCamp($camp)
    {
        $region=$camp->Region;
        $district=$camp->District;
        if (count(Region::where('region_name','=',$region->region_name)->get()) >0)
        {
            $rg=Region::where('region_name','=',$region->region_name)->get()->first();
            $region_id=$rg->id;
        }
        else
        {
            $country=Country::where('country_name','LIKE','%anzani%')->get()->first();
            $rg= new Region();
            $rg->region_name=$region->region_name;
            $rg->country_id=$country->id;
            $rg->save();
            $region_id=$rg->id;
        }
        if (count(District::where('district_name','=',$district->district_name)->get()) >0)
        {
            $ds=District::where('district_name','=',$district->district_name)->get()->first();
            $district_id=$ds->id;
        }
        else
        {
            $ds=new District;
            $ds->district_name =ucwords($district->district_name);
            $ds->region_id =$region_id;
            $ds->created_by =Auth::user()->username;
            $ds->save();
            $district_id=$ds->id;
        }

        if (count(Camp::where('camp_name','=',$camp->camp_name)->get()) >0)
        {
            $ds=Camp::where('camp_name','=',$camp->camp_name)->get()->first();
            $camp_id=$ds->id;
        }
        else
        {
            $cmp=new Camp;
            $cmp->reg_no =ucwords($camp->reg_no);
            $cmp->camp_name =ucwords($camp->camp_name);
            $cmp->description =ucwords($camp->description);
            $cmp->address =ucwords($camp->address);
            $cmp->tel =ucwords($camp->tel);
            $cmp->region_id =$region_id;
            $cmp->district_id =$district_id;
            $cmp->status =ucwords($camp->status);
            $cmp->created_by =Auth::user()->username;
            $cmp->save();
            $camp_id=$camp->id;
        }
        return $camp_id;
    }

    public function ImportInventoryItem($itemInventory)
    {

        $item_category=$itemInventory->ItemCategory;
        $category_id="";
        $item_id="";
        if(count(ItemsCategories::where('category_name','=',$item_category->category_name)
                ->where('status','=',$item_category->status)->get()) >0)
        {
            $category = ItemsCategories::where('category_name','=',$item_category->category_name)
                ->where('status','=',$item_category->status)->get()->first();
            $category_id=$category->id;
        }
        else {
            $category = new ItemsCategories;
            $category->category_name = ucwords(strtolower($item_category->category_name));
            $category->status = $item_category->status;
            $category->description = $item_category->description;
            $category->save();
            $category_id=$category->id;
        }
        if(count(ItemsInventory::where('item_name','=',$itemInventory->item_name)
                ->where('category_id','=',$category_id)->get() )  >0 ) {

            $item = ItemsInventory::where('item_name','=',$itemInventory->item_name)
                ->where('category_id','=',$category_id)->get()->first();
            $item_id=$item->id;
        }
        else{


            $item = new ItemsInventory;
            $item->item_name = strtoupper(strtolower($itemInventory->item_name));
            $item->description = $itemInventory->description;
            $item->category_id = $category_id;
            $item->quantity = $itemInventory->quantity;
            $item->unit = strtoupper(strtolower($itemInventory->unit));
            $item->remarks = $itemInventory->remarks;
            $item->status = $itemInventory->status;
            $item->redistribution_limit=$itemInventory->redistribution_limit;
            $item->save();
            $item_id=$item->id;
        }

        return $item_id;
    }

    public function ImportClient($client_data)
    {



			$clnt = $client_data;
            $origin=$clnt->Origin;
            $camp=$clnt->Camp;
            $region=$clnt->Camp->Region;
            $district=$clnt->Camp->District;
            $region_id="";
            $district_id="";
            $camp_id="";
            $origin_id="";
            $client_id="";
            $clnt->Client;


            if (count(Origin::where('origin_name','=',$origin->origin_name)->get()) >0)
            {
                $org=Origin::where('origin_name','=',$origin->origin_name)->get()->first();
                $origin_id=$org->id;
            }
            else
            {
                $org=new Origin;
                $org->origin_name = ucwords($origin->origin_name);
                $org->created_by = Auth::user()->username;
                $org->save();
                $origin_id=$org->id;
            }
            if (count(Region::where('region_name','=',$region->region_name)->get()) >0)
            {
                $rg=Region::where('region_name','=',$region->region_name)->get()->first();
                $region_id=$rg->id;
            }
            else
            {
                $country=Country::where('country_name','LIKE','%anzani%')->get()->first();
                $rg= new Region();
                $rg->region_name=$region->region_name;
                $rg->country_id=$country->id;
                $rg->save();
                $region_id=$rg->id;
            }
            if (count(District::where('district_name','=',$district->district_name)->get()) >0)
            {
                $ds=District::where('district_name','=',$district->district_name)->get()->first();
                $district_id=$ds->id;
            }
            else
            {
                $ds=new District;
                $ds->district_name =ucwords($district->district_name);
                $ds->region_id =$region_id;
                $ds->created_by =Auth::user()->username;
                $ds->save();
                $district_id=$ds->id;
            }

            if (count(Camp::where('camp_name','=',$camp->camp_name)->get()) >0)
            {
                $ds=Camp::where('camp_name','=',$camp->camp_name)->get()->first();
                $camp_id=$ds->id;
            }
            else
            {
                $cmp=new Camp;
                $cmp->reg_no =ucwords($camp->reg_no);
                $cmp->camp_name =ucwords($camp->camp_name);
                $cmp->description =ucwords($camp->description);
                $cmp->address =ucwords($camp->address);
                $cmp->tel =ucwords($camp->tel);
                $cmp->region_id =$region_id;
                $cmp->district_id =$district_id;
                $cmp->status =ucwords($camp->status);
                $cmp->created_by =Auth::user()->username;
                $cmp->save();
                $camp_id=$camp->id;
            }

            if (count(Client::where('full_name','=',$clnt->full_name)->where('sex','=',$clnt->sex)
                    ->where('age','=',$clnt->age)
                    ->where('marital_status','=',$clnt->marital_status)
                    ->where('date_arrival','=',$clnt->date_arrival)
                    ->where('household_number','=',$clnt->household_number)
                    ->where('females_total','=',$clnt->females_total)
                    ->where('males_total','=',$clnt->males_total)->get()) > 0)
            {
                $client=Client::where('full_name','=',$clnt->full_name)->where('sex','=',$clnt->sex)
                    ->where('age','=',$clnt->age)
                    ->where('marital_status','=',$clnt->marital_status)
                    ->where('date_arrival','=',$clnt->date_arrival)
                    ->where('household_number','=',$clnt->household_number)
                    ->where('females_total','=',$clnt->females_total)
                    ->where('males_total','=',$clnt->males_total)->get()->first();

				$client_id=$client->id;
            }
            else
            {
                $client = new Client;
                $client->client_number = strtoupper($clnt->client_number);
                $client->full_name = ucwords($clnt->full_name);
                $client->sex = ucwords($clnt->sex);
                $client->age = $clnt->age;
                $client->birth_date = $clnt->birth_date;
                $client->marital_status = $clnt->marital_status;
                $client->spouse_name = $clnt->spouse_name;
                $client->care_giver = $clnt->care_giver;
                $client->date_arrival=$clnt->date_arrival;
                $client->present_address = $clnt->present_address;
                $client->household_number = $clnt->household_number;
                $client->ration_card_number = $clnt->ration_card_number;
                $client->assistance_received = $clnt->assistance_received;
                $client->problem_specification = $clnt->problem_specification;
                $client->origin_id = $origin_id;
                $client->camp_id=$camp_id;
                $client->present_address = $clnt->present_address;
                $client->females_total = $clnt->females_total;
                $client->males_total = $clnt->males_total;
                $client->present_address = $clnt->present_address;
                $client->hh_relation = $clnt->hh_relation;
                $client->share_info= $clnt->share_info;
                $client->created_by = Auth::user()->username;
                $client->status= $clnt->status;
                $client->age_score=$clnt->age_score;
                $client->save();

                $haireg="HAI-".str_pad($client->id,4,'0',STR_PAD_LEFT).preg_replace('/\d/', '', substr($clnt->hai_reg_number,4,strlen($clnt->hai_reg_number)) );
                $client->hai_reg_number=$haireg;
                $client->save();

                foreach ($clnt->ClientVulnerabilityCodes as $cvcodes)
                {
                    foreach ($cvcodes as $cvc)
                    {


                        $psnCode=$cvc->PSNCode;
                        $psnCodeCategory=$psnCode->PSNCodeCategory;
                        $category_id="";
                        $code_id="";

                        if(count(PSNCodeCategory::where('code','=',$psnCodeCategory->code)->get())>0)
                        {
                            $category = PSNCodeCategory::where('code','=',$psnCodeCategory->code)->get()->first();
                            $category_id=$category->id;
                        }
                        else
                        {
                            $category = new PSNCodeCategory;
                            $category->code = strtoupper($psnCodeCategory->code);
                            $category->description = $psnCodeCategory->description ;
                            $category->definition = $psnCodeCategory->definition;
                            $category->for_reporting = $psnCodeCategory->for_reporting;
                            $category->created_by = Auth::user()->username;
                            $category->save();
                            $category_id=$category->id;
                        }
                        if(count(PSNCode::where('code','=',$psnCode->code)->get())>0)
                        {
                            $code = PSNCode::where('code','=',$psnCode->code)->get()->first();
                            $code_id=$code->id;
                        }
                        else
                        {
                            $code = new PSNCode;
                            $code->code = strtoupper($psnCode->code);
                            $code->description = $psnCode->description;
                            $code->definition = $psnCode->definition;
                            $code->category_id = $category_id;
                            $code->for_reporting = $psnCode->for_reporting;
                            $code->created_by = Auth::user()->username;
                            $code->save();
                            $code_id=$code->id;
                        }

                        $codes = new ClientVulnerabilityCode;
                        $codes->client_id = $client->id;
                        $codes->code_id = $code_id;
                        $codes->save();


                    }
                }

                $client_id=$client->id;
            }

            return $client_id;
    }
    public function ImportActivity($b_activity)
    {
        $activity_id="";
        if(count(BudgetActivity::where('activity_name','=',strtoupper(strtolower($b_activity->activity_name)))
                ->where('amount','=',$b_activity->amount)
                ->where('donor','=',$b_activity->donor)
                ->where('provision_limit','=',$b_activity->provision_limit)->get()) >0)
        {
            $activity = BudgetActivity::where('activity_name','=',strtoupper(strtolower($b_activity->activity_name)))
                ->where('amount','=',$b_activity->amount)
                ->where('donor','=',$b_activity->donor)
                ->where('provision_limit','=',$b_activity->provision_limit)->get()->first();
            $activity_id=$activity->id;
        }
        else{
            $activity = new BudgetActivity;
            $activity->activity_name = strtoupper(strtolower($b_activity->activity_name));
            $activity->description = $b_activity->description;
            $activity->amount = $b_activity->amount;
            $activity->currency = $b_activity->currency;
            $activity->remarks = $b_activity->remarks;
            $activity->provision_limit = $b_activity->provision_limit;
            $activity->status = $b_activity->status;
            $activity->donor = $b_activity->donor;
            $activity->created_by = Auth::user()->username;
            $activity->save();
            $activity_id=$activity->id;
        }

        return $activity_id;
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
     * @param  \Illuminate\Http\Request  $camp
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
