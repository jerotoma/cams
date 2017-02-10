<?php

namespace App\Http\Controllers;

use App\ClientCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ClientCaseController extends Controller
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
         return view('progress.cases.index');
    }
    public function downloadPDF($id)
    {
        $case=ClientCase::find($id);
        $pdf = \PDF::loadView('progress.cases.pdf', compact('case'))
            ->setOption('footer-center', '[page]')
            ->setOption('page-offset', 0);
        return $pdf->download('progress_case_management.pdf');
    }
    public function getCasesList()
    {
        //
        $cases=ClientCase::all();
        $iTotalRecords =count(ClientCase::all());
        $sEcho = intval(10);

        $records = array();
        $records["data"] = array();


        $count=1;
        foreach($cases as $case) {
            $origin="";
            $status="";
            $camp="";
            if(is_object($case->camp) && $case->camp != null )
            {
                $camp=$case->camp->camp_name;
            }
            $vcolor="label-danger";


            $records["data"][] = array(
                $count++,
                $case->reference_number,
                $case->client->full_name,
                $case->client->age,
                $case->client->sex,
                $case->open_date,
                $camp,
                $case->case_type,
                $case->status,
                '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                                <li id="'.$case->id.'"><a href="#" class="showRecord label"><i class="fa fa-eye "></i> View </a></li>
                                <li id="'.$case->id.'"><a href="#" onclick="printPage(\''.url("cases").'/'.$case->id.'\');" class=" label"><i class="fa fa-print "></i> Print</a></li>
                                <li id="'.$case->id.'"><a href="'.url('download/cases/form').'/'.$case->id.'" class="label"><i class="fa fa-file-pdf-o "></i> pdf</a></li>
                                <li id="'.$case->id.'"><a href="#" class="editRecord label "><i class="fa fa-pencil "></i> Edit </a></li>
                                <li id="'.$case->id.'"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'
            );
        }


        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        echo json_encode($records);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('progress.cases.create');
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
                'client_id' => 'required',
                'open_date' => 'required',
                'case_type' => 'required',
                'descriptions' => 'required',
                'case_worker_name' => 'required',
                'camp_id' => 'required',
                'status' => 'required'
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $case=new ClientCase;
                $case->open_date= date("Y-m-d",strtotime($request->open_date));
                $case->case_type= $request->case_type;
                $case->descriptions= $request->descriptions;
                $case->initial_action= $request->initial_action;
                $case->feedback= $request->feedback;
                $case->planning= $request->planning;
                $case->case_worker_name= $request->case_worker_name;
                $case->status= $request->status;
                $case->created_by= Auth::user()->id;
                $case->status= $request->status;
                $case->camp_id= $request->camp_id;
                $case->client_id= $request->client_id;
                $case->save();

                //Create references
                $case->reference_number="CBR/".date("Y")."/CS-".str_pad($case->id,4,'0',STR_PAD_LEFT);
                $case->save();
                return response()->json([
                    'success' => true,
                    'message' => "Record saved"
                ], 200);

            }
        }
        catch (\Exception $ex)
        {
            return Response::json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 400); // 400 being the HTTP code for an invalid request.
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
        $case=ClientCase::findorfail($id);
        return view('progress.cases.show',compact('case'));
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
        $case=ClientCase::findorfail($id);
        return view('progress.cases.edit',compact('case'));
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
                'open_date' => 'required',
                'case_type' => 'required',
                'descriptions' => 'required',
                'case_worker_name' => 'required',
                'camp_id' => 'required',
                'status' => 'required'
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $case= ClientCase::findorfail($id);
                $case->open_date= date("Y-m-d",strtotime($request->open_date));
                $case->case_type= $request->case_type;
                $case->descriptions= $request->descriptions;
                $case->initial_action= $request->initial_action;
                $case->feedback= $request->feedback;
                $case->planning= $request->planning;
                $case->case_worker_name= $request->case_worker_name;
                $case->status= $request->status;
                $case->updated_by= Auth::user()->id;
                $case->status= $request->status;
                $case->camp_id= $request->camp_id;
                $case->save();
                return response()->json([
                    'success' => true,
                    'message' => "Record saved"
                ], 200);

            }
        }
        catch (\Exception $ex)
        {
            return Response::json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 400); // 400 being the HTTP code for an invalid request.
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
        $case= ClientCase::findorfail($id);
        $case->delete();
    }
}
