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
    public function authorizeAllReferrals()
    {
        //

        if (Auth::user()->can('authorize')){
          $referrals=ClientReferral::where('auth_status','=','pending')->get();
            foreach ($referrals as $referral){
                $referral->auth_status = 'authorized';
                $referral->auth_by = Auth::user()->username;
                $referral->auth_date('Y-m-d H:i');
                $referral->save();
            }}else{
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


            $records["data"][] = array(
                $count++,
                $referral->reference_no,
                $referral->referral_date,
                $referral->client->client_number,
                $referral->client->full_name,
                $referral->client->age,
                $referral->client->sex,
                $referral->client->camp->camp_name,
                $referral->status,
                '<span class="text-center" id="'.$referral->id.'">
                                        <a href="#" class="showRecord btn " > <i class="fa fa-eye green "></i> </a>
                                        <a href="#" class=" btn "> <i class="fa fa-print green " onclick="printPage(\''.url('referrals').'/'.$referral->id.'\');" ></i> </a>
                                        <a href="'.url('download/referrals/form').'/'.$referral->id.'" class=" btn  "> <i class="fa fa-download text-danger "></i> </a>
                </span>',
                $referral->auth_status,
                '<span id="'.$referral->id.'">
                
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

    }
}
