<?php

namespace App\Http\Controllers;

use App\Camp;
use App\CashProvision;
use App\CashProvisionClient;
use App\Client;
use App\ClientVulnerabilityCode;
use App\DumpCashDistribution;
use App\Origin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CashProvisionController extends Controller
{
     protected  $error_found;
     protected   $import_errors;
    public function __construct()
    {
        $this->middleware('auth');
        $this->error_found="";
        $this->import_errors="";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AuthorizeAll()
    {
        //
        if (Auth::user()->hasPermission('authorize')){

            $provisions=CashProvision::where('auth_status', '=', 'pending')
                ->update([
                    'auth_status' => 'authorized',
                    'auth_by' => Auth::user()->username,
                    'auth_date' => date('Y-m-d H:i')
                ]);

            //Audit trail
            AuditRegister("CashProvisionController","AuthorizeAll",$provisions);

        }else{
            return null;
        }

    }
    public function AuthorizeCashProvisionById($id)
    {
        //
        if (Auth::user()->hasPermission('authorize')){

            $provisions=CashProvision::find($id)
                ->update([
                    'auth_status' => 'authorized',
                    'auth_by' => Auth::user()->username,
                    'auth_date' => date('Y-m-d H:i')
                ]);
            //Audit trail
            AuditRegister("CashProvisionController","AuthorizeCashProvisionById",$provisions);
        }else{
            return null;
        }
    }

    public function showImportErrors()
    {

        if (Auth::user()->hasPermission('edit')) {
            $clients=DumpCashDistribution::all();
            return view('cash.provision.importerrors',compact('clients'));
        }
        else
        {
            return redirect('home');
        }
    }
    public function downloadImportErrors()
    { ob_clean();
        $clients = DumpCashDistribution::all();
        \Excel::create("list_of_clients_failed_import", function($excel) use($clients)  {
            $excel->sheet('sheet', function($sheet) use($clients){
                $sheet->loadView('cash.provision.excel',compact('clients'));
            });
        })->download('xlsx');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getCashProvisionsList()
    {
        //
        $provisions=CashProvision::all();
        $iTotalRecords =count(CashProvision::all());
        $sEcho = intval(10);

        $records = array();
        $records["data"] = array();


        $count=1;
        foreach($provisions as $provision) {

            $camp_name="";
            if (is_object($provision->camp) && is_object($provision->camp)){
                $camp_name =$provision->camp->camp_name;
            }

            if ($provision->auth_status == "pending") {
                if (Auth::user()->hasPermission('authorize')) {
                    $records["data"][] = array(
                        $count++,
                        $provision->provision_date,
                        $provision->provided_by,
                        $provision->comments,
                        $camp_name,
                        $provision->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$provision->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$provision->id.'"><a href="#" class=" label " onclick="printPage(\''.url('print/cash/monitoring/provision').'/'.$provision->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$provision->id.'"><a href="'.url('download/pdf/cash/monitoring/provision').'/'.$provision->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
                             <li id="'.$provision->id.'"><a href="#" class="authorizeRecord label "><i class="fa fa-check "></i> Authorize </a></li>
                             <li id="'.$provision->id.'"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'
                    );
                }
                elseif (Auth::user()->hasRole('inputer'))
                {
                    $records["data"][] = array(
                        $count++,
                        $provision->provision_date,
                        $provision->provided_by,
                        $provision->comments,
                        $camp_name,
                        $provision->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$provision->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$provision->id.'"><a href="#" class=" label " onclick="printPage(\''.url('print/cash/monitoring/provision').'/'.$provision->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$provision->id.'"><a href="'.url('download/pdf/cash/monitoring/provision').'/'.$provision->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
                             <li id="'.$provision->id.'"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
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
                        $provision->provision_date,
                        $provision->provided_by,
                        $provision->comments,
                        $camp_name,
                        $provision->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$provision->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$provision->id.'"><a href="#" class=" label " onclick="printPage(\''.url('print/cash/monitoring/provision').'/'.$provision->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$provision->id.'"><a href="'.url('download/pdf/cash/monitoring/provision').'/'.$provision->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
                             <li id="'.$provision->id.'"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'
                    );
                }
                else{
                    $records["data"][] = array(
                        $count++,
                        $provision->provision_date,
                        $provision->provided_by,
                        $provision->comments,
                        $camp_name,
                        $provision->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$provision->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$provision->id.'"><a href="#" class=" label " onclick="printPage(\''.url('print/cash/monitoring/provision').'/'.$provision->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$provision->id.'"><a href="'.url('download/pdf/cash/monitoring/provision').'/'.$provision->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
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
    public function index()
    {
        //
        $provisions=CashProvision::all();

        //Audit trail
        AuditRegister("CashProvisionController","View All Cash distributions","");

        return view('cash.provision.index',compact('provisions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cash.provision.create');
    }
    public function showBulk()
    {
        //
        return view('cash.provision.bulk');
    }
    public function postBulk(Request $request)
    {
        //
        try {
            $validator = Validator::make($request->all(), [
                'provision_date' => 'required|before:tomorrow',
                'camp_id' => 'required',
                'activity_id' => 'required',
                'import_type' => 'required',
                'cash_distribution_file' => 'required',
            ]);
            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator)->withInput();

            }

            $extension= strtolower($request->file('cash_distribution_file')->getClientOriginalExtension());
            if($extension !="xlsx" && $extension !="xls")
            {
                return redirect()->back()->with('message', 'Invalid file type! allowed only xls, xlsx')->withInput();
            }

            \DB::table('dump_cash_distributions')->truncate();

            if (!isActivityOutOfFundsbyID($request->activity_id)) {

                $file = $request->file('cash_distribution_file');
                $destinationPath = public_path() . '/uploads/temp/';
                $filename = str_replace(' ', '_', $file->getClientOriginalName());
                $file->move($destinationPath, $filename);
                $orfile=$destinationPath . $filename;

                Excel::load($destinationPath . $filename, function ($reader) use ($request) {
                    $reader->formatDates(false, 'Y-m-d');
                    $results = $reader->get();



                        if ($request->import_type == 2 ) {
                            $provision=new CashProvision;
                            $provision->provision_date=$request->provision_date;
                            $provision->provided_by=$request->provided_by;
                            $provision->comments=$request->comments;
                            $provision->camp_id=$request->camp_id;
                            $provision->created_by=Auth::user()->username;
                            $provision->activity_id =$request->activity_id;
                            $provision->save();

                            //Audit trail
                            AuditRegister("CashProvisionController","Created CashProvision",$provision);

                            $results->each(function ($row) use ($provision,$request) {

                                if($row->names != "" && $row->sex !="" && is_numeric($row->age) && $row->marital_status !="" &&
                                 is_numeric($row->m) &&  is_numeric($row->f) &&  is_numeric($row->t) &&
								 $row->origin != "" && $row->date_of_arrival !="" && $row->vul_1 !=""  && is_numeric($row->amount) )
                                {
									$sex ="";
									if(strtolower($row->sex) =="k" || strtolower($row->sex) =="mk" || strtolower($row->sex) =="f")
									{
										$sex = "Female";
									}
									else
									{
										$sex = "Male";
									}
									$full_name=ucwords(strtolower(preg_replace('/\s+/S', " ",$row->names)));
									$age=intval($row->age);
									$marital_status=ucwords(strtolower(preg_replace('/\s+/S', "",$row->marital_status)));
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
										}
									}
                                    $amount = intval($row->amount);

                                    if(count(Client::where('full_name','=',$full_name)
											->where('age','=',$age)
											->where('sex','=',$sex)
											->where('marital_status','=',$marital_status)
											->where('date_arrival','=',$date_arrival)
											->where('household_number','=',$household_number)
											->where('females_total','=',$females_total)
											->where('males_total','=',$males_total)
											->where('origin_id','=',$origin_id)
											->where('camp_id','=',$request->camp_id)
											->get()) > 0)
                                 {

                                     $client = Client::where('full_name','=',$full_name)
											->where('age','=',$age)
											->where('sex','=',$sex)
											->where('marital_status','=',$marital_status)
											->where('date_arrival','=',$date_arrival)
											->where('household_number','=',$household_number)
											->where('females_total','=',$females_total)
											->where('males_total','=',$males_total)
											->where('origin_id','=',$origin_id)
											->where('camp_id','=',$request->camp_id)
											->get()->first();


                                        if ($client != null && count($client) > 0) {

                                            if (!hasClientReachedProvisionLimit($request->activity_id, $client->id,$provision->provision_date)) {


                                                if (!isActivityOutOfFunds($request->activity_id, $row->amount)) {

                                                    if (!isActivityOutOfFunds($request->activity_id, $row->amount)) {
                                                        $provision_client = new CashProvisionClient;
                                                        $provision_client->client_id = $client->id;
                                                        $provision_client->activity_id = $request->activity_id;
                                                        $provision_client->amount = $amount;
                                                        $provision_client->provision_id = $provision->id;
                                                        $provision_client->provision_date = $provision->provision_date;
                                                        $provision_client->save();

                                                        //Audit trail
                                                        AuditRegister("CashProvisionController","Created CashProvisionClient",$provision_client);
                                                        //Deduct money
                                                        deductActivityAmount($request->activity_id, $amount);

                                                    }
													else
													{
														$client =new DumpCashDistribution;
														$client->names=$row->names;
														$client->sex=$row->sex;
														$client->age = $row->age;
														$client->marital_status=$row->marital_status;
														$client->m=$row->m;
														$client->f=$row->f;
														$client->t=$row->t;
														$client->origin=$row->origin;
														$client->date_of_arrival=$row->date_of_arrival;
														$client->vul_1=$row->vul_1;
														$client->amount=intval($row->amount);
														$client->error_descriptions="Insufficient Funds";
														$client->save();
														$this->import_errors="Missing filed is marked with red";
													}

                                                }

                                            }
											else
											{
												$client =new DumpCashDistribution;
												$client->names=$row->names;
												$client->sex=$row->sex;
												$client->age = $row->age;
												$client->marital_status=$row->marital_status;
												$client->m=$row->m;
												$client->f=$row->f;
												$client->t=$row->t;
												$client->origin=$row->origin;
												$client->date_of_arrival=$row->date_of_arrival;
												$client->vul_1=$row->vul_1;
												$client->amount=intval($row->amount);
												$client->error_descriptions="Client is in cash provision limit";
												$client->save();
												$this->import_errors="Missing filed is marked with red";
											}
                                        }
										else
										{
											$client =new DumpCashDistribution;
											$client->names=$row->names;
											$client->sex=$row->sex;
											$client->age = $row->age;
											$client->marital_status=$row->marital_status;
											$client->m=$row->m;
											$client->f=$row->f;
											$client->t=$row->t;
											$client->origin=$row->origin;
											$client->date_of_arrival=$row->date_of_arrival;
											$client->vul_1=$row->vul_1;
											$client->amount=intval($row->amount);
											$client->error_descriptions="Client not found in registration list";
											$client->save();
											$this->import_errors="Missing filed is marked with red";
										}

                                    }
									else
									{
										$client =new DumpCashDistribution;
											$client->names=$row->names;
											$client->sex=$row->sex;
											$client->age = $row->age;
											$client->marital_status=$row->marital_status;
											$client->m=$row->m;
											$client->f=$row->f;
											$client->t=$row->t;
											$client->origin=$row->origin;
											$client->date_of_arrival=$row->date_of_arrival;
											$client->vul_1=$row->vul_1;
											$client->amount=intval($row->amount);
											$client->error_descriptions="Client not found in registration list";
											$client->save();
											$this->import_errors="Missing filed is marked with red";
									}

                                }
								else
								{
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
                                    if( !is_numeric($row->amount)){
                                        $filed_error .="amount is Missing-";
                                    }

                                    if( $row->vul_1 == "" ){
                                        $filed_error .="Vulnerability code(s) is Missing-";
                                    }
                                    $filed_error=substr($filed_error,0,strlen($filed_error)-1);

                                    $client =new DumpCashDistribution;
                                    $client->names=$row->names;
                                    $client->sex=$row->sex;
                                    $client->age = $row->age;
                                    $client->marital_status=$row->marital_status;
                                    $client->m=$row->m;
                                    $client->f=$row->f;
                                    $client->t=$row->t;
                                    $client->origin=$row->origin;
                                    $client->date_of_arrival=$row->date_of_arrival;
                                    $client->vul_1=$row->vul_1;
                                    $client->amount=intval($row->amount);
                                    $client->error_descriptions=$filed_error;
                                    $client->save();
                                    $this->import_errors="Missing filed is marked with red";
								}
                            });

                        } else {

                            $provision=new CashProvision;
                            $provision->provision_date=$request->provision_date;
                            $provision->provided_by=$request->provided_by;
                            $provision->comments=$request->comments;
                            $provision->camp_id=$request->camp_id;
                            $provision->created_by=Auth::user()->username;
                            $provision->activity_id =$request->activity_id;
                            $provision->save();

                            $results->each(function ($row) use ($provision,$request) {
                                $amount = intval($row->amount);

                                if (count(Client::where('hai_reg_number', '=', $row->hai_reg_number)->where('camp_id', '=', $request->camp_id)->get()) > 0 && is_numeric($row->amount) && intval($row->amount) > 0) {



                                    $client = Client::where('hai_reg_number', '=', $row->hai_reg_number)->get()->first();
                                    if ($client != null && count($client) > 0) {
                                        if (!hasClientReachedProvisionLimit($request->activity_id, $client->id,$provision->provision_date)) {

                                            if (!isActivityOutOfFunds($request->activity_id, intval($row->amount))) {


                                                    $provision_client = new CashProvisionClient;
                                                    $provision_client->client_id = $client->id;
                                                    $provision_client->activity_id = $request->activity_id;
                                                    $provision_client->amount = $amount;
                                                    $provision_client->provision_id = $provision->id;
                                                    $provision_client->provision_date = $provision->provision_date;
                                                    $provision_client->save();
                                                    //Audit trail
                                                    AuditRegister("CashProvisionController","Created CashProvisionClient",$provision_client);
                                                    //Deduct money
                                                    deductActivityAmount($request->activity_id, $amount);


                                            }
											else
											{
                                                $clientdt=Client::where('hai_reg_number', '=', $row->hai_reg_number)->get()->first();
                                                $client =new DumpCashDistribution;
                                                $client->names=$row->names;
                                                $client->sex=$row->sex;
                                                $client->age = $row->age;
                                                $client->marital_status=$clientdt->marital_status;
                                                $client->m=$clientdt->males_total;
                                                $client->f=$clientdt->females_total;
                                                $client->t=$clientdt->females_total + $clientdt->males_total;
                                                if (is_object($clientdt->fromOrigin) && $clientdt->fromOrigin != null) {
                                                    $client->origin = $clientdt->fromOrigin->origin_name;
                                                }
                                                $client->date_of_arrival=$clientdt->date_of_arrival;
                                                $vul="";
                                                if (count(ClientVulnerabilityCode::where('client_id','=',$clientdt->id)->get()) >0)
                                                {
                                                    $vlc=ClientVulnerabilityCode::where('client_id','=',$clientdt->id)->get()->first();
                                                    if (is_object($vlc->code))
                                                    {
                                                        $vul= $vlc->code->code;
                                                    }
                                                }
                                                $client->vul_1= $vul;
                                                $client->amount=intval($row->amount);
                                                $client->date_of_arrival=$clientdt->date_arrival;
                                                $client->error_descriptions="Insufficient Funds";
                                                $client->save();
                                                $this->import_errors="Missing filed is marked with red";
											}

                                        }
                                        else
                                        {
                                            $clientdt=Client::where('hai_reg_number', '=', $row->hai_reg_number)->get()->first();
                                            $client =new DumpCashDistribution;
                                            $client->names=$row->names;
                                            $client->sex=$row->sex;
                                            $client->age = $row->age;
                                            $client->marital_status=$clientdt->marital_status;
                                            $client->m=$clientdt->males_total;
                                            $client->f=$clientdt->females_total;
                                            $client->t=$clientdt->females_total + $clientdt->males_total;
                                            if (is_object($clientdt->fromOrigin) && $clientdt->fromOrigin != null) {
                                                $client->origin = $clientdt->fromOrigin->origin_name;
                                            }
                                            $client->date_of_arrival=$clientdt->date_of_arrival;
                                            $vul="";
                                            if (count(ClientVulnerabilityCode::where('client_id','=',$clientdt->id)->get()) >0)
                                            {
                                                $vlc=ClientVulnerabilityCode::where('client_id','=',$clientdt->id)->get()->first();
                                                if (is_object($vlc->code))
                                                {
                                                    $vul= $vlc->code->code;
                                                }
                                            }
                                            $client->vul_1= $vul;
                                            $client->amount=intval($row->amount);
                                            $client->date_of_arrival=$clientdt->date_arrival;
                                            $client->error_descriptions="Client is not eligible to receive the cash, number of days is less than  the limit";
                                            $client->save();
                                            $this->import_errors="Missing filed is marked with red";
                                        }
                                    }

                                }
								else
								{
                                                        $filed_error="";
                                    if($row->amount ==""){
                                        $filed_error .="amount is Missing-";
                                    }
                                    if( intval($row->amount) < 0){
                                        $filed_error .="amount can not be less than zero";
                                    }
                                    if (!count(Client::where('hai_reg_number', '=', $row->hai_reg_number)->where('camp_id', '=', $request->camp_id)->get()) > 0)
                                    {
                                        $camp =Camp::find($request->camp_id);
                                        $filed_error .="Client not found in registration list for $camp->camp_name camp";
                                    }


                                                        $clientdt=Client::where('hai_reg_number', '=', $row->hai_reg_number)->get()->first();
                                                        $client =new DumpCashDistribution;
                                                        $client->names=$row->names;
                                                        $client->sex=$row->sex;
                                                        $client->age = $row->age;
                                                        $client->marital_status=$clientdt->marital_status;
                                                        $client->m=$clientdt->males_total;
                                                        $client->f=$clientdt->females_total;
                                                        $client->t=$clientdt->females_total + $clientdt->males_total;
                                                        if (is_object($clientdt->fromOrigin) && $clientdt->fromOrigin != null) {
                                                            $client->origin = $clientdt->fromOrigin->origin_name;
                                                        }
                                                        $client->date_of_arrival=$clientdt->date_of_arrival;
                                                        $vul="";
                                                        if (count(ClientVulnerabilityCode::where('client_id','=',$clientdt->id)->get()) >0)
                                                        {
                                                            $vlc=ClientVulnerabilityCode::where('client_id','=',$clientdt->id)->get()->first();
                                                            if (is_object($vlc->code))
                                                            {
                                                                $vul= $vlc->code->code;
                                                            }
                                                        }
                                                        $client->vul_1= $vul;
                                                        $client->amount=intval($row->amount);
                                                        $client->date_of_arrival=$clientdt->date_arrival;
                                                        $client->error_descriptions=$filed_error;
                                                        $client->save();
                                                        $this->import_errors="Missing filed is marked with red";
								}
                            });
                        }


                });

                File::delete($orfile);
                if ($this->import_errors =="") {

                    return redirect('cash/monitoring/provision');
                }
                else
                {
                    return redirect('import/cash/monitoring/provision/errors');
                }

            }else{
                return redirect()->back()->with('error','Activity has Insufficient funds');
            }

        }
        catch (\Exception $ex)
        {
            return redirect()->back()->with('error',$ex->getMessage());
        }
    }

    public function showPrint($id)
    {
        //
        $provision=CashProvision::find($id);
        return view('cash.provision.pdf',compact('provision'));
    }


    public function downloadPdf($id)
    {
        //
        $provision=CashProvision::find($id);
         $pdf = \PDF::loadView('cash.provision.pdf',compact('provision'))
            ->setOption('footer-right', 'Page [page]')
            ->setOption('page-offset', 0);
        return $pdf->download('cash_distribution_monitoring.pdf');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'provision_date' => 'required|before:tomorrow',
                'camp_id' => 'required',
                'activity_id' => 'required',
                'amount' => 'required|numeric',
                'hai_reg_number' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {

                if(checkRegistrationByHAIRegCampID($request->hai_reg_number,$request->camp_id)) {


                    $client=Client::where('hai_reg_number','=',$request->hai_reg_number)->get()->first();

                    if (!hasClientReachedProvisionLimit($request->activity_id, $client->id, $request->provision_date)) {

                        if (!isActivityOutOfFunds($request->activity_id, $request->amount)) {

                            $provision=new CashProvision;
                            $provision->provision_date=$request->provision_date;
                            $provision->provided_by=$request->provided_by;
                            $provision->comments=$request->comments;
                            $provision->camp_id=$request->camp_id;
                            $provision->created_by=Auth::user()->username;
                            $provision->activity_id =$request->activity_id;
                            $provision->save();

                            if (!isActivityOutOfFunds($request->activity_id,$request->amount)) {
                                $provision_client=new CashProvisionClient;
                                $provision_client->client_id=$client->id;
                                $provision_client->activity_id=$request->activity_id;
                                $provision_client->amount=$request->amount;
                                $provision_client->provision_id=$provision->id;
                                $provision_client->provision_date=$provision->provision_date;
                                $provision_client->save();
                                //Audit trail
                                AuditRegister("CashProvisionController","Created CashProvisionClient",$provision_client);
                                //Deduct money
                                deductActivityAmount($request->activity_id,$request->amount);

                                return Response::json(array(
                                    'success' => true,
                                    'errors' => 0,
                                    'message' => "Record saved successful"
                                ), 200); // 400 being the HTTP code for an invalid request.
                            }

                        }
                        else
                        {
                            return Response::json(array(
                                'success' => false,
                                'errors' => 1,
                                'message' => "activity run out of funds "
                            ), 400); // 400 being the HTTP code for an invalid request.
                        }

                    }
                    else
                    {
                        return Response::json(array(
                            'success' => false,
                            'errors' => 1,
                            'message' => "Client is not eligible for receiving the funds "
                        ), 400); // 400 being the HTTP code for an invalid request.
                    }
                }
                else{
                    return Response::json(array(
                        'success' => false,
                        'errors' => 1,
                        'message' => "Client is not registered in mentioned camp"
                    ), 400); // 400 being the HTTP code for an invalid request.
                }


            }
        }
        catch (\Exception $ex)
        {
            return Response::json(array(
                'success' => false,
                'errors' => 1,
                'message' => $ex->getMessage()
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
        $provision=CashProvision::findorfail($id);
        return view('cash.provision.show',compact('provision'));
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
        $provision=CashProvision::findorfail($id);
        return view('cash.provision.edit',compact('provision'));
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
        $provision=CashProvision::findorfail($id)->delete();
        //Audit trail
        AuditRegister("CashProvisionController","Deleted cash provision",$provision);
    }
}
