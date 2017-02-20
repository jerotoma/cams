<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientInformation;
use App\ClientReferral;
use App\ReceivingAgency;
use App\Referral;
use App\ReferralReason;
use App\ReferralServiceRequested;
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
                $referral->age,
                $referral->sex,
                $referral->client->camp->camp_name,
                '<span class="text-center" id="'.$referral->id.'">
                                        <a href="#" class="showRecord btn " > <i class="fa fa-eye green "></i> </a>
                                        <a href="#" class=" btn "> <i class="fa fa-print green " onclick="printPage(\''.url('referrals').'/'.$referral->id.'\');" ></i> </a>
                                        <a href="'.url('download/referrals/form').'/'.$referral->id.'" class=" btn  "> <i class="fa fa-download text-danger "></i> </a>
                </span>',
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
                'rec_location' => 'required',
                'client_referral_info' => 'required',
                'client_referral_status' => 'required',
                'service_request' => 'required',
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
                
                $agency=new ReceivingAgency;
                $agency->referral_id = $referral->id;
                $agency->rec_organisation = $referral->rec_organisation;
                $agency->rec_phone = $referral->rec_phone;
                $agency->rec_contact = $referral->rec_contact;
                $agency->rec_email = $referral->rec_email;
                $agency->rec_location = $referral->rec_location;
                $agency->save();

                $client=new ClientInformation;
                $client->referral_id= $referral->id;
                $client->cl_name=$referral->cl_name;
                $client->cl_address=$referral->cl_address;
                $client->cl_phone=$referral->cl_phone;
                $client->cl_age=$referral->cl_age;
                $client->cl_sex=$referral->cl_sex;
                $client->cl_nationality=$referral->cl_nationality;
                $client->cl_language=$referral->icl_languaged;
                $client->cl_id_number=$referral->cl_id_number;
                $client->cl_care_giver=$referral->cl_care_giver;
                $client->cl_care_giver_relationship=$referral->cl_care_giver_relationship;
                $client->cl_care_giver_contact=$referral->cl_care_giver_contact;
                $client->cl_child_separated=$referral->cl_child_separated;
                $client->cl_care_giver_informed=$referral->cl_care_giver_informed;
                $client->save();
                
                $reason=new ReferralReason;
                $client->referral_id=$referral->id;
                $client->client_referral_info=$referral->client_referral_info;
                $client->client_referral_status=$referral->client_referral_status;
                $client->client_referral_info_text=$referral->client_referral_info_text;
                $client->client_referral_status_text=$referral->client_referral_status_text;
                $reason->save();

                if (isset($request->service_request)) {

                    $service=new ReferralServiceRequested;
                    $service->referral_id=$referral->id;
                    $service->comments=$referral->comments;
                    $reason->save();

                    foreach ($request->service_request as $service){

                        $service=new ReferralServiceRequested;
                        $service->requested_id=$reason->id;
                        $service->service_request=$service;
                        $reason->save();
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
        $referral=Referral::findorfail($id);
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
        $referral =  ClientReferral::find();
        return view('referrals.edit',compact('referral'));
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
                'client_id' => 'required',
                'referral_type' => 'required',
                'referral_date' => 'required|before:tomorrow',
                'rec_organisation' => 'required',
                'rec_location' => 'required',
                'client_referral_info' => 'numeric',
                'client_referral_status' => 'required',
                'service_request' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $referral =  ClientReferral::find();
                $referral->client_id = $request->client_id;
                $referral->referral_type = $request->referral_type;
                $referral->referral_date = date("Y-m-d", strtotime($request->referral_date));
                $referral->created_by=Auth::user()->username;
                $referral->save();

                $agency= $referral->ReceivingAgency;
                $agency->referral_id = $referral->id;
                $agency->rec_organisation = $referral->rec_organisation;
                $agency->rec_phone = $referral->rec_phone;
                $agency->rec_contact = $referral->rec_contact;
                $agency->rec_email = $referral->rec_email;
                $agency->rec_location = $referral->rec_location;
                $agency->save();

                $client= $referral->ClientInformation;
                $client->referral_id= $referral->id;
                $client->cl_name=$referral->cl_name;
                $client->cl_address=$referral->cl_address;
                $client->cl_phone=$referral->cl_phone;
                $client->cl_age=$referral->cl_age;
                $client->cl_sex=$referral->cl_sex;
                $client->cl_nationality=$referral->cl_nationality;
                $client->cl_language=$referral->icl_languaged;
                $client->cl_id_number=$referral->cl_id_number;
                $client->cl_care_giver=$referral->cl_care_giver;
                $client->cl_care_giver_relationship=$referral->cl_care_giver_relationship;
                $client->cl_care_giver_contact=$referral->cl_care_giver_contact;
                $client->cl_child_separated=$referral->cl_child_separated;
                $client->cl_care_giver_informed=$referral->cl_care_giver_informed;
                $client->save();

                $reason=$referral->ReferralReason;
                $client->referral_id=$referral->id;
                $client->client_referral_info=$referral->client_referral_info;
                $client->client_referral_status=$referral->client_referral_status;
                $client->client_referral_info_text=$referral->client_referral_info_text;
                $client->client_referral_status_text=$referral->client_referral_status_text;
                $reason->save();

                if(is_object($referral->referralServiceRequested) && count($referral->referralServiceRequested) >0){
                    foreach ($referral->referralServiceRequested as $service){
                        $service->delete();
                    }
                }

                if (isset($request->service_request)) {

                    $service=new ReferralServiceRequested;
                    $service->referral_id=$referral->id;
                    $service->comments=$referral->comments;
                    $reason->save();

                    foreach ($request->service_request as $service){

                        $service=new ReferralServiceRequested;
                        $service->requested_id=$reason->id;
                        $service->service_request=$service;
                        $reason->save();
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $referral =  ClientReferral::find();
        $referral->delete();
    }
}
