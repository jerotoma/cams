<?php

namespace App\Http\Controllers;

use App\InventoryReceived;
use App\ItemReceived;
use App\ItemsInventory;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;

class ItemsReceivingController extends Controller
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
        $items=InventoryReceived::all();
        return view('inventory.received.index',compact('items'));
    }
    public function AuthorizeAll()
    {
        //
        if (Auth::user()->hasPermission('authorize')){

            $items=InventoryReceived::where('auth_status', '=', 'pending')
                ->update([
                    'auth_status' => 'authorized',
                    'auth_by' => Auth::user()->username,
                    'auth_date' => date('Y-m-d H:i')
                ]);

            //Audit trail
            AuditRegister("ItemsReceivingController","AuthorizeAll",$items);

        }else{
            return null;
        }

    }
    public function AuthorizeInventoryReceivedById($id)
    {
        //
        if (Auth::user()->hasPermission('authorize')){

            $items=InventoryReceived::find($id)
                ->update([
                    'auth_status' => 'authorized',
                    'auth_by' => Auth::user()->username,
                    'auth_date' => date('Y-m-d H:i')
                ]);
            //Audit trail
            AuditRegister("ItemsReceivingController","AuthorizeInventoryReceivedById",$items);
        }else{
            return null;
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getListItemsReceived()
    {
        //
        $items=InventoryReceived::all();
        $iTotalRecords =count(InventoryReceived::all());
        $sEcho = intval(10);

        $records = array();
        $records["data"] = array();


        $count=1;
        foreach($items as $item) {

            if ($item->auth_status == "pending") {
                if (Auth::user()->hasPermission('authorize')) {
                    $records["data"][] = array(
                        $count++,
                        $item->reference_number,
                        $item->date_received,
                        $item->donor_ref,
                        $item->received_from,
                        $item->receiving_officer,
                        $item->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$item->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$item->id.'"><a href="#" class=" label " onclick="printPage(\''.url('print/inventory-received').'/'.$item->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$item->id.'"><a href="'.url('download/pdf/inventory-received').'/'.$item->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
                             <li id="'.$item->id.'"><a href="#" class="authorizeRecord label "><i class="fa fa-check "></i> Authorize </a></li>
                             <li id="'.$item->id.'"><a href="#" title="Edit" class="label editRecord "> <i class="fa fa-edit "></i> Edit</a></li>
                             <li id="'.$item->id.'"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'
                    );
                }
                elseif (Auth::user()->hasRole('inputer'))
                {
                    $records["data"][] = array(
                        $count++,
                        $item->reference_number,
                        $item->date_received,
                        $item->donor_ref,
                        $item->received_from,
                        $item->receiving_officer,
                        $item->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$item->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$item->id.'"><a href="#" class=" label " onclick="printPage(\''.url('print/inventory-received').'/'.$item->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$item->id.'"><a href="'.url('download/pdf/inventory-received').'/'.$item->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
                             <li id="'.$item->id.'"><a href="#" title="Edit" class="label editRecord "> <i class="fa fa-edit "></i> Edit</a></li>
                             <li id="'.$item->id.'"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
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
                        $item->reference_number,
                        $item->date_received,
                        $item->donor_ref,
                        $item->received_from,
                        $item->receiving_officer,
                        $item->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$item->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$item->id.'"><a href="#" class=" label " onclick="printPage(\''.url('print/inventory-received').'/'.$item->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$item->id.'"><a href="'.url('download/pdf/inventory-received').'/'.$item->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
                             <li id="'.$item->id.'"><a href="#" title="Edit" class="label editRecord "> <i class="fa fa-edit "></i> Edit</a></li>
                             <li id="'.$item->id.'"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                            </ul>
                        </li>
                    </ul>'
                    );
                }
                else{
                    $records["data"][] = array(
                        $count++,
                        $item->reference_number,
                        $item->date_received,
                        $item->donor_ref,
                        $item->received_from,
                        $item->receiving_officer,
                        $item->auth_status,
                        '<ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                             <li id="'.$item->id.'"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                             <li id="'.$item->id.'"><a href="#" class=" label " onclick="printPage(\''.url('print/inventory-received').'/'.$item->id.'\');"  ><i class="fa fa-print "></i> Print </a></li>
                             <li id="'.$item->id.'"><a href="'.url('download/pdf/inventory-received').'/'.$item->id.'" class="label "><i class="fa  fa-download"></i> Download </a></li>
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

    public function create()
    {
        //
        return view('inventory.received.create');
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
        //
            $validator = Validator::make($request->all(), [
                'reference_number' => 'required|unique:inventory_receiveds',
                'donor_ref' => 'required',
                'receiving_officer' => 'required',
                'date_received' => 'required',
                'project' => 'required',
                'items_file' => 'required',
            ]);
        $extension= strtolower($request->file('items_file')->getClientOriginalExtension());
        if($validator->fails()) {

            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 400); // 400 being the HTTP code for an invalid request.
        }elseif($extension !="xlsx" && $extension !="xls")
            {
                return Response::json(array(
                    'success' => false,
                    'errors' => 1,
                    'message' => 'Invalid file type! allowed only xls, xlsx'
                ), 400); // 400 being the HTTP code for an invalid request.

            }
        else{

            if(! count(InventoryReceived::where('reference_number','=',$request->reference_number)
                    ->where('donor_ref','=',$request->donor_ref)
                    ->where('received_from','=',$request->received_from)
                    ->where('receiving_officer','=',$request->receiving_officer)
                    ->where('project','=',$request->project)
                    ->where('date_received','=',date("Y-m-d",strtotime($request->date_received)))->get()) >0) {

                $items = new InventoryReceived;
                $items->reference_number = $request->reference_number;
                $items->date_received = date("Y-m-d",strtotime($request->date_received));
                $items->donor_ref = $request->donor_ref;
                $items->received_from = $request->received_from;
                $items->receiving_officer = $request->receiving_officer;
                $items->project = $request->project;
                $items->onward_delivery = $request->onward_delivery;
                $items->comments = $request->comments;
                $items->created_by =Auth::user()->username;
                $items->save();

                //Audit trail
                AuditRegister("ItemsReceivingController","InventoryReceived",$items);

                $file= $request->file('items_file');
                $destinationPath = public_path() .'/uploads/temp/';
                $filename   = str_replace(' ', '_', $file->getClientOriginalName());
                $file->move($destinationPath, $filename);
                Excel::load($destinationPath . $filename, function ($reader) use($items) {

                    $results = $reader->get();

                    $results->each(function($row) use($items){

                        //Categories

                        //Items
                        if($row->item_name != null & $row->quantity !="")
                        {
                            //Get Item
                            $itm_id="";

                            if(count(ItemsInventory::where('item_name','=',ucwords($row->item_name))->get()) >0)
                            {
                                $invItem =ItemsInventory::where('item_name','=',ucwords($row->item_name))->get()->first();
                                $itm_id=$invItem->id;
                            }
                            else
                            {
                                $invItem=new ItemsInventory;
                                $invItem->item_name=$row->item_name;
                                $invItem->description=$row->description;
                                $invItem->remarks=$row->description;
                                $invItem->status="Available";
                                $invItem->save();

                                $itm_id=$invItem->id;
                            }

                            if (!count(ItemReceived::where('received_id','=',$items->id)
                                    ->where('item_id','=',$itm_id)
                                    ->where('quantity','=',$items->quantity)
                                    ->where('description','=',$items->description)->get())>0)
                            {
                                $tmreceived=new ItemReceived;
                                $tmreceived->received_id=$items->id;
                                $tmreceived->item_id=$invItem->id;
                                $tmreceived->quantity=intval($row->quantity);
                                $tmreceived->description=$row->description;
                                $tmreceived->save();

                                //Increase inventory
                                $invItem->quantity =intval($invItem->quantity) + intval($row->quantity);
                                $invItem->status="Available";
                                $invItem->save();

                                //Audit trail
                                AuditRegister("ItemsReceivingController","Received items",$tmreceived);
                            }


                        }


                    });

                });

                File::delete($destinationPath . $filename); //Delete after upload
                return response()->json([
                    'success' => true,
                    'message' => "<span class='text-success'><i class='fa fa-info'></i> Saved successfully</span>"
                ], 200);

            }
            else
            {
                return Response::json(array(
                    'success' => false,
                    'errors' => "<span class='text-danger'><h3><i class='fa fa-info'></i> Save failed  Record exist</h3></span>"
                ), 400); // 400 being the HTTP code for an invalid request.

            }
        }
        } catch (\Exception $ex) {

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
        $item=InventoryReceived::find($id);
        return view('inventory.received.show',compact('item'));
    }
    public function loadPrintForm($id)
    {
        //
        $item=InventoryReceived::find($id);
        return view('inventory.received.pdf',compact('item'));
    }
    //Download
    public function downloadPDF($id)
    {
        //
        $item=InventoryReceived::find($id);
        $pdf = \PDF::loadView('inventory.received.pdf', compact('item'))
            ->setOption('page-offset', 0)
            ->setOption('disable-smart-shrinking',true)->setOption('zoom','0.78');
        return $pdf->download('goods_received_note.pdf');
    }
    public function showImport()
    {
        //
        return view('inventory.received.import');
    }
    public function postImport(Request $request)
    {
        //
        try {

            $validator = Validator::make($request->all(), [
                'inventory_file' => 'required',
            ]);
            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator)->withInput();

            }
            $extension= strtolower($request->file('inventory_file')->getClientOriginalExtension());
            if($extension !="xlsx" && $extension !="xls")
            {
                return redirect()->back()->with('message', 'Invalid file type! allowed only xls, xlsx')->withInput();
            }

            $file= $request->file('inventory_file');
            $destinationPath = public_path() .'/uploads/temp/';
            $filename   = str_replace(' ', '_', $file->getClientOriginalName());

            $file->move($destinationPath, $filename);

            Excel::load($destinationPath . $filename, function ($reader) {

                $results = $reader->get();

                $results->each(function($row) {

                    //Categories

                    //Items
                    if($row->item_name != null & $row->item_name !="")
                    {
                        if(! count(ItemsInventory::where('item_name','=',$row->item_name)->get()) >0)
                        {
                            $item=new ItemsInventory;
                            $item->item_name=$row->item_name;
                            $item->status="Available";
                            $item->save();
                        }

                        if(! count(InventoryReceived::where('item_name','=',$row->item_name)->where('way_bill_number','=',$row->way_bill_number)->where('donor','=',$row->donor)->where('population','=',$row->population)->where('quantity','=',$row->quantity)->where('received_date','=',date("Y-m-d",strtotime($row->received_date)))->get()) >0)
                        {
                            //
                            $items=new InventoryReceived;
                            $items->item_name=$row->item_name;
                            $items->way_bill_number=$row->way_bill_number;
                            $items->received_from=$row->received_from;
                            $items->donor=$row->donor;
                            $items->population=$row->population;
                            $items->receiver=$row->received_by;
                            $items->quantity=$row->quantity;
                            $items->received_date=date("Y-m-d",strtotime($row->received_date));
                            $items->created_by =Auth::user()->username;
                            $items->save();
                        }
                        if(count(ItemsInventory::where('item_name','=',ucwords($row->item_name))->get()) >0)
                        {
                            $invItem =ItemsInventory::where('item_name','=',ucwords($row->item_name))->get()->first();
                            $itm_id=$invItem->id;
                        }
                        else
                        {
                            $invItem=new ItemsInventory;
                            $invItem->item_name=$row->item_name;
                            $invItem->description=$row->description;
                            $invItem->remarks=$row->description;
                            $invItem->status="Available";
                            $invItem->save();

                            $itm_id=$invItem->id;
                        }

                        if (!count(ItemReceived::where('received_id','=',$items->id)
                                ->where('item_id','=',$itm_id)
                                ->where('quantity','=',$items->quantity)
                                ->where('description','=',$items->description)->get())>0)
                        {
                            $tmreceived=new ItemReceived;
                            $tmreceived->received_id=$items->id;
                            $tmreceived->item_id=$invItem->id;
                            $tmreceived->quantity=intval($row->quantity);
                            $tmreceived->description=$row->description;
                            $tmreceived->save();

                            $invItem->quantity =intval($invItem->quantity) + intval($row->quantity);
                            $invItem->status="Available";
                            $invItem->save();
                        }

                    }


                });

            });

            File::delete($destinationPath . $filename); //Delete after upload

            return  redirect('inventory/received');
        } catch (\Exception $e) {

            //echo $e->getMessage();
            return  redirect()->back()->with('error',$e->getMessage());
        }
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
        $item=InventoryReceived::find($id);
        return view('inventory.received.edit',compact('item'));
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
            //
            $validator = Validator::make($request->all(), [
                'reference_number' => 'required|unique:inventory_receiveds,reference_number,'.$id,
                'donor_ref' => 'required',
                'receiving_officer' => 'required',
                'date_received' => 'required',
                'project' => 'required',
                'items_file' => 'required',
            ]);
            $extension= strtolower($request->file('items_file')->getClientOriginalExtension());
            if($validator->fails()) {

                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            }
            elseif($extension !="xlsx" && $extension !="xls")
            {
                return Response::json(array(
                    'success' => false,
                    'errors' => 1,
                    'message' => 'Invalid file type! allowed only xls, xlsx'
                ), 400); // 400 being the HTTP code for an invalid request.

            }
            else{

                if(! count(InventoryReceived::where('reference_number','=',$request->reference_number)
                        ->where('donor_ref','=',$request->donor_ref)
                        ->where('received_from','=',$request->received_from)
                        ->where('receiving_officer','=',$request->receiving_officer)
                        ->where('project','=',$request->project)
                        ->where('date_received','=',date("Y-m-d",strtotime($request->date_received)))
                        ->where('id','<>',$id)->get()) >0) {

                    $items = InventoryReceived::find($id);
                    $items->reference_number = $request->reference_number;
                    $items->date_received = date("Y-m-d",strtotime($request->date_received));
                    $items->donor_ref = $request->donor_ref;
                    $items->received_from = $request->received_from;
                    $items->receiving_officer = $request->receiving_officer;
                    $items->project = $request->project;
                    $items->onward_delivery = $request->onward_delivery;
                    $items->comments = $request->comments;
                    $items->updated_by =Auth::user()->username;
                    $items->save();

                    //Audit trail
                    AuditRegister("ItemsReceivingController","Updates InventoryReceived",$items);

                    foreach (ItemReceived::where('received_id','=',$items->id)->get() as $item)
                    {
                        $item->delete();
                    }

                    $file= $request->file('items_file');
                    $destinationPath = public_path() .'/uploads/temp/';
                    $filename   = str_replace(' ', '_', $file->getClientOriginalName());
                    $file->move($destinationPath, $filename);
                    Excel::load($destinationPath . $filename, function ($reader) use($items) {

                        $results = $reader->get();

                        $results->each(function($row) use($items){

                            //Categories

                            //Items
                            if($row->item_name != null & $row->quantity !="" && $row->quantity > 0)
                            {
                                //Get Item
                                $itm_id="";

                                if(count(ItemsInventory::where('item_name','=',ucwords($row->item_name))->get()) >0)
                                {
                                    $invItem =ItemsInventory::where('item_name','=',ucwords($row->item_name))->get()->first();
                                    $itm_id=$invItem->id;
                                }
                                else
                                {
                                    $invItem=new ItemsInventory;
                                    $invItem->item_name=$row->item_name;
                                    $invItem->description=$row->description;
                                    $invItem->remarks=$row->description;
                                    $invItem->status="Available";
                                    $invItem->save();

                                    $itm_id=$invItem->id;
                                }

                                if (!count(ItemReceived::where('received_id','=',$items->id)
                                        ->where('item_id','=',$itm_id)
                                        ->where('quantity','=',$items->quantity)
                                        ->where('description','=',$items->description)->get())>0)
                                {
                                    $tmreceived=new ItemReceived;
                                    $tmreceived->received_id=$items->id;
                                    $tmreceived->item_id=$invItem->id;
                                    $tmreceived->quantity=intval($row->quantity);
                                    $tmreceived->description=$row->description;
                                    $tmreceived->save();

                                    $invItem->quantity =intval($invItem->quantity) + intval($row->quantity);
                                    $invItem->status="Available";
                                    $invItem->save();

                                    //Audit trail
                                    AuditRegister("ItemsReceivingController","Updates ItemReceived",$tmreceived);
                                }


                            }


                        });

                    });

                    File::delete($destinationPath . $filename); //Delete after upload
                    return response()->json([
                        'success' => true,
                        'message' => "<span class='text-success'><i class='fa fa-info'></i> Saved successfully</span>"
                    ], 200);

                }
                else
                {
                    return Response::json(array(
                        'success' => false,
                        'errors' => "<span class='text-danger'><h3><i class='fa fa-info'></i> Save failed  Record exist</h3></span>"
                    ), 400); // 400 being the HTTP code for an invalid request.

                }
            }
        } catch (\Exception $ex) {

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
     *
     */
    public function destroy($id)
    {
        //
        $item=InventoryReceived::find($id);
        if(is_object($item->items) && count($item->items) >0) {
            foreach ($item->items as $itm) {
                $itm->delete();
            }
        }

        //Audit trail
        AuditRegister("ItemsReceivingController","Deleted ItemReceived",$item);
        $item->delete();
    }
}
