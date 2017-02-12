<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InclusionAssessmentController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('assessments.inclusion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Tables to be made
        /********************************
          1.InclusionAssessment 
          2.InclusionMedicalHistory
          3.MedicalPerfomanceComponentPartA
          4.MedicalPerfomanceComponentPartB
          6.MedicalPerfomanceComponentPartC
          7.MedicalPerfomanceComponentPartD
          8.MedicalPerfomanceComponentPartE
          9.MedicalPerfomanceComponentPartF
          10.MedicalPerfomanceComponentPerformanceArea
          11.MedicalPerfomanceComponentContext
          13.MedicalPerfomanceComponentSwot
          14.MedicalPerfomanceComponentShortRehab
          15.MedicalPerfomanceComponentLongRehab
          16.MedicalPerfomanceComponentRangeOfMotionLowerLimb
          17.MedicalPerfomanceComponentRangeOfMotionLowerLimb
          ********************************/
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
