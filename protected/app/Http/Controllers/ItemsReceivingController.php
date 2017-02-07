<?php

namespace App\Http\Controllers;

use App\InventoryReceived;
use App\ItemReceived;
use App\ItemsInventory;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                'items_file' => 'required|mimes:xls,xlsx',
            ]);

        if($validator->fails()) {

            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
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
                $items->checked_by = $request->checked_by;
                $items->save();

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
                                $invItem->quantity=$row->quantity;
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
                                $tmreceived->item_id=$itm_id;
                                $tmreceived->quantity=$row->quantity;
                                $tmreceived->description=$row->description;
                                $tmreceived->save();
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
        return view('inventory.received.pdf',compact('item'));
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

            $this->validate($request, [
                'inventory_file' => 'required|mimes:xls,xlsx',
            ]);


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
                            $items->save();
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
                'items_file' => 'required|mimes:xls,xlsx',
            ]);

            if($validator->fails()) {

                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
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
                    $items->checked_by = $request->checked_by;
                    $items->save();

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
                                    $invItem->quantity=$row->quantity;
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
                                    $tmreceived->item_id=$itm_id;
                                    $tmreceived->quantity=$row->quantity;
                                    $tmreceived->description=$row->description;
                                    $tmreceived->save();
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
        $item->delete();
    }
}
