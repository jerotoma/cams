<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
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
        $departments=Department::all();
        return view('departments.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('departments.create');
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
        'department_name' => 'required|unique:departments',
        ]);
        if(count(Department::where('department_name','=',ucwords($request->department_name))->get()) >0)
        {
            return "<span class='text-info'><i class='fa fa-info'></i>Duplicate department name ".$request->department_name."</span>";
        }
        else {
            $department = new Department;
            $department->department_name = ucwords($request->department_name);
            $department->description = $request->description;
            $department->parent_id = $request->parent_id;
            $department->created_by = Auth::user()->username;
            $department->save();
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
        $department=Department::find($id);
        return view('departments.show',compact('department'));
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
        $department=Department::find($id);
        return view('departments.edit',compact('department'));
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
         'department_name' => 'required',
        ]);
        if(count(Department::where('department_name','=',ucwords($request->department_name))
                ->where('id','<>',$id)->get()) >0)
        {
            return "<span class='text-info'><i class='fa fa-info'></i> Duplicate department name ".$request->department_name."</span>";
        }
        else {
            $department = Department::find($id);
            $department->department_name = ucwords($request->department_name);
            $department->description = $request->description;
            $department->parent_id = $request->parent_id;
            $department->created_by = Auth::user()->username;
            $department->save();
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
        //

    }
}
