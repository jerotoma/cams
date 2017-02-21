<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegionController extends Controller
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
        $regions=Region::all();
        return view('regions.index',compact('regions'));
    }

    public function getDistrictsById($id)
    {
        $regions=Region::find($id);
        echo "<option value=''>----</option>";
        foreach ($regions->districts as $dis)
        {
            echo "<option value='".$dis->id."'>".$dis->district_name."</option>";
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
        return view('regions.create');
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
            'region_name' => 'required',
            'country_id' => 'required',
        ]);
        if(count(Region::where('region_name','=',ucwords($request->region_name))
                ->where('country_id','=',$request->country_id)->get()) >0)
        {
            return redirect()->back()->withInput()->with('region_error',"Duplicate region name ".$request->region_name);
        }
        else{$region=new Region;
            $region->region_name =ucwords($request->region_name);
            $region->country_id =strtoupper($request->country_id);
            $region->created_by =Auth::user()->username;
            $region->save();
            return redirect('regions');}
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
        $region=Region::find($id);
        if(is_object($region->districts) && $region->districts != null )
        {
            $districts=$region->districts;
            return view('districts.index',compact('districts'));
        }
        else
        {
            return redirect()->back();
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
        $region= Region::find($id);
        return view('regions.edit',compact('region'));
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
            'region_name' => 'required',
            'country_id' => 'required',
        ]);
        if(count(Region::where('region_name','=',ucwords($request->region_name))
                ->where('country_id','=',$request->country_id)->where('id','<>',$id)->get()) >0)
        {
            return redirect()->back()->withInput()->with('region_error',"Duplicate region name ".$request->region_name);
        }
        else{$region=Region::find($id);
            $region->region_name =ucwords($request->region_name);
            $region->country_id =strtoupper($request->country_id);
            $region->created_by =Auth::user()->username;
            $region->save();
            return redirect('regions');}
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
        $region= Region::find($id);
        $region->delete();
    }


}
