<?php

namespace App\Http\Controllers;

use App\ProgressNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProgressNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('progress.notices.index');
    }
    public function downloadPDF($id)
    {
        $notice =ProgressNote::find($id);
        $pdf = \PDF::loadView('progress.notices.pdf', compact('notice'))
            ->setOption('footer-center', '[page]')
            ->setOption('page-offset', 0);
        return $pdf->download('progressive_notice.pdf');
    }
    public function AuthorizeAll()
    {
        //
        if (Auth::user()->hasPermission('authorize')){

            $notices=ProgressNote::where('auth_status', '=', 'pending')
                ->update([
                    'auth_status' => 'authorized',
                    'auth_by' => Auth::user()->username,
                    'auth_date' => date('Y-m-d H:i')
                ]);

            //Audit trail
            AuditRegister("ProgressNoteController","AuthorizeAll",$notices);

        }else{
            return null;
        }

    }
    public function AuthorizeProgressNoteById($id)
    {
        //
        if (Auth::user()->hasPermission('authorize')){

            $notices=ProgressNote::find($id)
                ->update([
                    'auth_status' => 'authorized',
                    'auth_by' => Auth::user()->username,
                    'auth_date' => date('Y-m-d H:i')
                ]);
            //Audit trail
            AuditRegister("ProgressNoteController","AuthorizeProgressNoteById",$notices);
        }else{
            return null;
        }
    }
    public function getNoticeList()
    {
        //
        $notices=ProgressNote::all();
        $iTotalRecords =count(ProgressNote::all());
        $sEcho = intval(10);

        $records = array();
        $records["data"] = array();


        $count=1;
        foreach($notices as $note) {
            if ($note->auth_status == "pending") {
                if (Auth::user()->hasPermission('authorize')) {
                    $records["data"][] = array(
                        $count++,
                        $note->reference_number,
                        $note->client->full_name,
                        $note->client->age,
                        $note->client->sex,
                        $note->open_date,
                        $note->case_worker_name,
                        $note->status,
                        $note->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                                <li id="' . $note->id . '"><a href="#" class="showRecord label"><i class="fa fa-eye "></i> View </a></li>
                                <li id="' . $note->id . '"><a href="#" onclick="printPage(\'' . url("progressive/notices") . '/' . $note->id . '\');" class=" label"><i class="fa fa-print "></i> Print</a></li>
                                <li id="' . $note->id . '"><a href="' . url('download/notice/pdf') . '/' . $note->id . '" class="label"><i class="fa fa-file-pdf-o "></i> pdf</a></li>
                                <li id="' . $note->id . '"><a href="#" class="authorizeRecord label "><i class="fa fa-check "></i> Authorize </a></li>
                                <li id="' . $note->id . '"><a href="#" class="editRecord label "><i class="fa fa-pencil "></i> Edit </a></li>
                                <li id="' . $note->id . '"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'
                    );
                }
                elseif (Auth::user()->hasRole('inputer'))
                {
                    $records["data"][] = array(
                        $count++,
                        $note->reference_number,
                        $note->client->full_name,
                        $note->client->age,
                        $note->client->sex,
                        $note->open_date,
                        $note->case_worker_name,
                        $note->status,
                        $note->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                                <li id="' . $note->id . '"><a href="#" class="showRecord label"><i class="fa fa-eye "></i> View </a></li>
                                <li id="' . $note->id . '"><a href="#" onclick="printPage(\'' . url("progressive/notices") . '/' . $note->id . '\');" class=" label"><i class="fa fa-print "></i> Print</a></li>
                                <li id="' . $note->id . '"><a href="' . url('download/notice/pdf') . '/' . $note->id . '" class="label"><i class="fa fa-file-pdf-o "></i> pdf</a></li>
                                <li id="' . $note->id . '"><a href="#" class="editRecord label "><i class="fa fa-pencil "></i> Edit </a></li>
                                <li id="' . $note->id . '"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'
                    );
                }
            }
            else {
                if (Auth::user()->hasRole('admin')) {
                    $records["data"][] = array(
                        $count++,
                        $note->reference_number,
                        $note->client->full_name,
                        $note->client->age,
                        $note->client->sex,
                        $note->open_date,
                        $note->case_worker_name,
                        $note->status,
                        $note->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                                <li id="' . $note->id . '"><a href="#" class="showRecord label"><i class="fa fa-eye "></i> View </a></li>
                                <li id="' . $note->id . '"><a href="#" onclick="printPage(\'' . url("progressive/notices") . '/' . $note->id . '\');" class=" label"><i class="fa fa-print "></i> Print</a></li>
                                <li id="' . $note->id . '"><a href="' . url('download/notice/pdf') . '/' . $note->id . '" class="label"><i class="fa fa-file-pdf-o "></i> pdf</a></li>
                                <li id="' . $note->id . '"><a href="#" class="editRecord label "><i class="fa fa-pencil "></i> Edit </a></li>
                                <li id="' . $note->id . '"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'
                    );
                }
                else
                {
                    $records["data"][] = array(
                        $count++,
                        $note->reference_number,
                        $note->client->full_name,
                        $note->client->age,
                        $note->client->sex,
                        $note->open_date,
                        $note->case_worker_name,
                        $note->status,
                        $note->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                                <li id="' . $note->id . '"><a href="#" class="showRecord label"><i class="fa fa-eye "></i> View </a></li>
                                <li id="' . $note->id . '"><a href="#" onclick="printPage(\'' . url("progressive/notices") . '/' . $note->id . '\');" class=" label"><i class="fa fa-print "></i> Print</a></li>
                                <li id="' . $note->id . '"><a href="' . url('download/notice/pdf') . '/' . $note->id . '" class="label"><i class="fa fa-file-pdf-o "></i> pdf</a></li>
                            </ul>
                        </li>
                    </ul>'
                    );
                }
            }
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
        return view('progress.notices.create');
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
                'case_worker_name' => 'required',
                'subjective_information' => 'required',
                'status' => 'required',
                'camp_id' => 'required'
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $notice = new ProgressNote;
                $notice->open_date = date('Y-m-d',strtotime($request->open_date));
                $notice->subjective_information = $request->subjective_information;
                $notice->objective_information = $request->objective_information;
                $notice->analysis = $request->analysis;
                $notice->planning = $request->planning;
                $notice->case_worker_name = $request->case_worker_name;
                $notice->status = $request->status;
                $notice->created_by = Auth::user()->id;
                $notice->camp_id= $request->camp_id;
                $notice->client_id = $request->client_id;
                $notice->save();

                //Create references
                $notice->reference_number="CBR/".date("Y")."/NT-".str_pad($notice->id,4,'0',STR_PAD_LEFT);
                $notice->save();
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
        $notice =  ProgressNote::find($id);
        return view('progress.notices.show',compact('notice'));
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
        $notice =  ProgressNote::find($id);
        return view('progress.notices.edit',compact('notice'));
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
                'case_worker_name' => 'required',
                'status' => 'required',
                'camp_id' => 'required'
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
                $notice =  ProgressNote::find($id);
                $notice->open_date = date('Y-m-d',strtotime($request->open_date));
                $notice->subjective_information = $request->subjective_information;
                $notice->objective_information = $request->objective_information;
                $notice->analysis = $request->analysis;
                $notice->planning = $request->planning;
                $notice->case_worker_name = $request->case_worker_name;
                $notice->status = $request->status;
                $notice->camp_id= $request->camp_id;
                $notice->updated_by = Auth::user()->id;
                $notice->save();
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
        $notice =  ProgressNote::find($id);
        $notice->delete();
    }
}
