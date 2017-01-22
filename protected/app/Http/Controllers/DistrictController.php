<?php

namespace App\Http\Controllers;

use App\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistrictController extends Controller
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
        $districts=District::all();
        return view('districts.index',compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('districts.create');
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
            'district_name' => 'required',
            'region_id' => 'required',
        ]);
        if(count(District::where('district_name','=',ucwords($request->district_name))
                ->where('region_id','=',$request->region_id)->get()) >0)
        {
            return redirect()->back()->withInput()->with('district_error',"Duplicate district name ".$request->district_name);
        }
        else{$region=new District;
            $region->district_name =ucwords($request->district_name);
            $region->region_id =strtoupper($request->region_id);
            $region->created_by =Auth::user()->username;
            $region->save();
            return redirect('districts');}
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
        $district=District::find($id);
        return view('districts.edit',compact('district'));
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
        $district=District::find($id);
        return view('districts.edit',compact('district'));
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
            'district_name' => 'required',
            'region_id' => 'required',
        ]);
        if(count(District::where('district_name','=',ucwords($request->district_name))
                ->where('region_id','=',$request->region_id)->where('id','<>',$id)->get()) >0)
        {
            return redirect()->back()->withInput()->with('district_error',"Duplicate district name ".$request->district_name);
        }
        else{$region= District::find($id);
            $region->district_name =ucwords($request->district_name);
            $region->region_id =strtoupper($request->region_id);
            $region->created_by =Auth::user()->username;
            $region->save();
            return redirect('districts');}
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
        $district=District::find($id);
        $district->delete();
    }
}
