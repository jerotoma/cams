<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
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
        $roles = config('roles.models.role')::all();
        //dd($roles);
        return view('users.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.roles.create');
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
            'role_name' => 'required',
        ]);
        if(count(config('roles.models.role')::where('name','=',strtolower($request->role_name))->get()) >0)
        {
            return "<span class='text-info'><i class='fa fa-info'></i>Duplicate role name ".$request->role_name."</span>";
        }
        else {
            $role = new config('roles.models.role');
            $role->name = $request->role_name;
            $role->display_name = $request->display_name;
            $role->description = $request->description;
            $role->save();
            return "<span class='text-info'><i class='fa fa-info'></i> Successful submitted</span>";
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
        $role= config('roles.models.role')::find($id);
        return view('users.roles.edit',compact('role'));
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
            'role_name' => 'required',
        ]);
        if(count(config('roles.models.role')::where('name','=',strtolower($request->role_name))->where('id','<>',$id)->get()) >0)
        {
            return "<span class='text-info'><i class='fa fa-info'></i>Duplicate role name ".$request->role_name."</span>";
        }
        else {
            $role =  config('roles.models.role')::find($id);
            $role->name = $request->role_name;
            $role->display_name = $request->display_name;
            $role->description = $request->description;
            $role->save();
            return "<span class='text-info'><i class='fa fa-info'></i> Successful submitted</span>";
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
        $role = config('roles.models.role')::findOrFail($id); //
        $role->forceDelete(); //
    }
}
