<?php

namespace App\Http\Controllers;

use App\PSNCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class PSNCodesController extends Controller
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
        $codes=PSNCode::all();
        return view('psn.index',compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('psn.create');
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
                'code' => 'required|unique:p_s_n_codes',
                'description' => 'required',
                'definition' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $code = new PSNCode;
                $code->code = strtoupper($request->code);
                $code->description = $request->description;
                $code->definition = $request->definition;
                $code->category_id = $request->category_id;
                $code->created_by = Auth::user()->username;
                $code->save();

                return response()->json([
                    'success' => true,
                    'message' => "Saved Successful"
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
        $code=PSNCode::find($id);
        return view('psn.show',compact('code'));
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
        $code=PSNCode::find($id);
        return view('psn.edit',compact('code'));
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
                'code' => 'required|unique:p_s_n_codes,code,'.$id,
                'description' => 'required',
                'definition' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $code =  PSNCode::find($id);
                $code->code = strtoupper($request->code);
                $code->description = $request->description;
                $code->definition = $request->definition;
                $code->category_id = $request->category_id;
                $code->created_by = Auth::user()->username;
                $code->save();

                return response()->json([
                    'success' => true,
                    'message' => "Saved Successful"
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
        $code =  PSNCode::find($id);
        $code->delete();
    }
}
