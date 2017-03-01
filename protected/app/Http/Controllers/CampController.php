<?php

namespace App\Http\Controllers;

use App\Camp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

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
        try {
            $validator = Validator::make($request->all(), [
                'camp_name' => 'required|unique:camps',
                'region_id' => 'required',
                'district_id' => 'required',
                'status' => 'required',

            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $camp=new Camp;
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
                'errors' =>1,
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
        try {
            $validator = Validator::make($request->all(), [
                'camp_name' => 'required|unique:camps,camp_name,'.$id,
                'region_id' => 'required',
                'district_id' => 'required',
                'status' => 'required',

            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $camp= Camp::find($id);
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
                'errors' =>1,
                'message' => $ex->getMessage()
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
        $camp= Camp::find($id);
        $camp->delete();
    }
}
