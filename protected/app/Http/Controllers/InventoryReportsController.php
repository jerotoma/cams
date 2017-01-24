<?php

namespace App\Http\Controllers;

use App\MateriaSupport;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class InventoryReportsController extends Controller
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
        return view('reports.inventory.index');
    }
    public function showReportView()
    {
        //
        return view('reports.inventory.generate');
    }

    public function generateReportView(Request $request)
    {
        //
        $startDate=$request->date_from;
        $endDate=$request->date_to;
        $range = [$startDate, $endDate];

        if($startDate != "" && $endDate != "" ) {
            if ($request->report_type == "all") {
                $items = MateriaSupport::whereBetween('distributed_date', $range)->get();
                    Excel::create("material_support_report", function ($excel) use ($items,$startDate,$endDate) {
                        $excel->sheet('sheet', function ($sheet) use ($items,$startDate,$endDate) {
                            $sheet->loadView('reports.inventory.detailed',compact('items','startDate','endDate'));
                            $sheet->setWidth(array(
                                'A'     =>  25,
                                'B'     =>  25,
                                'C'     =>  20,
                                'D'     =>  25,
                                'E'     =>  25,
                                'F'     =>  20,
                                'G'     =>  20,
                                'H'     =>  25,
                                'I'     =>  20,
                                'J'     =>  25,
                                'K'     =>  50,
                                'L'     =>  50,
                                'M'     =>  20,
                                'N'     =>  50,
                                'O'     =>  25,
                                'P'     =>  25,
                                'Q'     =>  25,
                                'R'     =>  25,
                                'S'     =>  25,
                                'T'     =>  25,
                                'U'     =>  25,
                                'V'     =>  25

                            ));
                            $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
                            // $sheet->setAutoFilter('E2:F2');
                        });
                    })->download('xlsx');

            } else {
                $items = MateriaSupport::whereBetween('distributed_date', $range)->where('item_id','=',$request->report_type)->get();
                Excel::create("material_support_report", function ($excel) use ($items,$startDate,$endDate) {
                    $excel->sheet('sheet', function ($sheet) use ($items,$startDate,$endDate) {
                        $sheet->loadView('reports.inventory.detailed',compact('items','startDate','endDate'));
                        $sheet->setWidth(array(
                            'A'     =>  25,
                            'B'     =>  25,
                            'C'     =>  20,
                            'D'     =>  25,
                            'E'     =>  25,
                            'F'     =>  20,
                            'G'     =>  20,
                            'H'     =>  25,
                            'I'     =>  20,
                            'J'     =>  25,
                            'K'     =>  50,
                            'L'     =>  50,
                            'M'     =>  20,
                            'N'     =>  50,
                            'O'     =>  25,
                            'P'     =>  25,
                            'Q'     =>  25,
                            'R'     =>  25,
                            'S'     =>  25,
                            'T'     =>  25,
                            'U'     =>  25,
                            'V'     =>  25

                        ));
                        $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
                        // $sheet->setAutoFilter('E2:F2');
                    });
                })->download('xlsx');
            }
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
