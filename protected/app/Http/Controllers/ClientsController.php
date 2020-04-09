<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientVulnerabilityCode;
use App\Country;
use App\DumpClient;
use App\Origin;
use App\PSNCode;
use App\PSNCodeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ResultValidator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Carbon\Carbon;

use App\Helpers\PaginateUtility;
use App\Helpers\AuthUtility;
use App\Helpers\ValidatorUtility;
use App\Helpers\CommonConstant;

class ClientsController extends Controller
{
    protected $import_errors;
    public function __construct()
    {
        $this->middleware('auth');
        $this->import_errors="";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //dd(Auth::user()->level());
        if (Auth::user()->hasPermission('viewer')) {
            $clients=Client::all();
            return view('clients.index',compact('clients'));
        }
        else
        {
            return redirect('home');
        }

    }
    public function showImportErrors()
    {

        if (Auth::user()->hasPermission('edit')) {
            $clients = DumpClient::all();
            return view('clients.importerrors', compact('clients'));
        }
        else
        {
            return redirect('home');
        }
    }
    public function downloadImportErrors()
    { ob_clean();
        $clients = DumpClient::all();
        \Excel::create("list_of_clients_failed_import", function($excel) use($clients)  {
            $excel->sheet('sheet', function($sheet) use($clients){
                $sheet->loadView('clients.excel', compact('clients'));
            });
        })->download('xlsx');
    }

    public function AuthorizeAll()
    {
        //
        if (Auth::user()->hasPermission('authorize')){

            $client=Client::where('auth_status', '=', 'pending')
                ->update([
                    'auth_status' => 'authorized',
                    'auth_by' => Auth::user()->username,
                    'auth_date' => date('Y-m-d H:i')
                ]);

            //Audit trail
            AuditRegister("ClientsController","AuthorizeClientById",$client);

        }else{
            return null;
        }

    }
    public function AuthorizeClientById($id)
    {
        //
        if (Auth::user()->hasPermission('authorize')){

            $client=Client::find($id)
                ->update([
                    'auth_status' => 'authorized',
                    'auth_by' => Auth::user()->username,
                    'auth_date' => date('Y-m-d H:i')
                ]);
            //Audit trail
            AuditRegister("ClientsController","AuthorizeClientById",$client);
        }else{
            return null;
        }
    }

