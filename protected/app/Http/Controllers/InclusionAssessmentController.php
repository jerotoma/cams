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
          2.php artisan make:model InclusionMedicalHistory
          3.php artisan make:model MedicalPerfomanceComponentPartA

                 1.php artisan make:model MedicalPerfomanceComponentPartARomLowerLimb
                 2.php artisan make:model MedicalPerfomanceComponentPartARomUpperLimb
                 3.php artisan make:model MedicalPerfomanceComponentPartAPosture
                 4.php artisan make:model MedicalPerfomanceComponentPartAMovingPattern
          4.php artisan make:model MedicalPerfomanceComponentPartB
                 1.php artisan make:model MedicalPerfomanceComponentPartBBodySenses
          6.php artisan make:model MedicalPerfomanceComponentPartC
          7.php artisan make:model MedicalPerfomanceComponentPartD
          8.php artisan make:model MedicalPerfomanceComponentPartE
          9.php artisan make:model MedicalPerfomanceComponentPartF
          10.php artisan make:model MedicalPerfomanceComponentPerformanceArea
          11.php artisan make:model MedicalPerfomanceComponentContext
          13.php artisan make:model MedicalPerfomanceComponentSwot
          14.php artisan make:model MedicalPerfomanceComponentShortRehab
          15.php artisan make:model MedicalPerfomanceComponentLongRehab


           mpc_long_rehab_1_remark
           mpc_long_rehab_2_remark
           mpc_long_rehab_3_remark
           mpc_long_rehab_4_remark
           mpc_long_rehab_5_remark
           mpc_long_rehab_6_remark
           mpc_long_rehab_7_remark
           mpc_long_rehab_8_remark
           mpc_long_rehab_9_remark
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
