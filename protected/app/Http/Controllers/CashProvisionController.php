<?php

namespace App\Http\Controllers;

use App\CashProvision;
use App\CashProvisionClient;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CashProvisionController extends Controller
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
    public function AuthorizeAll()
    {
        //
        if (Auth::user()->can('authorize')){

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
        if (Auth::user()->can('authorize')){

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
                if (Auth::user()->can('authorize')) {
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
            $this->validate($request, [
                'provision_date' => 'required|before:tomorrow',
                'camp_id' => 'required',
                'activity_id' => 'required',
                'import_type' => 'required',
                'cash_distribution_file' => 'required|mimes:xls,xlsx',
            ]);


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

                                if ($row->names != "" && $row->names != null && $row->sex != "" && $row->sex != null) {
                                    $sex = "";
                                    if (strtolower($row->sex) == "k" || strtolower($row->sex) == "mk" || strtolower($row->sex) == "f") {
                                        $sex = "Female";
                                    } else {
                                        $sex = "Male";
                                    }
                                    $client_number = strtoupper(strtolower(preg_replace('/\s+/S', "", $row->unique_id)));
                                    $full_name = ucwords(strtolower(preg_replace('/\s+/S', " ", $row->names)));
                                    $age = intval($row->age);
                                    $present_address = ucwords(strtolower(preg_replace('/\s+/S', " ", $row->present_address)));
                                    $ration_card_number = strtoupper(strtolower(preg_replace('/\s+/S', "", $row->ration_card_number)));
                                    $amount = intval($row->amount);

                                    if (count(Client::where('client_number', '=', $client_number)
                                            ->where('full_name', '=', $full_name)
                                            ->where('age', '=', $age)
                                            ->where('sex', '=', $sex)
                                            ->where('camp_id', '=', $provision->camp_id)
                                            ->where('present_address', '=', $present_address)
                                            ->where('ration_card_number', '=', $ration_card_number)->get()) > 0
                                    ) {

                                        $client = Client::where('client_number', '=', $client_number)
                                            ->where('full_name', '=', $full_name)
                                            ->where('age', '=', $age)
                                            ->where('sex', '=', $sex)
                                            ->where('camp_id', '=', $provision->camp_id)
                                            ->where('present_address', '=', $present_address)
                                            ->where('ration_card_number', '=', $ration_card_number)->get()->first();


                                        if ($client != null && count($client) > 0) {

                                            if (!isClientInProvisionLimit($request->activity_id, $client->id,$provision->provision_date)) {


                                                if (!isActivityOutOfFunds($request->activity_id, $request->amount)) {

                                                    if (!isActivityOutOfFunds($request->activity_id, $request->amount)) {
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

                                                }

                                            }
                                        }

                                    }

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

                                if (count(Client::where('hai_reg_number', '=', $row->hai_reg_number)->where('camp_id', '=', $request->camp_id)->get()) > 0) {


                                    $client = Client::where('hai_reg_number', '=', $row->hai_reg_number)->get()->first();
                                    if ($client != null && count($client) > 0) {
                                        if (!isClientInProvisionLimit($request->activity_id, $client->id,$provision->provision_date)) {

                                            if (!isActivityOutOfFunds($request->activity_id, $request->amount)) {

                                                if (!isActivityOutOfFunds($request->activity_id, $request->amount)) {
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

                                            }

                                        }
                                    }

                                }
                            });
                        }


                });

                File::delete($orfile);

                return redirect('cash/monitoring/provision');

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
        return $pdf->download('client_material_support.pdf');
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

                    if (!isClientInProvisionLimit($request->activity_id, $client->id,$request->provision_date)) {

                        if (!isActivityOutOfFunds($request->activity_id,$request->amount)) {

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
