<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientVulnerabilityCode;
use App\Country;
use App\Origin;
use App\PSNCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ClientsController extends Controller
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
        if (Auth::user()->can('viewer')){
            $clients=Client::all();
            return view('clients.index',compact('clients'));
        }
        else
        {
            return redirect('home');
        }

    }
    public function AuthorizeAll()
    {
        //
        if (Auth::user()->can('authorize')){

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
        if (Auth::user()->can('authorize')){

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
    public function getJSonDataSearch()
    {
        //

        $clients=Client::orderBy('full_name','ASC')->get();
        $iTotalRecords =count(Client::all());
        $sEcho = intval(10);

        $records = array();
        $records["data"] = array();


        $count=1;
        foreach($clients as $client) {
            $origin = "";
            $status = "";
            $datearv = "";
            $camp = "";
            if (is_object($client->fromOrigin) && $client->fromOrigin != null) {
                $origin = $client->fromOrigin->origin_name;
            }
            if (is_object($client->camp) && $client->camp != null) {
                $camp = $client->camp->camp_name;
            }
            if ($client->date_arrival != "" && $client->date_arrival != null) {
                $datearv = date('d M Y', strtotime($client->date_arrival));
            }


            if ($client->auth_status == "pending")
            {
                if (Auth::user()->can('authorize'))
                {
                    $records["data"][] = array(
                        $count++,
                        $client->hai_reg_number,
                        $client->full_name,
                        $client->sex,
                        $client->age,
                        $client->ration_card_number,
                        $datearv,
                        $camp,
                        $client->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                              <li id="' . $client->id . '"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="' . $client->id . '"><a href="#" class="authorizeRecord label "><i class="fa fa-check "></i> Authorize </a></li>
                             <li id="' . $client->id . '"><a href="#" class="editRecord label "><i class="fa fa-pencil "></i> Edit </a></li>
                             <li id="' . $client->id . '"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'

                    );
                }
                elseif (Auth::user()->hasRole('inputer'))
                {
                    $records["data"][] = array(
                        $count++,
                        $client->hai_reg_number,
                        $client->full_name,
                        $client->sex,
                        $client->age,
                        $client->ration_card_number,
                        $datearv,
                        $camp,
                        $client->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                              <li id="' . $client->id . '"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="' . $client->id . '"><a href="#" class="editRecord label "><i class="fa fa-pencil "></i> Edit </a></li>
                             <li id="' . $client->id . '"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'

                    );
                }
            }
            else{
                if (Auth::user()->hasRole('admin'))
                {
                    $records["data"][] = array(
                        $count++,
                        $client->hai_reg_number,
                        $client->full_name,
                        $client->sex,
                        $client->age,
                        $client->ration_card_number,
                        $datearv,
                        $camp,
                        $client->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                              <li id="' . $client->id . '"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="' . $client->id . '"><a href="#" class="editRecord label "><i class="fa fa-pencil "></i> Edit </a></li>
                             <li id="' . $client->id . '"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'

                    );
                }
                else {
                    $records["data"][] = array(
                        $count++,
                        $client->hai_reg_number,
                        $client->full_name,
                        $client->sex,
                        $client->age,
                        $client->ration_card_number,
                        $datearv,
                        $camp,
                        $client->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                              <li id="' . $client->id . '"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
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
    public function searchClient()
    {
        return view('clients.search');
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
          else{
              $query->where('date_arrival', null);
          }

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
        else{
            $query->where('date_arrival', null);
        }

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

            if($row->names != "" && $row->names != null && $row->sex != "" && $row->sex != null){
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
                    $household_number=intval($row->t);
                    $females_total=intval($row->f);
                    $males_total=intval($row->m);

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
                            //where('client_number','=',$client_number)
                            ->where('age','=',$age)
                            ->where('sex','=',$sex)
                            ->where('marital_status','=',$marital_status)
                            ->where('spouse_name','=',$spouse_name)
                            ->where('care_giver','=',$care_giver)
                            ->where('date_arrival','=',$date_arrival)
                            ->where('household_number','=',$household_number)
                            ->where('females_total','=',$females_total)
                            ->where('males_total','=',$males_total)
                            //->where('present_address','=',$present_address)
                            ->where('origin_id','=',$origin_id)
                            ->where('ration_card_number','=',$ration_card_number)->get()) > 0)
                    {



                        $client=new Client;
                        $client->client_number = $client_number;
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
                        $client->age_score= $this->getAgeScore($row->age);
                        $client->save();

                        //Generate computer number

                        $psnCodes=array($row->vul_1,$row->vul_2,$row->vul_3,$row->vul_4,$row->vul_5);
                        $hai_psn_code="";
                        foreach ($psnCodes as $data )
                        {
                           if($data != "" && $data != null) {
                               $hai_psn_code .= $data . "-";
                           }
                        }
                        $hai_psn_code=substr($hai_psn_code,0,strlen($hai_psn_code)-1);
                        $client->hai_reg_number="HAI-".str_pad($client->id,4,'0',STR_PAD_LEFT).$hai_psn_code;
                        $client->save();

                        $vn="";
                        foreach ($psnCodes as $data ){
                            $vn .= $data."-,";
                            $vn=substr($vn,0,strlen($vn)-1);
                        }
                        //Save validation codes

                        foreach ($psnCodes as $data )
                        {

                            $pcode="";
                            if($data != "" && $data != null) {
                                if (count(PSNCode::where('code', '=', strtoupper(strtolower($data)))->get()) > 0) {
                                    $pcode = PSNCode::where('code', '=', strtoupper(strtolower($data)))->get()->first();
                                } else {
                                    $psc = new PSNCode;
                                    $psc->code = strtoupper(strtolower($data));
                                    $psc->save();
                                    $pcode = $psc;
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
            });

            });
            File::delete($orfile);
            //Audit trail
            AuditRegister("ClientsController","Import Clients",$orfile);
           return redirect('clients');
        }
        catch (\Exception $e)
        {
            //echo $e->getMessage();
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
        if (Auth::user()->can('create')) {
            return view('clients.create');
        }
        else{
           return redirect('home');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Culculate age score
    public function getAgeScore($age){

        if($age <=17 ){
            return "A";
        }
        else if($age >17 && $age < 50){
            return "B";
        }
        else if($age >=50 && $age < 60){
            return "C";
        }
        else if($age >= 60 ){
            return "D";
        }
    }

    public function store(Request $request)
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

                $client = new Client;
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
                $client->created_by = Auth::user()->username;
                $client->status= $request->status;
                $client->age_score= $this->getAgeScore($request->age);
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
        if (Auth::user()->can('viewer')) {
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
        if (Auth::user()->can('viewer')) {
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
                $client->age_score= $this->getAgeScore($request->age);
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
