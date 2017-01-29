<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientVulnerabilityCode;
use App\Country;
use App\PSNCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
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
        $clients=Client::all();
        return view('clients.index',compact('clients'));
    }

    public function searchClients()
    {
        return view('clients.search');
    }
    public function postSearchClient(Request $request)
    {

    }
    public function showImport()
    {
        return view('clients.import');
    }
    public function postImport(Request $request)
    {
        try {
            $this->validate($request, [
                'inventory_file' => 'required|mimes:xls,xlsx',
            ]);

            $file= $request->file('inventory_file');
            $destinationPath = public_path() .'/uploads/temp/';
            $filename   = str_replace(' ', '_', $file->getClientOriginalName());

            $file->move($destinationPath, $filename);

            Excel::load($destinationPath . $filename, function ($reader) {
                $reader->formatDates(false, 'Y-m-d');
                $results= $reader->get();
                $results->each(function($row) {

                    if(!count(Client::where('client_number','=',strtoupper($row->client_number))->get()) >0)
                    {
                        if(count(Country::where('country_name','=',ucwords(strtolower($row->origin)))->get()) >0)
                        {
                            $c=Country::where('country_name','=',ucwords(strtolower($row->origin)))->get()->first();
                        }
                        else
                        {
                            $co=new Country;
                            $co->country_name=ucwords(strtolower($row->origin));
                            $co->save();
                            $c=$co;
                        }

                        $client=new Client;
                        $client->client_number =strtoupper($row->client_number);
                        $client->full_name =ucwords(strtolower($row->full_name));
                        $client->sex =ucwords($row->sex);
                        $client->age =$row->age;
                        $client->civil_status =$row->civil_status;
                        $client->spouse_name =$row->name_of_spouse_if_married;
                        $client->care_giver =$row->care_giver;
                        $client->females_total =$row->number_of_females;
                        $client->males_total =$row->number_of_males;
                        if($c != null){
                            $client->country_id =$c->id;
                        }
                        $client->date_arrival =date("Y-m-d",strtotime("$row->date_of_arrival"));
                        $client->present_address =$row->present_address;
                        $client->household_number =$row->household_number;
                        $client->ration_card_number =$row->ration_card_number;
                        $client->assistance_received =$row->assistance_received_to_date;
                        $client->problem_specification =$row->problem_specification;
                        $client->created_by =Auth::user()->username;
                        $client->save();

                        $psnCodes=array($row->psn_code_1,$row->psn_code_2,$row->psn_code_3,$row->psn_code_4,$row->psn_code_5);
                        //Save validation codes

                        foreach ($psnCodes as $data )
                        {

                            $pcode="";
                            if (count(PSNCode::where('code','=',strtoupper($data))->get()) >0)
                            {
                                $pcode=PSNCode::where('code','=',strtoupper($data))->get()->first();
                            }
                            else{
                                $psc=new PSNCode;
                                $psc->code=strtoupper($data);
                                $psc->save();
                                $pcode=$psc;
                            }
                            if($pcode != "")
                            {
                                $codes=new ClientVulnerabilityCode;
                                $codes->client_id=$client->id;
                                $codes->code_id=$pcode->id;
                                $codes->save();
                            }
                        }

                    }
                });

            });
          // return redirect('clients');
        }
        catch (\Exception $e)
        {
            //echo $e->getMessage();
            return  redirect()->back()->with('error',$e->getMessage());
        }
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
            $records["data"][] = array(

                $client->client_number,
                $client->full_name,
                $client->sex,
                $client->age,
                $origin,
                date('d M Y',strtotime($client->date_arrival)),
                '<span><ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li id="'.$client->id.'"><a href="#" class="showRecord label label-primary text-white"><i class="fa fa-user"></i> PSN Profile </a></li>
                                <li id="'.$client->id.'"><a href="#" class="showVulnerability label label-danger text-white"><i class="fa fa-file"></i> Vulnerability Assessment </a></li>
                                <li id="'.$client->id.'"><a href="#" class="showFunctional label label-danger text-white"><i class="fa fa-file"></i> Functional Assessment </a></li>
                                <li id="'.$client->id.'"><a href="#" class="showInclusion label label-danger text-white"><i class="fa fa-file"></i> Inclusion Assessment</a></li>
                                 <li id="'.$client->id.'"><a href="#" class="showWheelchair label label-danger text-white"><i class="fa fa-file"></i> Wheelchair Assessment</a></li>
                            </ul>
                        </li>
                    </ul></span>',
                $status,
                '<span id="'.$client->id.'">
                
                    <a href="#" title="Edit" class="btn btn-icon-only editRecord"> <i class="fa fa-edit text-primary">  </i> </a>
                    <a href="#" title="Delete" class="btn btn-icon-only  deleteRecord"> <i class="fa fa-trash text-danger"></i> </a></span>',
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
        return view('clients.create');
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
        $this->validate($request, [
            'client_number' => 'required|unique:clients',
            'full_name' => 'required',
            'sex' => 'required',
            'age' => 'required',
            'civil_status' => 'required',
            'nationality' => 'required',
            'date_arrival' => 'required',
            'ration_card_number' => 'required',
            'camp_id'=>'required',
            'vulnerability_code'=>'required',
            'females_total'=>'required',
            'males_total'=>'required',

        ]);
        if(count(Client::where('client_number','=',strtoupper($request->client_number))->get()) >0)
        {
            return redirect()->back()->withInput()->with('clients_error',"Duplicate client name ".$request->country_name);
        }
        else{
                $client=new Client;
                $client->client_number =strtoupper($request->client_number);
                $client->full_name =ucwords($request->full_name);
                $client->sex =ucwords($request->sex);
                $client->age =$request->age;
                $client->civil_status =$request->civil_status;
                $client->spouse_name=$request->spouse_name;
                $client->care_giver =$request->care_giver;
                $client->country_id =$request->nationality;
                $client->date_arrival =date("Y-m-d",strtotime("$request->date_arrival"));
                $client->present_address =$request->present_address;
                $client->household_number =$request->household_number;
                $client->ration_card_number =$request->ration_card_number;
                $client->assistance_received =$request->assistance_received;
                $client->problem_specification =$request->problem_specification;
                $client->camp_id =$request->camp_id;
                $client->created_by =Auth::user()->username;
                $client->save();

            //Save validation codes
            foreach (ClientVulnerabilityCode::where('client_id','=',$client->id)->get() as $item)
            {
                $item->delete();
            }

            foreach ($request->vulnerability_code as $item )
            {
                $codes=new ClientVulnerabilityCode;
                $codes->client_id=$client->id;
                $codes->code_id=$item;
                $codes->save();
            }

            return "<h3><span class='text-success'><i class='fa fa-spinner fa-spin'></i> Saved Successful</span><h3>";
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
        $client=Client::find($id);
        return view('clients.show',compact('client'));
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
        $client=Client::find($id);
        return view('clients.edit',compact('client'));
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
        $this->validate($request, [
            'client_number' => 'required|unique:clients',
            'full_name' => 'required',
            'sex' => 'required',
            'age' => 'required',
            'civil_status' => 'required',
            'nationality' => 'required',
            'date_arrival' => 'required',
            'ration_card_number' => 'required',
            'camp_id'=>'required',
            'vulnerability_code'=>'required',
        ]);
        if(count(Client::where('client_number','=',strtoupper($request->client_number))->where('id','=',$id)->get()) >0)
        {
            return redirect()->back()->withInput()->with('clients_error',"Duplicate Client name ".$request->country_name);
        }
        else{$client= Client::find($id);
            $client->client_number =strtoupper($request->client_number);
            $client->full_name =ucwords($request->full_name);
            $client->sex =ucwords($request->sex);
            $client->age =$request->age;
            $client->civil_status =$request->civil_status;
            $client->spouse_name=$request->spouse_name;
            $client->care_giver =$request->care_giver;
            $client->country_id =$request->nationality;
            $client->date_arrival =date("Y-m-d",strtotime("$request->date_arrival"));
            $client->present_address =$request->present_address;
            $client->household_number =$request->household_number;
            $client->ration_card_number =$request->ration_card_number;
            $client->assistance_received =$request->assistance_received;
            $client->problem_specification =$request->problem_specification;
            $client->camp_id =$request->camp_id;
            $client->created_by =Auth::user()->username;
            $client->save();

            //Save validation codes
            foreach (ClientVulnerabilityCode::where('client_id','=',$client->id)->get() as $item)
            {
                $item->delete();
            }

            foreach ($request->vulnerability_code as $item )
            {
                $codes=new ClientVulnerabilityCode;
                $codes->client_id=$client->id;
                $codes->code_id=$item;
                $codes->save();
            }

            return redirect('clients');}
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
    }
}
