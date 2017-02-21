<?php

namespace App\Http\Controllers;

use App\Camp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampController extends Controller
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
        $camps=Camp::all();
        return view('camps.index',compact('camps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('camps.create');
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
            'camp_name' => 'required',
            'region_id' => 'required',
            'district_id' => 'required',
            'status' => 'required',
           ]);
        if(count(Camp::where('camp_name','=',ucwords($request->camp_name))
                ->where('region_id','=',$request->region_id)
                ->where('district_id','=',$request->district_id)->get()) >0)
        {
            return redirect()->back()->withInput()->with('district_error',"Duplicate district name ".$request->camp_name);
        }
        else{$camp=new Camp;
            $camp->reg_no =ucwords($request->reg_no);
            $camp->camp_name =ucwords($request->camp_name);
            $camp->description =ucwords($request->description);
            $camp->address =ucwords($request->address);
            $camp->tel =ucwords($request->tel);
            $camp->region_id =ucwords($request->region_id);
            $camp->district_id =ucwords($request->district_id);
            $camp->status =ucwords($request->status);
            $camp->created_by =Auth::user()->username;
            $camp->save();
            return redirect('camps');}
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
        $camp= Camp::find($id);
        return view('camps.show',compact('camp'));
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
        $camp= Camp::find($id);
        return view('camps.edit',compact('camp'));
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
          'camp_name' => 'required',
            'region_id' => 'required',
            'district_id' => 'required',
            'status' => 'required',
           ]);
        if(count(Camp::where('camp_name','=',ucwords($request->camp_name))
                ->where('region_id','=',$request->region_id)
                ->where('district_id','=',$request->district_id)
                ->where('id','<>',$id)->get()) >0)
        {
            return redirect()->back()->withInput()->with('camp_error',"Duplicate camp name ".$request->camp_name);
        }
        else{$camp= Camp::find($id);
            $camp->reg_no =ucwords($request->reg_no);
            $camp->camp_name =ucwords($request->camp_name);
            $camp->description =ucwords($request->description);
            $camp->address =ucwords($request->address);
            $camp->tel =ucwords($request->tel);
            $camp->region_id =ucwords($request->region_id);
            $camp->district_id =ucwords($request->district_id);
            $camp->status =ucwords($request->status);
            $camp->created_by =Auth::user()->username;
            $camp->save();
            return redirect('camps');}
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
        $camp= Camp::find($id);
        $camp->delete();
    }
}
