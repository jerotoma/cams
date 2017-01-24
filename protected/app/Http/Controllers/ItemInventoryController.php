<?php

namespace App\Http\Controllers;

use App\ItemsCategories;
use App\ItemsInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;

class ItemInventoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    } /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        //
        return view('inventory.index');
    }
    public function index()
    {
        //
        $items=ItemsInventory::all();
        return view('inventory.items.index',compact('items'));
    }
    //Import
    public function showImport()
    {
        //
        return view('inventory.items.import');
    }
    public function postImport(Request $request)
    {
        //
        try {

            $file= $request->file('inventory_file');
            $destinationPath = public_path() .'/uploads/temp/';
            $filename   = str_replace(' ', '_', $file->getClientOriginalName());

            $file->move($destinationPath, $filename);

            Excel::load($destinationPath . $filename, function ($reader) {

                $results = $reader->get();

                $results->each(function($row) {
                    
                    //Categories 
                    $cate_id="";
                   $cate= ItemsCategories::where('category_name','=',$row->category)->get()->first();
                    if(count($cate) >0 && $cate != null)
                    {
                        $cate_id= $cate->id; 
                    }
                    else
                    {
                        $cate= new ItemsCategories;
                        $cate->category_name=$row->category;
                        $cate->save();
                        $cate_id= $cate->id;
                    }
                    //Items
                    $item= ItemsInventory::where('item_name','=',$row->item_name)->get()->first();
                    if(count($item) >0 && $item != null)
                    {
                        
                    }
                    else
                    {
                        $item=new ItemsInventory;
                        $item->item_name=$row->item_name;
                        $item->description=$row->description;
                        $item->category_id= $cate_id;
                        $item->quantity=$row->quantity;
                        $item->remarks=$row->remarks;
                        $item->status="Available";
                        $item->save(); 
                    }
                   
                });

            });

            File::delete($destinationPath . $filename); //Delete after upload

            return  redirect('inventory');
        } catch (\Exception $e) {

            //echo $e->getMessage();
            return  redirect()->back()->with('error',$e->getMessage());
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
        return view('inventory.items.create');
    }
    public function reports()
    {
        //
        return view('inventory.reports');
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
       
        $item=new ItemsInventory;
        $item->item_name=$request->item_name;
        $item->description=$request->description;
        $item->category_id=$request->category_id;
        $item->quantity=$request->quantity;
        $item->remarks=$request->remarks;
        $item->status=$request->status;
        $item->save();
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
        $item=ItemsInventory::find($id);
        return view('inventory.items.show',compact('item'));
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
        $item=ItemsInventory::find($id);
        return view('inventory.items.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $item=ItemsInventory::find($request->id);
        $item->item_name=$request->item_name;
        $item->description=$request->description;
        $item->category_id=$request->category_id;
        $item->quantity=$request->quantity;
        $item->remarks=$request->remarks;
        $item->status=$request->status;
        $item->save();
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
        $item=ItemsInventory::find($id);
        if(is_object($item->supports) && $item->supports != null)
        {
            foreach ($item->supports as $support)
            {
                $support->delete();
            }
        }
        $item->delete();
    }
    
    //Import

}
