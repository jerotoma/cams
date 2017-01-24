<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientVulnerabilityCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        ]);
        if(count(Client::where('client_number','=',strtoupper($request->client_number))->get()) >0)
        {
            return redirect()->back()->withInput()->with('clients_error',"Duplicate client name ".$request->country_name);
        }
        else{$client=new Client;
            $client->client_number =strtoupper($request->client_number);
            $client->full_name =ucwords($request->full_name);
            $client->sex =ucwords($request->sex);
            $client->age =$request->age;
            $client->civil_status =$request->civil_status;
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

            return redirect('countries');}
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
    }
}
