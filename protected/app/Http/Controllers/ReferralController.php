<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientInformation;
use App\ClientReferral;
use App\ReceivingAgency;
use App\Referral;
use App\ReferralReason;
use App\ReferralServiceRequested;
use App\ReferringAgency;
use App\RequestedService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ReferralController extends Controller
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
        return view('referrals.index');
    }

    public function getReferralClientList()
    {
        //
        return view('referrals.clients');
    }
    public function showImport()
    {
        //
        return view('referrals.import');
    }
    public function postImport(Request $request)
    {
        //

    }
    public function AuthorizeAll()
    {
        //
        if (Auth::user()->can('authorize')){

            $assessments=ClientReferral::where('auth_status', '=', 'pending')
                ->update([
                    'auth_status' => 'authorized',
                    'auth_by' => Auth::user()->username,
                    'auth_date' => date('Y-m-d H:i')
                ]);

            //Audit trail
            AuditRegister("ReferralController","ClientReferral",$assessments);

        }else{
            return null;
        }

    }
    public function AuthorizeReferralsById($id)
    {
        //
        if (Auth::user()->can('authorize')){

            $assessments=ClientReferral::find($id)
                ->update([
                    'auth_status' => 'authorized',
                    'auth_by' => Auth::user()->username,
                    'auth_date' => date('Y-m-d H:i')
                ]);
            //Audit trail
            AuditRegister("ReferralController","AuthorizeReferralsById",$assessments);
        }else{
            return null;
        }
    }


    public function downloadPDF($id)
    {
        $referral=ClientReferral::find($id);
         $pdf = \PDF::loadView('referrals.show', compact('referral'))
            ->setOption('footer-center', '[page]')
            ->setOption('page-offset', 0);
        return $pdf->download('Client_Referral_form.pdf');
    }

    public function getReferralList()
    {
        //
        $referrals=ClientReferral::all();
        $iTotalRecords =count(ClientReferral::all());
        $sEcho = intval(10);

        $records = array();
        $records["data"] = array();


        $count=1;
        foreach($referrals as $referral) {
            $origin="";
            $status="";

            $vcolor="label-danger";
            $hai_reg_number="";
            $full_name="";
            $sex="";
            $age="";
            $camp_name="";
            if(is_object($referral->client) && $referral->client != null){
                $hai_reg_number=$referral->client->hai_reg_number;
                $full_name=$referral->client->full_name;
                $sex=$referral->client->sex;
                $age=$referral->client->age;

            }
            if(is_object($referral->camp) && $referral->camp != null){
                $camp_name=$referral->camp->camp_name;
            }

            if ($referral->auth_status == "pending")
            {
                if (Auth::user()->can('authorize'))
                {
                    $records["data"][] = array(
                        $count++,
                        $referral->reference_no,
                        $referral->referral_date,
                        $hai_reg_number,
                        $full_name,
                        $age,
                        $sex,
                        $camp_name,
                        $referral->status,
                        $referral->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$referral->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$referral->id.'"><a href="#" class=" label " onclick="printPage(\''.url('referrals').'/'.$referral->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$referral->id.'"><a href="'.url('download/referrals/form').'/'.$referral->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
                             <li id="'.$referral->id.'"><a href="#" class="authorizeRecord label "><i class="fa fa-check "></i> Authorize </a></li>
                             <li id="'.$referral->id.'"><a href="#" class="editRecord label "><i class="fa fa-pencil "></i> Edit </a></li>
                             <li id="'.$referral->id.'"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'
                    );
                }
                elseif (Auth::user()->hasRole('inputer'))
                {
                    $records["data"][] = array(
                        $count++,
                        $referral->reference_no,
                        $referral->referral_date,
                        $hai_reg_number,
                        $full_name,
                        $age,
                        $sex,
                        $camp_name,
                        $referral->status,
                        $referral->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$referral->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$referral->id.'"><a href="#" class=" label " onclick="printPage(\''.url('referrals').'/'.$referral->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$referral->id.'"><a href="'.url('download/referrals/form').'/'.$referral->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
                             <li id="'.$referral->id.'"><a href="#" class="editRecord label "><i class="fa fa-pencil "></i> Edit </a></li>
                             <li id="'.$referral->id.'"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'
                    );
                }
            }
            else
            {
                if (Auth::user()->hasRole('admin'))
                {
                    $records["data"][] = array(
                        $count++,
                        $referral->reference_no,
                        $referral->referral_date,
                        $hai_reg_number,
                        $full_name,
                        $age,
                        $sex,
                        $camp_name,
                        $referral->status,
                        $referral->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$referral->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$referral->id.'"><a href="#" class=" label " onclick="printPage(\''.url('referrals').'/'.$referral->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$referral->id.'"><a href="'.url('download/referrals/form').'/'.$referral->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
                             <li id="'.$referral->id.'"><a href="#" class="editRecord label "><i class="fa fa-pencil "></i> Edit </a></li>
                             <li id="'.$referral->id.'"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'
                    );
                }
                else
                {
                    $records["data"][] = array(
                        $count++,
                        $referral->reference_no,
                        $referral->referral_date,
                        $hai_reg_number,
                        $full_name,
                        $age,
                        $sex,
                        $camp_name,
                        $referral->status,
                        $referral->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$referral->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$referral->id.'"><a href="#" class=" label " onclick="printPage(\''.url('referrals').'/'.$referral->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$referral->id.'"><a href="'.url('download/referrals/form').'/'.$referral->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
                            </ul>
                        </li>
                    </ul>'
                    );
                }
            }
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
        return view('referrals.create');
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
                'referral_type' => 'required',
                'referral_date' => 'required|before:tomorrow',
                'rec_organisation' => 'required',
                'rec_email' => 'email',
                'ref_email' => 'email',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {


                $referral = new ClientReferral;
                $referral->client_id = $request->client_id;
                $referral->referral_type = $request->referral_type;
                $referral->referral_date = date("Y-m-d", strtotime($request->referral_date));
                $referral->created_by=Auth::user()->username;
                $referral->save();

                //Create references
                $referral->reference_no="HAI/".date("Y")."/RF-".str_pad($referral->id,4,'0',STR_PAD_LEFT);
                $referral->save();

                $ref_agency=new ReferringAgency;
                $ref_agency->referral_id = $referral->id;
                $ref_agency->ref_organisation = $request->ref_organisation;
                $ref_agency->ref_phone = $request->ref_phone;
                $ref_agency->ref_contact = $request->ref_contact;
                $ref_agency->ref_email = $request->ref_email;
                $ref_agency->ref_location = $request->ref_location;
                $ref_agency->save();

                $agency=new ReceivingAgency;
                $agency->referral_id = $referral->id;
                $agency->rec_organisation = $request->rec_organisation;
                $agency->rec_phone = $request->rec_phone;
                $agency->rec_contact = $request->rec_contact;
                $agency->rec_email = $request->rec_email;
                $agency->rec_location = $request->rec_location;
                $agency->save();

                $client=new ClientInformation;
                $client->referral_id= $referral->id;
                $client->cl_name=$request->cl_name;
                $client->cl_address=$request->cl_address;
                $client->cl_phone=$request->cl_phone;
                $client->cl_age=$request->cl_age;
                $client->cl_sex=$request->cl_sex;
                $client->cl_nationality=$request->cl_nationality;
                $client->cl_language=$request->cl_language;
                $client->cl_id_number=$request->cl_id_number;
                $client->cl_care_giver=$request->cl_care_giver;
                $client->cl_care_giver_relationship=$request->cl_care_giver_relationship;
                $client->cl_care_giver_contact=$request->cl_care_giver_contact;
                $client->cl_child_separated=$request->cl_child_separated;
                $client->cl_care_giver_informed=$request->cl_care_giver_informed;
                $client->save();
                
                $reason= new ReferralReason;
                $reason->referral_id=$referral->id;
                $reason->client_referral_info=$request->client_referral_info;
                $reason->client_referral_status=$request->client_referral_status;
                $reason->client_referral_info_text=$request->client_referral_info_text;
                $reason->client_referral_status_text=$request->client_referral_status_text;
                $reason->save();

                if (isset($request->service_request)) {

                    $service=new ReferralServiceRequested;
                    $service->referral_id=$referral->id;
                    $service->comments=$request->comments;
                    $service->save();

                    foreach ($request->service_request as $sevreq ){

                        $servicereq=new RequestedService();
                        $servicereq->requested_id=$service->id;
                        $servicereq->service_request=$sevreq;
                        $servicereq->save();
                    }
                }
                //Audit trail
                AuditRegister("ReferralController","Created new Referral",$referral);
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
        $referral=ClientReferral::findorfail($id);
        return view('referrals.show',compact('referral'));
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
        $referral =  ClientReferral::find($id);
        return view('referrals.edit',compact('referral'));
    }
    public function getClientProfile($id)
    {
        //
        $client =  Client::find($id);
        return view('referrals.profile',compact('client'));
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
        //try {
            $validator = Validator::make($request->all(), [
                'referral_type' => 'required',
                'referral_date' => 'required|before:tomorrow',
                'rec_organisation' => 'required',
                'client_referral_status' => 'required',
                'service_request' => 'required',
                'rec_email' => 'email',
                'ref_email' => 'email',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $referral =  ClientReferral::find($id);
                $referral->referral_type = $request->referral_type;
                $referral->referral_date = date("Y-m-d", strtotime($request->referral_date));
                $referral->updated_by=Auth::user()->username;
                $referral->status=$request->status;
                $referral->save();

                if (is_object($referral->referringAgency)) {
                    $ref_agency = $referral->referringAgency;
                    $ref_agency->referral_id = $referral->id;
                    $ref_agency->ref_organisation = $request->ref_organisation;
                    $ref_agency->ref_phone = $request->ref_phone;
                    $ref_agency->ref_contact = $request->ref_contact;
                    $ref_agency->ref_email = $request->ref_email;
                    $ref_agency->ref_location = $request->ref_location;
                    $ref_agency->save();
                }

                if (is_object($referral->receivingAgency)) {
                    $agency = $referral->receivingAgency;
                    $agency->referral_id = $referral->id;
                    $agency->rec_organisation = $request->rec_organisation;
                    $agency->rec_phone = $request->rec_phone;
                    $agency->rec_contact = $request->rec_contact;
                    $agency->rec_email = $request->rec_email;
                    $agency->rec_location = $request->rec_location;
                    $agency->save();
                }
                if (is_object($referral->clientInformation)) {
                    $client = $referral->clientInformation;
                    $client->referral_id = $referral->id;
                    $client->cl_name = $request->cl_name;
                    $client->cl_address = $request->cl_address;
                    $client->cl_phone = $request->cl_phone;
                    $client->cl_age = $request->cl_age;
                    $client->cl_sex = $request->cl_sex;
                    $client->cl_nationality = $request->cl_nationality;
                    $client->cl_language = $request->icl_languaged;
                    $client->cl_id_number = $request->cl_id_number;
                    $client->cl_care_giver = $request->cl_care_giver;
                    $client->cl_care_giver_relationship = $request->cl_care_giver_relationship;
                    $client->cl_care_giver_contact = $request->cl_care_giver_contact;
                    $client->cl_child_separated = $request->cl_child_separated;
                    $client->cl_care_giver_informed = $request->cl_care_giver_informed;
                    $client->save();
                }

                if (is_object($referral->referralReason)) {
                    $reason = $referral->referralReason;
                    $reason->referral_id = $referral->id;
                    $reason->client_referral_info = $request->client_referral_info;
                    $reason->client_referral_status = $request->client_referral_status;
                    $reason->client_referral_info_text = $request->client_referral_info_text;
                    $reason->client_referral_status_text = $request->client_referral_status_text;
                    $reason->save();
                }

                if (is_object($referral->referralServiceRequested)) {
                    foreach (RequestedService::where('requested_id', '=', $referral->referralServiceRequested->id)->get() as $service) {
                        $service->delete();
                    }
                }

                if (isset($request->service_request)) {

                    $servicerec=$referral->referralServiceRequested;
                    $servicerec->referral_id=$referral->id;
                    $servicerec->comments=$request->comments;
                    $servicerec->save();

                    foreach ($request->service_request as $servrec){

                        $service=new RequestedService;
                        $service->requested_id=$servicerec->id;
                        $service->service_request=$servrec;
                        $service->save();
                    }
                }

               //Audit trail
                AuditRegister("ReferralController","Created new Referral",$referral);
                    return response()->json([
                    'success' => true,
                    'message' => "Record saved"
                ], 200);

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
        $referral =  ClientReferral::find($id);
        if(is_object($referral) && $referral != null) {
            ClientInformation::where("referral_id", '=', $referral->id)->delete();
            ReceivingAgency::where("referral_id", '=', $referral->id)->delete();
            ReferringAgency::where("referral_id", '=', $referral->id)->delete();
            ReferralReason::where("referral_id", '=', $referral->id)->delete();

            $services=ReferralServiceRequested::where("referral_id", '=', $referral->id)->first();

            if (is_object($services) && $services != null){
               RequestedService::where('requested_id','=',$services->id)->delete();
            }
            $services->delete();
        }
        $referral->delete();
    }
}
