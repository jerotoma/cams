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
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Helpers\PaginateUtility;
use App\Helpers\AuthUtility;
use App\Helpers\ValidatorUtility;
use DB, Log;

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
        if (Auth::user()->hasPermission('authorize')){

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
        if (Auth::user()->hasPermission('authorize')){

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


    public function downloadPDF($id) {
        $referral = ClientReferral::find($id);
         $pdf = \PDF::loadView('referrals.show', compact('referral'))
            ->setOption('footer-center', '[page]')
            ->setOption('page-offset', 0);
        return $pdf->download('Client_Referral_form.pdf');
    }

    private function processSortRequest(Request $request, $referrals) {
        return $referrals->orderBy($request->sortField, $request->sortType);;
     }


    public function getReferralList(Request $request) {

        try {

            $validator = Validator::make($request->all(), [
                'sortField' => 'required',
                'sortType' => 'required|max:5',
                'perPage' => 'required',
                'page' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => ValidatorUtility::processValidatorErrorMessages($validator),
                ], 422); // 400 being the HTTP code for an invalid request.
            } else {
                $referrals = ClientReferral::join('clients', 'clients.id', '=', 'client_referrals.client_id')
                    ->join('camps', 'camps.id', '=', 'clients.camp_id')
                    ->select(
                        'client_referrals.id AS referralId',
                        'client_referrals.referral_date',
                        'client_referrals.reference_no',
                        'client_referrals.referral_type',
                        'client_referrals.auth_status AS referralAuthStatus',
                        'client_referrals.referral_date',
                        'client_referrals.status AS referral_status',
                        'camps.camp_name',
                        'clients.*'
                    );
                $referrals = $this->processSortRequest($request,  $referrals)->paginate($request->perPage);
                return response()->json([
                    'authRole' => AuthUtility::getRoleName(),
                    'authPermission' => AuthUtility::getPermissionName(),
                    'referrals' => $referrals,
                    'pagination' =>  PaginateUtility::mapPagination($referrals),
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 400); // 400 being the HTTP code for an invalid request.
        }
    }

    public function searchReferralPaginated(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'sortField' => 'required',
                'sortType' => 'required|max:5',
                'perPage' => 'required',
                'page' => 'required',
                'searchTerm' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => ValidatorUtility::processValidatorErrorMessages($validator),
                ], 422); // 400 being the HTTP code for an invalid request.
            } else {
                $assessments = $this->processSortRequest($request,  $this->findReferralBySearchTerm($request->searchTerm))->paginate($request->perPage);
                return response()->json([
                    'authRole' => AuthUtility::getRoleName(),
                    'authPermission' => AuthUtility::getPermissionName(),
                    'referrals' => $assessments,
                    'pagination' =>  PaginateUtility::mapPagination($assessments),
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 400); // 400 being the HTTP code for an invalid request.
        }
    }
    private function findReferralBySearchTerm($searchTerm) {
        $dataType = config('database.default') == 'pgsql' ? 'INTEGER' : 'UNSIGNED';
        $dbPrefix = DB::getTablePrefix();
        $referrals = ClientReferral::join('clients', 'clients.id', '=', 'client_referrals.client_id')
            ->leftJoin('camps', 'camps.id', '=', 'clients.camp_id')
            ->leftJoin('origins', 'origins.id', '=', 'clients.origin_id')
            ->select(
                'client_referrals.id AS referralId',
                'client_referrals.referral_date',
                'client_referrals.reference_no',
                'client_referrals.referral_type',
                'client_referrals.auth_status AS referralAuthStatus',
                'client_referrals.status AS referral_status',
                'camps.camp_name',
                'clients.*'
            )
            ->where(DB::raw('lower('.$dbPrefix.'client_referrals.status)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'client_referrals.reference_no)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'client_referrals.auth_status)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'client_referrals.referral_type)'), 'LIKE', '%'. Str::lower($searchTerm) . '%');
            try {
                if (Carbon::createFromFormat('Y-m-d H:i:s', $searchTerm) !== FALSE) {
                    $referrals = $referrals->orWhereDate('clients.birth_date', 'LIKE', '%'. date("Y-m-d", strtotime($searchTerm)) . '%' )
                        ->orWhereDate('client_referrals.referral_date', 'LIKE', '%'. date("Y-m-d", strtotime($searchTerm)) . '%' );
                }
            } catch (\Exception $ex) {
                Log::debug('Invalid Date. ', [
                    'user_id' => Auth::user()->id,
                    'errors' => $ex->getMessage()]);
            }
            //Client
            $referrals = $referrals
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.full_name)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.client_number)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.sex)'), 'LIKE', '%'. Str::lower($searchTerm). '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.hai_reg_number)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.age_score)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.marital_status)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.care_giver)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.child_care_giver)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.present_address)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere('clients.females_total', 'LIKE', '%'. $searchTerm . '%' )
            ->orWhere('clients.males_total', 'LIKE', '%'. $searchTerm . '%' )
            ->orWhere('clients.household_number', 'LIKE', '%'. $searchTerm . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.ration_card_number)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.assistance_received)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.problem_specification)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.status)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.share_info)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.hh_relation)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.auth_status)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' );
            try {
                if (Carbon::createFromFormat('Y-m-d H:i:s', $searchTerm) !== FALSE) {
                    $referrals = $referrals->orWhereDate('clients.birth_date', 'LIKE', '%'. date("Y-m-d", strtotime($searchTerm)) . '%' )
                        ->orWhereDate('clients.date_arrival', 'LIKE', '%'. date("Y-m-d", strtotime($searchTerm)) . '%' );
                }
            } catch (\Exception $ex) {
                Log::debug('Invalid Date. ', [
                    'user_id' => Auth::user()->id,
                    'errors' => $ex->getMessage()]);
            }
             //Camp
             $referrals = $referrals
            ->orWhere(DB::raw('lower('.$dbPrefix.'camps.camp_name)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            //Origin
            ->orWhere(DB::raw('lower('.$dbPrefix.'origins.origin_name)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' );
        return $referrals;
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
