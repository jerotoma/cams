<?php

namespace App\Http\Controllers;

use App\PSNCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->validate($request, [
            'code' => 'required',
        ]);
        if(count(PSNCode::where('code','=',strtoupper($request->code))->get()) >0)
        {
            return redirect()->back()->withInput()->with('code_error',"Duplicate code name ".$request->code);
        }
        else {
            $code = new PSNCode;
            $code->code = strtoupper($request->code);
            $code->description = $request->description;
            $code->definition = $request->definition;
            $code->created_by = Auth::user()->username;
            $code->save();
            return redirect('psncodes');
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
        $this->validate($request, [
            'code' => 'required',
        ]);
        if(count(PSNCode::where('code','=',strtoupper($request->code))->where('id','<>',$id)->get()) >0)
        {
            return redirect()->back()->withInput()->with('code_error',"Duplicate code name ".$request->code);
        }
        else {
            $code =  PSNCode::find($id);
            $code->code = strtoupper($request->code);
            $code->description = $request->description;
            $code->definition = $request->definition;
            $code->created_by = Auth::user()->username;
            $code->save();
            return redirect('psncodes');
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
