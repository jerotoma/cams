<?php

namespace App\Http\Controllers;

use App\DataVisualization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataVisualizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function clients()
    {
        //
        return view('reports.clients.index');
    }
    public function showAssessments()
    {
        //
        return view('reports.assessments.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DataVisualization  $dataVisualization
     * @return \Illuminate\Http\Response
     */
    public function show(DataVisualization $dataVisualization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataVisualization  $dataVisualization
     * @return \Illuminate\Http\Response
     */
    public function edit(DataVisualization $dataVisualization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataVisualization  $dataVisualization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataVisualization $dataVisualization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataVisualization  $dataVisualization
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataVisualization $dataVisualization)
    {
        //
    }
}
