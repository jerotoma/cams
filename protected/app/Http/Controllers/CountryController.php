<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
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
        $countries=Country::all();
       return view('countries.index',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('countries.create');
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
            'country_name' => 'required',
        ]);
        if(count(Country::where('country_name','=',ucwords($request->country_name))->get()) >0)
        {
            return redirect()->back()->withInput()->with('country_error',"Duplicate country name ".$request->country_name);
        }
        else{$country=new Country;
            $country->country_name =ucwords($request->country_name);
            $country->country_code =strtoupper($request->country_code);
            $country->created_by =Auth::user()->username;
            $country->save();
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
        $country= Country::find($id);
        return view('countries.show',compact('country'));
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
        $country= Country::find($id);
        return view('countries.edit',compact('country'));
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
            'country_name' => 'required',
        ]);
        if(count(Country::where('country_name','=',ucwords($request->country_name))->where('id','<>',$id)->get()) >0)
        {
            return redirect()->back()->withInput()->with('country_error',"Duplicate country name ".$request->country_name);
        }
        else{$country= Country::find($id);
            $country->country_name =ucwords($request->country_name);
            $country->country_code =strtoupper($request->country_code);
            $country->created_by =Auth::user()->username;
            $country->save();
            return redirect('countries');}
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
        $country= Country::find($id);
        $country->delete();
    }
}
