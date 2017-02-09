<?php

namespace App\Http\Controllers;

use App\Client;
use App\Referral;
use Illuminate\Http\Request;
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
        $referral=Referral::find($id);
        $fo = 'This form is applicable for identification of functional needs of PWDs/PSNs according to the components <br/>of the Global CBR matrix ( Health , Education ,  Livelihood , social and Empowerment ).';
        $pdf = \PDF::loadView('referrals.show', compact('referral'))
            ->setOption('footer-center', '[page]')
            ->setOption('page-offset', 0);
        return $pdf->download('Client_Referral_form.pdf');
    }

    public function getReferralList()
    {
        //
        $referrals=Referral::all();
        $iTotalRecords =count(Referral::all());
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
                $referral->client->client_number,
                $referral->client->full_name,
                $referral->progress_number,
                $referral->case_name,
                $referral->referral_date,
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
                'organization' => 'required',
                'progress_number' => 'required',
                'referral_date' => 'required',
                'completed_by' => 'required',
                'age' => 'numeric',
                'case_name' => 'required',
                'referred_to' => 'required',
                'primary_concern' => 'required',
                'org_email'=> 'email'
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $referral = new Referral;
                $referral->client_id = $request->client_id;
                $referral->progress_number = $request->progress_number;
                $referral->case_name = $request->case_name;
                $referral->referral_date = date("Y-m-d", strtotime($request->referral_date));
                $referral->completed_by = $request->completed_by;
                $referral->location = $request->location;
                $referral->age = $request->age;
                $referral->birth_date = date("Y-m-d", strtotime($request->birth_date));
                $referral->disabilities = $request->disabilities;
                $referral->ethnic_background = $request->ethnic_background;
                $referral->contact = $request->contact;
                $referral->phone = $request->phone;
                $referral->person_name = $request->person_name;
                $referral->person_name_contact = $request->person_name_contact;
                $referral->relationship = $request->relationship;
                $referral->person_name_address = $request->person_name_address;
                $referral->consent = $request->consent;
                $referral->parental_consent = $request->parental_consent;
                $referral->attachment = $request->attachment;
                $referral->initial_action = $request->initial_action;
                $referral->time_frames = $request->time_frames;
                $referral->additional_comments = $request->additional_comments;
                $referral->primary_concern = $request->primary_concern;
                $referral->print_name = $request->print_name;
                $referral->referred_to = $request->referred_to;
                $referral->referred_to_position = $request->referred_to_position;
                $referral->organization = $request->organization;
                $referral->org_phone = $request->org_phone;
                $referral->org_email = $request->org_email;
                $referral->save();
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
        $referral=Referral::findorfail($id);
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
                'organization' => 'required',
                'progress_number' => 'required',
                'referral_date' => 'required',
                'completed_by' => 'required',
                'age' => 'numeric',
                'case_name' => 'required',
                'referred_to' => 'required',
                'primary_concern' => 'required',
                'org_email'=> 'email'
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
            $referral =  Referral::find($id);
            $referral->progress_number = $request->progress_number;
            $referral->case_name = $request->case_name;
            $referral->referral_date = date("Y-m-d", strtotime($request->referral_date));
            $referral->completed_by = $request->completed_by;
            $referral->location = $request->location;
            $referral->age = $request->age;
            $referral->birth_date = date("Y-m-d", strtotime($request->birth_date));
            $referral->disabilities = $request->disabilities;
            $referral->ethnic_background = $request->ethnic_background;
            $referral->contact = $request->contact;
            $referral->phone = $request->phone;
            $referral->person_name = $request->person_name;
            $referral->person_name_contact = $request->person_name_contact;
            $referral->relationship = $request->relationship;
            $referral->person_name_address = $request->person_name_address;
            $referral->consent = $request->consent;
            $referral->parental_consent = $request->parental_consent;
            $referral->attachment = $request->attachment;
            $referral->initial_action = $request->initial_action;
            $referral->time_frames = $request->time_frames;
            $referral->additional_comments = $request->additional_comments;
            $referral->primary_concern = $request->primary_concern;
            $referral->print_name = $request->print_name;
            $referral->referred_to = $request->referred_to;
            $referral->referred_to_position = $request->referred_to_position;
            $referral->organization = $request->organization;
            $referral->org_phone = $request->org_phone;
            $referral->org_email = $request->org_email;
            $referral->save();
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
        $referral=Referral::findorfail($id);
        $referral->delete();
    }
}
