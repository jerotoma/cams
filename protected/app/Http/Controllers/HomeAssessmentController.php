<?php

namespace App\Http\Controllers;

use App\Client;
use App\HomeAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Helpers\PaginateUtility;
use App\Helpers\AuthUtility;
use App\Helpers\ValidatorUtility;
use DB;
use Log;

class HomeAssessmentController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('assessments.home.index');
    }
    public function AuthorizeAll() {
        //
        if (Auth::user()->hasPermission('authorize')){
            $assessments = HomeAssessment::where('auth_status', '=', 'pending')
                ->update([
                    'auth_status' => 'authorized',
                    'auth_by' => Auth::user()->username,
                    'auth_date' => date('Y-m-d H:i')
                ]);
            //Audit trail
            AuditRegister("HomeAssessmentController","AuthorizeAllAssessments",$assessments);

        }else{
            return null;
        }

    }
    public function AuthorizeAssessmentById($id)
    {
        //
        if (Auth::user()->hasPermission('authorize')){

            $assessments=HomeAssessment::find($id)
                ->update([
                    'auth_status' => 'authorized',
                    'auth_by' => Auth::user()->username,
                    'auth_date' => date('Y-m-d H:i')
                ]);
            //Audit trail
            AuditRegister("HomeAssessmentController","AuthorizeAssessmentById",$assessments);
        }else{
            return null;
        }
    }
    public function downloadPDF($id) {

        $assessment=HomeAssessment::findorfail($id);

         $pdf = \PDF::loadView('assessments.home.show',compact('assessment'))
            ->setOption('footer-center', '[page]')
            ->setOption('page-offset', 0);
        return $pdf->download('PSN_Home_Assessments_form.pdf');
    }
    public function getPSNProfile($id)
    {
        $client=Client::findorfail($id);
        return view('assessments.home.psnprofile',compact('client'));

    }

    public function showClients()
    {
        return view('assessments.home.listclients');
    }

    private function processSortRequest(Request $request, $assessments) {
        if ($request->sortField == 'camp') {
            $assessments = $assessments
                 ->orderBy('camps.camp_name', $request->sortType);
        } else {
            $assessments = $assessments->orderBy($request->sortField, $request->sortType);
        }
        return $assessments;
     }

    public function findHomeAssessments(Request $request) {
        //
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
                $dataType = config('database.default') == 'pgsql' ? 'INTEGER' : 'UNSIGNED';
                $db_prefix = config('database.default') == 'pgsql' ? '' : 'cams_';
                $assessments = HomeAssessment::join('clients', 'clients.id', '=', 'home_assessments.client_id')
                    ->join('origins', 'origins.id', '=', 'clients.origin_id')
                    ->join('camps', 'camps.id', '=', 'clients.camp_id');
                $assessments = $this->getSelectItems($assessments);

                $assessments = $this->processSortRequest($request,  $assessments)->paginate($request->perPage);
                return response()->json([
                    'authRole' => AuthUtility::getRoleName(),
                    'authPermission' => AuthUtility::getPermissionName(),
                    'homeAssessments' => $assessments,
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

    private function getSelectItems($assessments) {
        return $assessments->select(
            'home_assessments.id AS assessment_id',
            'home_assessments.case_worker_name',
            'home_assessments.case_code',
            'home_assessments.needs_description',
            'home_assessments.assessment_date',
            'home_assessments.auth_status AS assessment_auth_status',
            'home_assessments.findings',
            'home_assessments.diagnosis',
            'home_assessments.organization',
            'home_assessments.final_decision',
            'home_assessments.recommendations',
            'home_assessments.linked_case_code',
            'clients.*',
            'camps.camp_name'
        );
    }

    private function findVulnerabilityBySearchTerm($searchTerm) {
        $dataType = config('database.default') == 'pgsql' ? 'INTEGER' : 'UNSIGNED';
        $dbPrefix = DB::getTablePrefix();

        $assessments = HomeAssessment::join('clients', 'clients.id', '=', 'home_assessments.client_id')
            ->leftJoin('camps', 'camps.id', '=', 'clients.camp_id')
            ->leftJoin('origins', 'origins.id', '=', 'clients.origin_id');
        $assessments = $this->getSelectItems($assessments);
        $assessments = $assessments->where(DB::raw('lower('.$dbPrefix.'home_assessments.q1_1)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'home_assessments.case_worker_name)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'home_assessments.case_code)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'home_assessments.needs_description)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'home_assessments.auth_status)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'home_assessments.findings)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'home_assessments.diagnosis)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'home_assessments.organization)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'home_assessments.final_decision)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'home_assessments.recommendations)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'home_assessments.linked_case_code)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            //Client
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
                    $assessments = $assessments->orWhereDate('clients.birth_date', 'LIKE', '%'. date("Y-m-d", strtotime($searchTerm)) . '%' )
                        ->orWhereDate('clients.date_arrival', 'LIKE', '%'. date("Y-m-d", strtotime($searchTerm)) . '%' );
                }
            } catch (\Exception $ex) {
                Log::debug('Invalid Date. ', [
                    'user_id' => Auth::user()->id,
                    'errors' => $ex->getMessage()]);
            }
             //Camp
            $assessments = $assessments
            ->orWhere(DB::raw('lower('.$dbPrefix.'camps.camp_name)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            //Origin
            ->orWhere(DB::raw('lower('.$dbPrefix.'origins.origin_name)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' );

        return $assessments;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('assessments.home.create');
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
                'assessment_date' => 'required|before:tomorrow',
                'case_code' => 'required'



            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $assessment = new HomeAssessment;
                $assessment->client_id = $request->client_id;
                $assessment->case_code = $request->case_code;
                $assessment->linked_case_code = $request->Linked_case_code;
                $assessment->assessment_date = $request->assessment_date;
                $assessment->needs_description = $request->needs_description;
                $assessment->findings = $request->findings;
                $assessment->diagnosis = $request->diagnosis;
                $assessment->recommendations = $request->recommendations;
                $assessment->final_decision = $request->final_decision;
                $assessment->case_worker_name = $request->case_worker_name;
                $assessment->project_coordinator = $request->project_coordinator;
                $assessment->organization = $request->organization;
                $assessment->created_by = Auth::user()->username;
                $assessment->save();
                return response()->json([
                    'success' => true,
                    'message' => "Saved Successful"
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
        $assessment=HomeAssessment::findorfail($id);
        return view('assessments.home.show',compact('assessment'));
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
        $assessment=HomeAssessment::findorfail($id);
        return view('assessments.home.edit',compact('assessment'));
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
                'assessment_date' => 'required|before:tomorrow',
                'case_code' => 'required'
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $assessment =  HomeAssessment::find($id);
                $assessment->case_code = $request->case_code;
                $assessment->linked_case_code = $request->Linked_case_code;
                $assessment->assessment_date = $request->assessment_date;
                $assessment->needs_description = $request->needs_description;
                $assessment->findings = $request->findings;
                $assessment->diagnosis = $request->diagnosis;
                $assessment->recommendations = $request->recommendations;
                $assessment->final_decision = $request->final_decision;
                $assessment->case_worker_name = $request->case_worker_name;
                $assessment->project_coordinator = $request->project_coordinator;
                $assessment->organization = $request->organization;
                $assessment->updated_by = Auth::user()->username;
                $assessment->save();
                return response()->json([
                    'success' => true,
                    'message' => "Saved Successful"
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
        $assessment =  HomeAssessment::find($id)->delete();
    }
}
