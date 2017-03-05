<?php

namespace App\Http\Controllers;


use App\Camp;
use App\Client;
use App\ItemsCategories;
use App\ItemsDisbursement;
use App\ItemsDisbursementItems;
use App\ItemsInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ItemsDisbursementController extends Controller
{
    protected  $error_found;
    public function __construct()
    {
        $this->middleware('auth');
        $this->error_found="";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $disbursements =ItemsDisbursement::all();

        //Audit trail
        AuditRegister("ItemsDisbursementController","View All ","");
        return view('inventory.disbursement.index',compact('disbursements'));
    }
    public function AuthorizeAll()
    {
        //
        if (Auth::user()->can('authorize')){

            $disbursements=ItemsDisbursement::where('auth_status', '=', 'pending')
                ->update([
                    'auth_status' => 'authorized',
                    'auth_by' => Auth::user()->username,
                    'auth_date' => date('Y-m-d H:i')
                ]);

            //Audit trail
            AuditRegister("ItemsDisbursementController","AuthorizeAllAssessments",$disbursements);

        }else{
            return null;
        }

    }
    public function AuthorizeItemsDisbursementById($id)
    {
        //
        if (Auth::user()->can('authorize')){

            $disbursements=ItemsDisbursement::find($id)
                ->update([
                    'auth_status' => 'authorized',
                    'auth_by' => Auth::user()->username,
                    'auth_date' => date('Y-m-d H:i')
                ]);
            //Audit trail
            AuditRegister("ItemsDisbursementController","AuthorizeItemsDisbursementById",$disbursements);
        }else{
            return null;
        }
    }
    public function getDistributionListJson()
    {
        //
        $disbursements=ItemsDisbursement::all();
        $iTotalRecords =count(ItemsDisbursement::all());
        $sEcho = intval(10);

        $records = array();
        $records["data"] = array();


        $count=1;
        foreach($disbursements as $disbursement) {
            $camp_name="";
            if (is_object($disbursement->camp) && is_object($disbursement->camp)){
                $camp_name =$disbursement->camp->camp_name;
            }
            if ($disbursement->auth_status == "pending") {
                if (Auth::user()->can('authorize')) {
                    $records["data"][] = array(
                        $count++,
                        $disbursement->disbursements_date,
                        $disbursement->disbursements_by,
                        $disbursement->comments,
                        $camp_name,
                        $disbursement->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$disbursement->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$disbursement->id.'"><a href="#" class=" label " onclick="printPage(\''.url('print/items/distributions').'/'.$disbursement->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$disbursement->id.'"><a href="'.url('download/pdf/items/distributions').'/'.$disbursement->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
                             <li id="'.$disbursement->id.'"><a href="#" class="authorizeRecord label "><i class="fa fa-check "></i> Authorize </a></li>
                             <li id="'.$disbursement->id.'"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'
                    );
                }
                elseif (Auth::user()->hasRole('inputer'))
                {
                    $records["data"][] = array(
                        $count++,
                        $disbursement->disbursements_date,
                        $disbursement->disbursements_by,
                        $disbursement->comments,
                        $camp_name,
                        $disbursement->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$disbursement->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$disbursement->id.'"><a href="#" class=" label " onclick="printPage(\''.url('print/items/distributions').'/'.$disbursement->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$disbursement->id.'"><a href="'.url('download/pdf/items/distributions').'/'.$disbursement->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
                             <li id="'.$disbursement->id.'"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'
                    );
                }
            }
            else{
                if (Auth::user()->hasRole('admin'))
                {
                    $records["data"][] = array(
                        $count++,
                        $disbursement->disbursements_date,
                        $disbursement->disbursements_by,
                        $disbursement->comments,
                        $camp_name,
                        $disbursement->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$disbursement->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$disbursement->id.'"><a href="#" class=" label " onclick="printPage(\''.url('print/items/distributions').'/'.$disbursement->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$disbursement->id.'"><a href="'.url('download/pdf/items/distributions').'/'.$disbursement->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
                             <li id="'.$disbursement->id.'"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'
                    );
                }
                else{
                    $records["data"][] = array(
                        $count++,
                        $disbursement->disbursements_date,
                        $disbursement->disbursements_by,
                        $disbursement->comments,
                        $camp_name,
                        $disbursement->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$disbursement->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$disbursement->id.'"><a href="#" class=" label " onclick="printPage(\''.url('print/items/distributions').'/'.$disbursement->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$disbursement->id.'"><a href="'.url('download/pdf/items/distributions').'/'.$disbursement->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
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
    
    public function showImport()
    {
        //
        return view('inventory.disbursement.import');
    }
    
    public function postImport(Request $request)
    {


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('inventory.disbursement.create');
    }
    public function showBulk()
    {
        //
        return view('inventory.disbursement.bulk');
    }
    public function postBulk(Request $request)
    {
        //
        try {
            $this->validate($request, [
                'disbursements_date' => 'required|before:tomorrow',
                'camp_id' => 'required',
                'category_id' => 'required',
                'item_id' => 'required',
                'import_type' => 'required',
                'items_distribution_file' => 'required|mimes:xls,xlsx',
            ]);



         if (!isItemOutOfStockNoQ($request->item_id)) {


             $file = $request->file('items_distribution_file');
             $destinationPath = public_path() . '/uploads/temp/';
             $filename = str_replace(' ', '_', $file->getClientOriginalName());
             $file->move($destinationPath, $filename);
             $orfile=$destinationPath . $filename;
             Excel::load($destinationPath . $filename, function ($reader) use ($request) {
                 $reader->formatDates(false, 'Y-m-d');
                 $results = $reader->get();





                     if ($request->import_type == 2) {

                         $distribution = new ItemsDisbursement;
                         $distribution->disbursements_date = date('Y-m-d', strtotime($request->disbursements_date));
                         $distribution->camp_id = $request->camp_id;
                         $distribution->comments = $request->comments;
                         $distribution->disbursements_by = ucwords(strtolower($request->disbursements_by));
                         $distribution->save();

                         $results->each(function ($row) use ($request,$distribution) {

                             if ($row->names != "" && $row->names != null && $row->sex != "" && $row->sex != null) {
                                 $sex = "";
                                 if (strtolower($row->sex) == "k" || strtolower($row->sex) == "mk" || strtolower($row->sex) == "f") {
                                     $sex = "Female";
                                 } else {
                                     $sex = "Male";
                                 }
                                 $client_number = strtoupper(strtolower(preg_replace('/\s+/S', "", $row->unique_id)));
                                 $full_name = ucwords(strtolower(preg_replace('/\s+/S', " ", $row->names)));
                                 $age = intval($row->age);
                                 $present_address = ucwords(strtolower(preg_replace('/\s+/S', " ", $row->present_address)));
                                 $ration_card_number = strtoupper(strtolower(preg_replace('/\s+/S', "", $row->ration_card_number)));
                                 $quantity = intval($row->quantity);

                                 if (count(Client::where('client_number', '=', $client_number)
                                         ->where('full_name', '=', $full_name)
                                         ->where('age', '=', $age)
                                         ->where('sex', '=', $sex)
                                         ->where('camp_id', '=', $request->camp_id)
                                         ->where('present_address', '=', $present_address)
                                         ->where('ration_card_number', '=', $ration_card_number)->get()) > 0
                                 ) {

                                     $client = Client::where('client_number', '=', $client_number)
                                         ->where('full_name', '=', $full_name)
                                         ->where('age', '=', $age)
                                         ->where('sex', '=', $sex)
                                         ->where('camp_id', '=', $request->camp_id)
                                         ->where('present_address', '=', $present_address)
                                         ->where('ration_card_number', '=', $ration_card_number)->get()->first();


                                     if ($client != null && count($client) > 0) {

                                         if (isNotInDistributionLimit($request->item_id, $client->id,$distribution->disbursements_date)) {

                                             if (!isItemOutOfStock($request->item_id,$quantity)) {

                                                 if (!count(ItemsDisbursementItems::where('item_id', '=', $request->item_id)
                                                         ->where('distribution_id', '=', $distribution->id)
                                                         ->where('client_id', '=', $client->id)
                                                         ->where('quantity', '=', $quantity)->get()) > 0
                                                 ) {
                                                     $dist_items = new ItemsDisbursementItems;
                                                     $dist_items->client_id = $client->id;
                                                     $dist_items->item_id = $request->item_id;
                                                     $dist_items->quantity = $quantity;
                                                     $dist_items->distribution_id = $distribution->id;
                                                     $dist_items->distribution_date = $distribution->disbursements_date;
                                                     $dist_items->save();
                                                     if (!isItemOutOfStock($request->item_id,$quantity)) {
                                                         deductItems($request->item_id, $quantity);
                                                     }
                                                 }
                                             }


                                         }
                                     }

                                 }

                             }

                         });
                     } else {
                         $distribution = new ItemsDisbursement;
                         $distribution->disbursements_date = date('Y-m-d', strtotime($request->disbursements_date));
                         $distribution->camp_id = $request->camp_id;
                         $distribution->comments = $request->comments;
                         $distribution->disbursements_by = ucwords(strtolower($request->disbursements_by));
                         $distribution->save();

                         $results->each(function ($row) use ($request,$distribution) {
                             if (count(Client::where('hai_reg_number', '=', $row->hai_reg_number)->where('camp_id', '=', $request->camp_id)->get()) > 0) {


                                 $client = Client::where('hai_reg_number', '=', $row->hai_reg_number)->get()->first();

                                 if (isNotInDistributionLimit($request->item_id, $client->id,$distribution->disbursements_date)) {

                                     if (!isItemOutOfStock($request->item_id,intval($row->quantity))) {

                                         if (!count(ItemsDisbursementItems::where('item_id', '=', $request->item_id)
                                                 ->where('distribution_id', '=', $distribution->id)
                                                 ->where('client_id', '=', $client->id)
                                                 ->where('quantity', '=', intval($row->quantity))->get()) > 0
                                         ) {
                                             $dist_items = new ItemsDisbursementItems;
                                             $dist_items->client_id = $client->id;
                                             $dist_items->item_id = $request->item_id;
                                             $dist_items->quantity = 1;
                                             $dist_items->distribution_id = $distribution->id;
                                             $dist_items->distribution_date = $distribution->disbursements_date;
                                             $dist_items->save();
                                             if (!isItemOutOfStock($request->item_id,intval($row->quantity))) {
                                                 deductItems($request->item_id, intval($row->quantity));
                                             }
                                         }
                                     }


                                 }

                             }
                         });
                     }


             });

             File::delete($orfile);

             //Audit trail
             AuditRegister("ItemsDisbursementController","Imported Item Distribution ",$orfile);

            return redirect('items/distributions');

         }else{
             return redirect()->back()->with('error','Item is out of stock');
         }

        }
        catch (\Exception $ex)
        {
            return redirect()->back()->with('error',$ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'disbursements_date' => 'required|before:tomorrow',
                'camp_id' => 'required',
                'item_id' => 'required',
                'quantity' => 'required|numeric',
                'hai_reg_number' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {

                if(count(Client::where('hai_reg_number','=',$request->hai_reg_number)->where('camp_id','=',$request->camp_id)->get()) > 0) {


                    $client=Client::where('hai_reg_number','=',$request->hai_reg_number)->get()->first();


                    if (!isNotInDistributionLimit($request->item_id, $client->id,date('Y-m-d', strtotime($request->disbursements_date)))) {

                            if (!isItemOutOfStock($request->item_id,intval($request->quantity))) {

                                $distribution = new ItemsDisbursement;
                                $distribution->disbursements_date = date('Y-m-d', strtotime($request->disbursements_date));
                                $distribution->camp_id = $request->camp_id;
                                $distribution->comments = $request->comments;
                                $distribution->disbursements_by = ucwords(strtolower($request->disbursements_by));
                                $distribution->save();
                                if (!count(ItemsDisbursementItems::where('item_id', '=', $request->item_id)
                                        ->where('distribution_id', '=', $distribution->id)
                                        ->where('client_id', '=', $client->id)
                                        ->where('quantity', '=', intval($request->quantity))->get()) > 0
                                ) {
                                    $dist_items = new ItemsDisbursementItems;
                                    $dist_items->client_id = $client->id;
                                    $dist_items->item_id = $request->item_id;
                                    $dist_items->quantity = intval($request->quantity);
                                    $dist_items->distribution_id = $distribution->id;
                                    $dist_items->distribution_date = $distribution->disbursements_date;
                                    $dist_items->save();

                                    //Audit trail
                                    AuditRegister("ItemsDisbursementController","Imported Item Distribution ",$dist_items);

                                    if (!isItemOutOfStock($request->item_id,intval($request->quantity))) {
                                        deductItems($request->item_id, intval($request->quantity));

                                        return response()->json([
                                            'success' => true,
                                            'message' => " Saved Successful"
                                        ], 200);
                                    } else {
                                        return Response::json(array(
                                            'success' => false,
                                            'errors' => 1,
                                            'message' => "Item is out of stock "
                                        ), 400); // 400 being the HTTP code for an invalid request.
                                    }
                                }
                            }
                            else
                            {
                                return Response::json(array(
                                    'success' => false,
                                    'errors' => 1,
                                    'message' => "Item is out of stock "
                                ), 400); // 400 being the HTTP code for an invalid request.
                            }

                    }
                    else
                    {
                        return Response::json(array(
                            'success' => false,
                            'errors' => 1,
                            'message' => "Client is not eligible for receiving the item "
                        ), 400); // 400 being the HTTP code for an invalid request.
                    }
                }
                else{
                    return Response::json(array(
                        'success' => false,
                        'errors' => 1,
                        'message' => "Client is not registered in mentioned camp"
                    ), 400); // 400 being the HTTP code for an invalid request.
                }


            }
        }
        catch (\Exception $ex)
        {
            return Response::json(array(
                'success' => false,
                'errors' => 1,
                'message' => $ex->getMessage()
            ), 402); // 400 being the HTTP code for an invalid request.
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
        $disbursement=ItemsDisbursement::find($id);
        return view('inventory.disbursement.show',compact('disbursement'));
    }
    public function showPrint($id)
    {
        //
        $disbursement=ItemsDisbursement::find($id);
        return view('inventory.disbursement.pdf',compact('disbursement'));
    }


    public function downloadPdf($id)
    {
        //
        $disbursement=ItemsDisbursement::find($id);
           $pdf = \PDF::loadView('inventory.disbursement.pdf',compact('disbursement'))
            ->setOption('footer-right', 'Page [page]')
            ->setOption('page-offset', 0);
        return $pdf->download('client_material_support.pdf');
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
        $disbursement=ItemsDisbursement::find($id);
        return view('inventory.disbursement.edit',compact('disbursement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        try {
            $validator = Validator::make($request->all(), [
                'disbursements_date' => 'required|before:tomorrow',
                'camp_id' => 'required',
                'item_id' => 'required',
                'quantity' => 'required|numeric',
                'hai_reg_number' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {

                if(count(Client::where('hai_reg_number','=',$request->hai_reg_number)->where('camp_id','=',$request->camp_id)->get()) > 0) {


                    $client=Client::where('hai_reg_number','=',$request->hai_reg_number)->get()->first();


                    if (!isNotInDistributionLimit($request->item_id, $client->id,date('Y-m-d', strtotime($request->disbursements_date)))) {

                        if (!isItemOutOfStock($request->item_id,intval($request->quantity))) {

                            $distribution =  ItemsDisbursement::find($id);
                            $distribution->disbursements_date = date('Y-m-d', strtotime($request->disbursements_date));
                            $distribution->camp_id = $request->camp_id;
                            $distribution->comments = $request->comments;
                            $distribution->disbursements_by = ucwords(strtolower($request->disbursements_by));
                            $distribution->save();
                            if (!count(ItemsDisbursementItems::where('item_id', '=', $request->item_id)
                                    ->where('distribution_id', '=', $distribution->id)
                                    ->where('client_id', '=', $client->id)
                                    ->where('quantity', '=', intval($request->quantity))->get()) > 0
                            ) {
                                $dist_items = new ItemsDisbursementItems;
                                $dist_items->client_id = $client->id;
                                $dist_items->item_id = $request->item_id;
                                $dist_items->quantity = intval($request->quantity);
                                $dist_items->distribution_id = $distribution->id;
                                $dist_items->distribution_date = $distribution->disbursements_date;
                                $dist_items->save();

                                //Audit trail
                                AuditRegister("ItemsDisbursementController","Imported Item Distribution ",$dist_items);

                                if (!isItemOutOfStock($request->item_id,intval($request->quantity))) {
                                    deductItems($request->item_id, intval($request->quantity));

                                    return response()->json([
                                        'success' => true,
                                        'message' => " Saved Successful"
                                    ], 200);
                                } else {
                                    return Response::json(array(
                                        'success' => false,
                                        'errors' => 1,
                                        'message' => "Item is out of stock "
                                    ), 400); // 400 being the HTTP code for an invalid request.
                                }
                            }
                        }
                        else
                        {
                            return Response::json(array(
                                'success' => false,
                                'errors' => 1,
                                'message' => "Item is out of stock "
                            ), 400); // 400 being the HTTP code for an invalid request.
                        }

                    }
                    else
                    {
                        return Response::json(array(
                            'success' => false,
                            'errors' => 1,
                            'message' => "Client is not eligible for receiving the item "
                        ), 400); // 400 being the HTTP code for an invalid request.
                    }
                }
                else{
                    return Response::json(array(
                        'success' => false,
                        'errors' => 1,
                        'message' => "Client is not registered in mentioned camp"
                    ), 400); // 400 being the HTTP code for an invalid request.
                }


            }
        }
        catch (\Exception $ex)
        {
            return Response::json(array(
                'success' => false,
                'errors' => 1,
                'message' => $ex->getMessage()
            ), 402); // 400 being the HTTP code for an invalid request.
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
        $disbursement=ItemsDisbursement::find($id);
        if(is_object($disbursement->items) && count($disbursement->items) >0)
            foreach($disbursement->items as $itm)
            {
                $itm->delete();
            }

        //Audit trail
        AuditRegister("ItemsDisbursementController","Deleted items distributions",$disbursement);

        $disbursement->delete();
    }
}
