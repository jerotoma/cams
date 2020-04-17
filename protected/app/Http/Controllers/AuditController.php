<?php

namespace App\Http\Controllers;

use App\Audit;
use Illuminate\Http\Request;

class AuditController extends Controller
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
    public function index($request="")
    {
        //
        $logs = Audit::orderBy('activity_date','DESC')->get()->take(500);
        return view('users.audit.index',compact('logs','request'));

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
    {ob_clean();
        //
        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $end_time ="";
        $start_time="";
        if($request->start_date != ""){
            $start_time = date("Y-m-d", strtotime($request->start_date));
        }
        if($request->end_date != ""){
            $end_time = date("Y-m-d", strtotime($request->end_date));
        }
        $range = [$start_time, $end_time];
        $logs =Audit::whereBetween('activity_date', $range)->orderBy('activity_date','DESC')->get();

        if ($request->export_type == 2 && count($logs) > 0){

            \Excel::create("System_audit_logs", function ($excel) use ($request, $logs) {
                $excel->sheet('sheet', function ($sheet) use ($request, $logs) {
                    $sheet->loadView('users.audit.logs', compact('logs', 'request'));
                    $sheet->setWidth(array(
                        'A'     =>  10,
                        'B'     =>  20,
                        'C'     =>  20,
                        'D'     =>  20,
                        'E'     =>  25,
                        'F'     =>  20,
                        'G'     =>  70,
                    ));
                    $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
                });
            })->download('xlsx');
        }
        else {
            return view('users.audit.index', compact('logs', 'request'));
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
        $log=Audit::find($id);
        return view('users.audit.show',compact('log'));
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