    public function  getJSonClientDataSearch()
    {
        //
        $clients = Client::orderBy('full_name','ASC')->get();
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
            if(strtolower($client->status) =="incomplete")
            {
                $status=' <a href="#" class="label label-danger">'.$client->status.'</a>';
            }
            else
            {
                $status=' <a href="#" class="label label-success">'.$client->status.'</a>';
            }
            $vcolor="label-danger";

            if(is_object($client->vulAssessment) && count($client->vulAssessment) >0)
            {
                $vcolor="label-success";
            }
            $records["data"][] = array(
                $count++,
                $client->client_number,
                $client->individual_id,
                $client->full_name,
                $client->sex,
                $client->age,
                $origin,
                date('d M Y',strtotime($client->date_arrival)),

                '<span id="'.$client->id.'">
                    <a href="#" title="Edit" class="btn btn-icon-only showVulnerability"> <i class="fa fa-file-o text-primary">  </i> Open Form</a>
                   </span>',
            );
        }


        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        echo json_encode($records);
    }

    private function processSortRequest(Request $request, $clients) {
       if ($request->sortField == 'camp') {
            $clients = $clients
                ->join('camps', 'camps.id', '=', 'clients.camp_id')
                ->orderBy('camps.camp_name', $request->sortType);
       } else {
            $clients = $clients->orderBy($request->sortField, $request->sortType);
       }
       return $clients;
    }
    public function findClientList(Request $request) {

        $request->validate([
            'sortField' => 'required',
            'sortType' => 'required|max:5',
            'perPage' => 'required',
            'page' => 'required',
        ]);
        $clients = Client::with('camp', 'fromOrigin');
        $clients = $this->processSortRequest($request,  $clients)->paginate($request->perPage);
        return response()->json([
            'authRole' => AuthUtility::getRoleName(),
            'authPermission' => AuthUtility::getPermissionName(),
            'clients' => $clients,
            'pagination' =>  PaginateUtility::mapPagination($clients),
        ]);
    }

    public function searchClient()
    {
        return view('clients.search');
    }
    public function searchClientPaginated(Request $request) {

        try {
            $validator = Validator::make($request->all(), [
                'sortField' => 'required',
                'sortType' => 'required|max:5',
                'perPage' => 'required',
                'page' => 'required',
                'searchTerm' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => ValidatorUtility::processValidatorErrorMessages($validator),
                ], 422); // 400 being the HTTP code for an invalid request.
            } else {
                $clients = $this->findClientBySearchTerm($request->searchTerm)->paginate($request->perPage);
                return response()->json([
                    'authRole' => AuthUtility::getRoleName(),
                    'authPermission' => AuthUtility::getPermissionName(),
                    'clients' => $clients,
                    'pagination' =>  PaginateUtility::mapPagination($clients),
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 400); // 400 being the HTTP code for an invalid request.
        }

    }

    private function processValidatorErrorMessages(ResultValidator $validator) {
        $errorMessages = array();
        foreach ($validator->getMessageBag()->toArray() as $key => $value) {
            foreach ($value as $childKey => $childValue) {
                $errorMessages[] =   $childValue;
            }
        }
        return $errorMessages;
    }

    private function findClientBySearchTerm($searchTerm) {
        $dbPrefix = DB::getTablePrefix();

        $clientQuery =  Client::leftJoin('camps', 'camps.id', '=', 'clients.camp_id')
            ->leftJoin('origins', 'origins.id', '=', 'clients.origin_id')
            ->where(DB::raw('lower('.$dbPrefix.'clients.full_name)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.client_number)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.sex)'), 'LIKE', '%'. Str::lower($searchTerm). '%' );
        try {
            if (Carbon::createFromFormat('Y-m-d H:i:s', $searchTerm) !== FALSE) {
                $clientQuery = $clientQuery
                    ->orWhereDate('clients.birth_date', 'LIKE', '%'. date("Y-m-d", strtotime($searchTerm)) . '%' )
                    ->orWhereDate('clients.date_arrival', 'LIKE', '%'. date("Y-m-d", strtotime($searchTerm)) . '%' );
            }
        } catch (\Exception $ex) {

        }
        $clientQuery = $clientQuery->orWhere(DB::raw('lower('.$dbPrefix.'clients.hai_reg_number)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
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
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.auth_status)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'camps.camp_name)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'origins.origin_name)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' );
        return $clientQuery;
    }

    public function advancedSearchClient(Request $request)
    {
      try {
          $query=\DB::table('clients');
          $end_time ="";
          $start_time="";
          if($request->start_date != ""){
              $start_time = date("Y-m-d", strtotime($request->start_date));
          }
          if($request->end_date != ""){
              $end_time = date("Y-m-d", strtotime($request->end_date));
          }
          if($request->hai_reg_no != ""){
              $query->where('hai_reg_number','LIKE',"%{$request->hai_reg_no}%");
          }
          if($request->unique_id != ""){
              $query->where('client_number','LIKE',"%{$request->unique_id}%");
          }
          if($request->full_name != ""){
              $query->where('full_name','LIKE',"%{$request->full_name}%");
          }
          if($request->sex != "" && $request->sex != "All"){
              $query->where('sex','=',"$request->sex");
          }
          if($request->age_score != ""){
              $query->where('age_score','=',"$request->age_score");
          }
          if($request->ration_card_number != ""){
              $query->where('ration_card_number','LIKE',"%{$request->ration_card_number}%");
          }
          if($request->ration_card_number != ""){
              $query->where('present_address','LIKE',"%{$request->present_address}%");
          }
          if($request->camp_id != "" && $request->camp_id !="All"){
              $query->where('camp_id','=',"$request->camp_id");
          }
          if($start_time != "" && $end_time !=""){
              $range = [$start_time, $end_time];
              $query->whereBetween('date_arrival', $range);
          }
          elseif($start_time != "" && $end_time ==""){
              $query->where('date_arrival', $start_time);
          }
          elseif($start_time == "" && $end_time !=""){
              $query->where('date_arrival', $end_time);
          }
          /*else{
              $query->where('date_arrival', null);
          }*/

          if ($request->specific_needs != "All" && $request->specific_needs !=""){

              $query->join('client_vulnerability_codes', 'clients.id', '=', 'client_vulnerability_codes.client_id')
                  ->where('code_id', '=', "$request->specific_needs")
                  ->select('clients.*');
          }

          $clients = $query->get();

          $records = array();

          $count = 1;
          foreach ($clients as $client) {
              $camp = "";
              if (is_object(Client::find($client->id)->camp) && Client::find($client->id)->camp != null) {
                  $camp = Client::find($client->id)->camp->camp_name;
              }
              $records[] = array(
                  $count++,
                  $client->hai_reg_number,
                  $client->individual_id,
                  $client->client_number,
                  $client->full_name,
                  $client->sex,
                  $client->age,
                  $client->ration_card_number,
                  $camp,
                  '<label><input type="radio" name="client_id" value="' . $client->id . ' " onclick="getPSNProfile(this.value);"></label>',
              );
          }

          echo json_encode($records);
      }
      catch (\Exception $ex)
      {
          return Response::json(array(
              'success' => false,
              'errors' => 1,
              'messagge' => $ex->getMessage()
          ), 402); // 400 being the HTTP code for an invalid request.
      }

    }
    public function postSearchClient(Request $request)
    {
        $query=\DB::table('clients');
        $end_time ="";
        $start_time="";
        if($request->start_date != ""){
            $start_time = date("Y-m-d", strtotime($request->start_date));
        }
        if($request->end_date != ""){
            $end_time = date("Y-m-d", strtotime($request->end_date));
        }
        if($request->hai_reg_no != ""){
            $query->where('hai_reg_number','LIKE',"%{$request->hai_reg_no}%");
        }
        if($request->unique_id != ""){
            $query->where('client_number','LIKE',"%{$request->unique_id}%");
        }
        if($request->individual_id != ""){
            $query->where('individual_id','LIKE',"%{$request->individual_id}%");
        }
        if($request->full_name != ""){
            $query->where('full_name','LIKE',"%{$request->full_name}%");
        }
        if($request->sex != "" && $request->sex != "All"){
            $query->where('sex','=',"$request->sex");
        }
        if($request->age_score != ""){
            $query->where('age_score','=',"$request->age_score");
        }
        if($request->ration_card_number != ""){
            $query->where('ration_card_number','LIKE',"%{$request->ration_card_number}%");
        }
        if($request->ration_card_number != ""){
            $query->where('present_address','LIKE',"%{$request->present_address}%");
        }
        if($request->camp_id != "" && $request->camp_id !="All"){
            $query->where('camp_id','=',"$request->camp_id");
        }
        if($request->auth_status != "" && $request->auth_status !="All"){
            $query->where('auth_status','=',"$request->auth_status");
        }
        if($start_time != "" && $end_time !=""){
            $range = [$start_time, $end_time];
            $query->whereBetween('date_arrival', $range);
        }
        elseif($start_time != "" && $end_time ==""){
            $query->where('date_arrival', $start_time);
        }
        elseif($start_time == "" && $end_time !=""){
            $query->where('date_arrival', $end_time);
        }
        /*else{
            $query->where('date_arrival', null);
        }*/

        if ($request->specific_needs != "All" && $request->specific_needs !=""){

            $query->join('client_vulnerability_codes', 'clients.id', '=', 'client_vulnerability_codes.client_id')
                ->where('code_id', '=', "$request->specific_needs")
                ->select('clients.*');
        }

        $clients=$query->get();
        return view('clients.clients',compact('clients','request'));

    }
    public function showImport()
    {
        return view('clients.import');
    }
    public function postImport(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'clients_import' => 'required',
                'camp_id' => 'required',

            ]);
            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator)->withInput();

            }

            \DB::table('dump_clients')->truncate();

            $extension= strtolower($request->file('clients_import')->getClientOriginalExtension());
            if($extension !="xlsx" && $extension !="xls")
            {
                return redirect()->back()->with('message', 'Invalid file type! allowed only xls, xlsx')->withInput();
            }

            $file= $request->file('clients_import');
            $destinationPath = public_path() .'/uploads/temp/';
            $filename   = str_replace(' ', '_', $file->getClientOriginalName());

            $file->move($destinationPath, $filename);
            $orfile=$destinationPath . $filename;
            Excel::load($destinationPath . $filename, function ($reader) use($request) {
                $reader->formatDates(false, 'Y-m-d');
                $results= $reader->get();
                $results->each(function($row) use($request) {

            if($row->names != "" && $row->sex !="" && is_numeric($row->age) && $row->marital_status !="" &&
                is_numeric($row->m) &&  is_numeric($row->f) &&  is_numeric($row->t) && $row->origin != "" && $row->date_of_arrival !="" && $row->vul_1 !="" ){
                    $sex ="";
                    if(strtolower($row->sex) =="k" || strtolower($row->sex) =="mk" || strtolower($row->sex) =="f")
                    {
                        $sex = "Female";
                    }
                    else
                    {
                        $sex = "Male";
                    }
                    $client_number=strtoupper(strtolower(preg_replace('/\s+/S', "",$row->unique_id)));
                    $individual_id=ucwords(strtolower(preg_replace('/\s+/S', " ",$row->individual_id)));
                    $full_name=ucwords(strtolower(preg_replace('/\s+/S', " ",$row->names)));
                    $age=intval($row->age);
                    $present_address=ucwords(strtolower(preg_replace('/\s+/S', " ",$row->present_address)));
                    $ration_card_number=strtoupper(strtolower(preg_replace('/\s+/S', "",$row->ration_card_number)));
                    $marital_status=ucwords(strtolower(preg_replace('/\s+/S', "",$row->marital_status)));
                    $spouse_name=ucwords(strtolower(preg_replace('/\s+/S', "",$row->spouse_name)));
                    $care_giver=ucwords(strtolower(preg_replace('/\s+/S', "",$row->name_of_parents)));
                    $date_arrival=null;
                    if($row->date_of_arrival != "") {
                        $date_arrival = date("Y-m-d", strtotime(preg_replace('/\s+/S', "",$row->date_of_arrival)));
                    }

                    $origin="";
                    $origin_name=ucwords(strtolower(preg_replace('/\s+/S', "", $row->origin)));
                    if($origin_name =="Nyarugusu" || $origin_name =="Nyrugusu" || $origin_name =="Nyarugusi"|| $origin_name =="Nyaruguu"){

                        $origin_name="Nyarugusu";
                    }

                    $females_total=intval($row->f);
                    $males_total=intval($row->m);
                    $household_number=$females_total+$males_total;

                    $origin_id="";
                    if($row->origin !="") {
                        if (count(Origin::where('origin_name', '=', $origin_name)->get()) > 0) {
                            $origin = Origin::where('origin_name', '=', $origin_name)->get()->first();
                            $origin_id=$origin->id;
                        } else {
                            $co = new Origin;
                            $co->origin_name = $origin_name;
                            $co->save();
                            $origin = $co;
                            $origin_id=$origin->id;
                        }
                    }

                    if(!count(Client::where('full_name','=',$full_name)
                            ->where('age','=',$age)
                            ->where('sex','=',$sex)
                            ->where('marital_status','=',$marital_status)
                            ->where('date_arrival','=',$date_arrival)
                            ->where('household_number','=',$household_number)
                            ->where('females_total','=',$females_total)
                            ->where('males_total','=',$males_total)
                            ->where('origin_id','=',$origin_id)
                            ->get()) > 0)
                    {



                        $client=new Client;
                        $client->client_number = $client_number;
                        $client->individual_id = $individual_id;
                        $client->full_name = $full_name;

                        $client->sex = $sex;
                        $client->age = $age;
                        if ($age != null) {
                            $agedef=intval(Date("Y")) - $age;
                            $birthdate=$agedef."-01-01";
                            $client->birth_date = $birthdate;
                        }
                        $client->marital_status = $marital_status;
                        $client->spouse_name = $spouse_name;
                        $client->care_giver = $care_giver;

                        $client->date_arrival =$date_arrival;
                        if($origin_id != ""){
                            $client->origin_id = $origin_id;
                        }
                        $client->present_address =$present_address;
                        $client->household_number = $row->t;
                        $client->ration_card_number =$ration_card_number;
                        $client->camp_id = $request->camp_id;
                        $client->females_total = $females_total;
                        $client->males_total = $males_total;
                        $client->created_by = Auth::user()->username;
                        $client->age_score= CommonConstant::getAgeScore($row->age);
                        $client->save();

                        //Generate computer number

                        $psnCodes=array($row->vul_1,$row->vul_2,$row->vul_3,$row->vul_4,$row->vul_5);
                        $hai_psn_code="";
                        foreach ($psnCodes as $data )
                        {
                           if($data != "" && $data != null) {
                               $hai_psn_code .= preg_replace('/\s+/S', "",$data) . "-";
                           }
                        }
                        $hai_psn_code=substr($hai_psn_code,0,strlen($hai_psn_code)-1);
                        $client->hai_reg_number="HAI-".str_pad($client->id,4,'0',STR_PAD_LEFT).$hai_psn_code;
                        $client->save();

                        //Save validation codes
                        foreach ($psnCodes as $codeData )
                        {

                            $code =preg_replace('/\s+/S', "",$codeData);
                            $pcode="";
                            if($code != "")
                            {

                              if (count(PSNCode::where('code', '=',$code)->get()) > 0)
                                {
                                    $pcode = PSNCode::where('code', '=',$code)->get()->first();

                                }
                                else
                                    {

                                        $categorycode="";
                                        $arr=explode('-',$code);
                                        if (isset($arr[0])) {
                                            $categorycode = $arr[0];

                                        }
                                        $psncategory="";

                                        if (count(PSNCodeCategory::where('code','=',$categorycode)->get()) > 0)
                                        {
                                            $psncategory=PSNCodeCategory::where('code','=',$categorycode)
                                                         ->get()->first();


                                        }
                                        else{
                                            $psncate = new PSNCodeCategory;
                                            $psncate->code = $categorycode;
                                            $psncate->description = $categorycode;
                                            $psncate->definition = $categorycode;
                                            $psncate->for_reporting = "Yes";
                                            $psncate->created_by = Auth::user()->username;
                                            $psncate->save();
                                            $psncategory=$psncate;
                                        }
                                        if ($psncategory != "" && $code != "") {

                                            $psc = new PSNCode;
                                            $psc->code = strtoupper(strtolower($code));
                                            $psc->category_id = $psncategory->id;
                                            $psc->description = $code;
                                            $psc->definition = $code;
                                            $psc->for_reporting = "Yes";
                                            $psc->definition = Auth::user()->username;
                                            $psc->save();
                                            $pcode = $psc;
                                        }
                                }
                                if ($pcode != "") {
                                    $codes = new ClientVulnerabilityCode;
                                    $codes->client_id = $client->id;
                                    $codes->code_id = $pcode->id;
                                    $codes->save();
                                }

                            }
                        }

                    }
                }
                else{
                   $filed_error="";

                    if($row->names == "" ){
                        $filed_error .="Names is  Missing-";
                    }
                    if( $row->sex == "" ){
                        $filed_error .="Sex is Missing-";
                    }
                    if(  !is_numeric($row->age)){
                        $filed_error .="Age is Missing-";
                    }
                    if( $row->marital_status == "" ){
                        $filed_error .="Marital Status is Missing-";
                    }
                    if( !is_numeric($row->m) ){
                        $filed_error .="Number of males is Missing-";
                    }
                    if( !is_numeric($row->f)){
                        $filed_error .="Number of females is Missing-";
                    }
                    if( !is_numeric($row->t) ){
                        $filed_error .="HouseHold Number is Missing-";
                    }
                    if( $row->origin ==""){
                        $filed_error .="Origin is Missing-";
                    }
                    if( $row->date_of_arrival == "" ){
                        $filed_error .="date of arrival is Missing-";
                    }
                    if( $row->vul_1 == "" ){
                        $filed_error .="Vulnerability code(s) is Missing-";
                    }
                    $filed_error=substr($filed_error,0,strlen($filed_error)-1);

                    $client =new DumpClient;
                    $client->unique_id=$row->unique_id;
                    $client->individual_id=$row->individual_id;
                    $client->names=$row->names;
                    $client->sex=$row->sex;
					$client->age = $row->age;
                    $client->marital_status=$row->marital_status;
                    $client->name_of_parents=$row->name_of_parents;
                    $client->name_of_spouse=$row->name_of_spouse;
                    $client->m=$row->m;
                    $client->f=$row->f;
                    $client->t=$row->t;
                    $client->origin=$row->origin;
                    $client->date_of_arrival=$row->date_of_arrival;
                    $client->present_address=$row->present_address;
                    $client->ration_card_number=$row->ration_card_number;
                    $client->vul_1=$row->vul_1;
                    $client->vul_2=$row->vul_2;
                    $client->vul_3=$row->vul_3;
                    $client->vul_4=$row->vul_4;
                    $client->vul_5=$row->vul_5;
                    $client->error_descriptions=$filed_error;
                    $client->save();
                    $this->import_errors="Missing filed is marked with red";
                }

            });

            });
            File::delete($orfile);
            //Audit trail


			AuditRegister("ClientsController","Import Clients",$orfile);
            if ($this->import_errors ==""){
                return redirect('clients');
            }
            else
            {
                return redirect('import/clients/errors');
            }


        }
        catch (\Exception $e)
        {
            return  redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::user()->hasPermission('create')) {
            return view('clients.create');
        }
        else{
           return redirect('home');
        }
    }
    public function store(Request $request) {
        //
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'sex' => 'required',
                'age' => 'required',
                'marital_status' => 'required',
                'origin' => 'required',
                'date_arrival' => 'required|before:tomorrow',
                'ration_card_number' => 'required',
                'camp_id' => 'required',
                'vulnerability_code' => 'required',
                'females_total' => 'required',
                'males_total' => 'required',
                'present_address'=> 'required',
                'share_info' => 'required',
                'hh_relation' => 'required',
                'individual_id' => 'required',

            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {

                $client = new Client;
                $client->client_number = strtoupper($request->client_number);
                $client->individual_id = $request->individual_id;
                $client->full_name = ucwords($request->full_name);
                $client->sex = ucwords($request->sex);
                $client->age = $request->age;
                if ($request->age != null) {
                    $agedef=Date("Y") - $request->age;
                    $birthdate=$agedef."-01-01";
                    $client->birth_date = $birthdate;
                }
                $client->marital_status = $request->marital_status;
                $client->spouse_name = $request->spouse_name;
                $client->care_giver = $request->care_giver;
                if($request->date_arrival !="" && $request->date_arrival != null)
                {
                    $client->date_arrival = date("Y-m-d", strtotime("$request->date_arrival"));
                }
                $client->present_address = $request->present_address;
                $client->household_number = $request->household_number;
                $client->ration_card_number = $request->ration_card_number;
                $client->assistance_received = $request->assistance_received;
                $client->problem_specification = $request->problem_specification;
                $client->camp_id = $request->camp_id;
                $client->origin_id=$request->origin;
                $client->present_address = $request->present_address;
                $client->females_total = $request->females_total;
                $client->males_total = $request->males_total;
                $client->present_address = $request->present_address;
                $client->hh_relation = $request->hh_relation;
                $client->share_info= $request->share_info;
                $client->created_by = Auth::user()->username;
                $client->status= $request->status;
                $client->age_score= CommonConstant::getAgeScore($request->age);
                $client->save();

                //Generate computer number
                $vn="";
                foreach ($request->vulnerability_code as $item) {
                    $code=PSNCode::find($item);
                    $vn .= $code->code."-,";
                    $vn=substr($vn,0,strlen($vn)-1);
                }
                $vn=substr($vn,0,strlen($vn)-1);

                $client->hai_reg_number="HAI-".str_pad($client->id,4,'0',STR_PAD_LEFT).$vn;
                $client->save();

                //Save validation codes
                foreach (ClientVulnerabilityCode::where('client_id', '=', $client->id)->get() as $item) {
                    $item->delete();
                }

                foreach ($request->vulnerability_code as $item) {
                    $codes = new ClientVulnerabilityCode;
                    $codes->client_id = $client->id;
                    $codes->code_id = $item;
                    $codes->save();
                }

                //Audit trail
                AuditRegister("ClientsController","Created new  Clients",$client);
                return response()->json([
                    'success' => true,
                    'message' => " Saved Successful"
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
        if (Auth::user()->hasPermission('viewer')) {
            $client = Client::find($id);
            return view('clients.show', compact('client'));
        }
        else{

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
        if (Auth::user()->hasPermission('viewer')) {
            $client = Client::find($id);
            return view('clients.edit', compact('client'));
        }
        else{
            return redirect('home');
        }
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
                'full_name' => 'required',
                'sex' => 'required',
                'age' => 'required',
                'marital_status' => 'required',
                'origin' => 'required',
                'date_arrival' => 'required|before:tomorrow',
                'ration_card_number' => 'required',
                'camp_id' => 'required',
                'vulnerability_code' => 'required',
                'females_total' => 'required',
                'males_total' => 'required',
                'present_address'=> 'required',
                'share_info' => 'required',
                'hh_relation' => 'required',

            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {

                $client =  Client::find($id);
                $client->client_number = strtoupper($request->client_number);
                $client->full_name = ucwords($request->full_name);
                $client->sex = ucwords($request->sex);
                $client->age = $request->age;
                if ($request->age != null) {
                    $agedef=Date("Y") - $request->age;
                    $birthdate=$agedef."-01-01";
                    $client->birth_date = $birthdate;
                }
                $client->marital_status = $request->marital_status;
                $client->spouse_name = $request->spouse_name;
                $client->care_giver = $request->care_giver;
                if($request->date_arrival !="" && $request->date_arrival != null)
                {
                    $client->date_arrival = date("Y-m-d", strtotime("$request->date_arrival"));
                }
                $client->present_address = $request->present_address;
                $client->household_number = $request->household_number;
                $client->ration_card_number = $request->ration_card_number;
                $client->assistance_received = $request->assistance_received;
                $client->problem_specification = $request->problem_specification;
                $client->camp_id = $request->camp_id;
                $client->origin_id=$request->origin;
                $client->present_address = $request->present_address;
                $client->females_total = $request->females_total;
                $client->males_total = $request->males_total;
                $client->present_address = $request->present_address;
                $client->hh_relation = $request->hh_relation;
                $client->share_info= $request->share_info;
                $client->status= $request->status;
                $client->created_by = Auth::user()->username;
                $client->age_score= CommonConstant::getAgeScore($request->age);
                $client->save();


                //Save validation codes
                foreach (ClientVulnerabilityCode::where('client_id', '=', $client->id)->get() as $item) {
                    $item->delete();
                }

                foreach ($request->vulnerability_code as $item) {
                    $codes = new ClientVulnerabilityCode;
                    $codes->client_id = $client->id;
                    $codes->code_id = $item;
                    $codes->save();
                }

                //Audit trail
                AuditRegister("ClientsController","Updated Clients Details",$client);

                return response()->json([
                    'success' => true,
                    'message' => " Saved Successful"
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
        $client=Client::find($id);
        $client->delete();

        //Audit trail
        AuditRegister("ClientsController","Deleted Clients Details",$client);
    }
    //This here for testing otoman
    public function createClient(){
      $client = new Client;
      $client->client_number = 45;
      $client->full_name = "Alyoce Godson";
      $client->sex = "Male";
      $client->age = 23;
      $client->marital_status = "Citizen";
      $client->spouse_name = "Grace Otuman";
      $client->origin = "Tanzania";
      $client->country_id = 34;
      $client->date_arrival = date("Y-m-d");
      $client->present_address = "23 Hamilton";
      $client->household_number = 3;
      $client->ration_card_number =600;
      $client->camp_id = 3;
      $client->created_by = Auth::user()->username;
      $client->save();
    }
}
