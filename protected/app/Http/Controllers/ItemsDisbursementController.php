<?php

namespace App\Http\Controllers;

use App\Beneficiary;
use App\DumpMaterialSupport;
use App\ItemsCategories;
use App\ItemsDisbursement;
use App\ItemsInventory;
use App\MaterialSuportItems;
use App\MateriaSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests;

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
        $disbursements =MateriaSupport::all();
        return view('inventory.disbursement.index',compact('disbursements'));
    }
    public function showBeneficiaries()
    {
        //
        $beneficiaries=Beneficiary::all()->take(10);
        return view('inventory.disbursement.beneficiaries',compact('beneficiaries'));
    }
    public function showImport()
    {
        //
        return view('inventory.disbursement.import');
    }


    public function showImportErrors()
    {
        //
        $disbursements=DumpMaterialSupport::all();
        return view('inventory.disbursement.showerrors',compact('disbursements'));
    }
    public function postImport(Request $request)
    {
        //
      //  try {
            $this->validate($request, [
                'clients_file' => 'required|mimes:xls,xlsx',
            ]);

            $file= $request->file('clients_file');
            $destinationPath = public_path() .'/uploads/temp/';
            $filename   = str_replace(' ', '_', $file->getClientOriginalName());

            $file->move($destinationPath, $filename);

            Excel::load($destinationPath . $filename, function ($reader) {

                $results = $reader->get();

                \DB::table('dump_material_supports')->truncate();
                $results->each(function($row) {

                    if(count(Beneficiary::where('progress_number','=',str_replace(".","",$row->progress_number))->where('full_name','=',ucwords(strtolower($row->full_name)))->get()) > 0 )
                    {
                        $beneficiary=Beneficiary::where('progress_number','=',str_replace(".","",$row->progress_number))
                                              ->where('full_name','=',ucwords(strtolower($row->full_name)))->get()->first();
                    }
                    else
                    {
                        $beneficiary = new Beneficiary;
                        $beneficiary->progress_number = str_replace(".","",$row->progress_number);
                        $beneficiary->full_name = ucwords(strtolower($row->full_name));
                        $beneficiary->address = $row->address;
                        $beneficiary->save();
                    }

                    if(! count(ItemsCategories::where('category_name','=',ucwords(strtolower($row->category)))->get()) > 0)
                    {
                        $categories=new ItemsCategories;
                        $categories->category_name=ucwords(strtolower($row->category));
                        $categories->save();
                    }
                    else
                    {
                        $categories=ItemsCategories::where('category_name','=',ucwords(strtolower($row->category)))->get()->first();
                    }

                    if(! count(ItemsInventory::where('item_name','=',ucwords(strtolower($row->item)))->get()))
                    {
                        $item=new ItemsInventory;
                        $item->item_name=ucwords(strtolower($row->item));
                        $item->category_id= $categories->id;
                        $item->status="Available";
                        $item->save();
                    }
                    else
                    {
                        $item=ItemsInventory::where('item_name','=',ucwords(strtolower($row->item)))->get()->first();
                    }
                    if(count(MateriaSupport::where('beneficiary_id','=',$beneficiary->id)->where('item_id','=',$item->id)->where('distributed_date','=',date("Y-m-d",strtotime($row->distributed_date)))->get()) > 0)
                    {
                        $disbursement=new DumpMaterialSupport;
                        $disbursement->progress_number=$row->progress_number;
                        $disbursement->donor_type=$row->donor_type;
                        $disbursement->address=$row->address;
                        $disbursement->item=$row->item;
                        $disbursement->quantity=$row->quantity;
                        $disbursement->distributed_date=date("Y-m-d",strtotime($row->distributed_date));
                        $disbursement->error_descriptions="Item details already exist";
                        $disbursement->save();
                        $this->error_found="Beneficiary already received the items";
                    }
                    else
                    {
                        $disbursement=new MateriaSupport;
                        $disbursement->donor_type=$row->donor_type;
                        $disbursement->beneficiary_id=$beneficiary->id;
                        $disbursement->item_id=$item->id;
                        $disbursement->quantity=$row->quantity;
                        $disbursement->distributed_date=date("Y-m-d",strtotime($row->distributed_date));

                        $disbursement->save();
                    }
                });

            });

            File::delete($destinationPath . $filename); //Delete after upload
            if($this->error_found != "")
            {
                return  redirect('inventory/disbursement/import/errors');
            }
            else
            {
                return  redirect('inventory/disbursement');
            }

      /*  } catch (\Exception $e) {

           // echo $e->getMessage();
             return  redirect()->back()->with('error',$e->getMessage());
        }
      */
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $beneficiary=Beneficiary::find($id);
        return view('inventory.disbursement.create',compact('beneficiary'));
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
        if(count(Beneficiary::where('progress_number','=',$request->progress_number)->get()) > 0)
        {
            if(count($request->item) >0 && $request->item != null)
            {
                  $qcount=0;
                  $error="";
                foreach ($request->item as $items)
                {
                    if($items != "" && $items != null)
                    {
                        if(!count(MateriaSupport::where('progress_number','=',$request->progress_number)->where('item_id','=',$items)->where('distributed_date','=',date("Y-m-d",strtotime($request->distributed_date)))->get()) > 0)
                        {
                            $disbursement = new MateriaSupport;
                            $disbursement->progress_number = $request->progress_number;
                            $disbursement->donor_type = $request->donor_type;
                            $disbursement->item_id = $items;
                            $disbursement->quantity = $request->quantity[$qcount];
                            $disbursement->distributed_date = $request->distributed_date;
                            $disbursement->beneficiary_id = $request->beneficiary_id;
                            $disbursement->save();
                        }
                        else
                        {
                            $item=ItemsInventory::find($items);
                            $error .= "Beneficiary [".$request->progress_number."] Has already received Item [".$item->item_name."] for date [ $request->distributed_date] <br/>" ;
                        }
                        
                        $qcount++;
                    }
                    else
                    {
                        $error ="Save failed no item entered";
                    }

                }
                if($error != "")
                {return "<span class='text-danger'><i class='fa fa-info'></i> $error</span>";}
                else{return "<span class='text-success'><i class='fa fa-info'></i> Saved successfully</span>";}

            }
            else
            {
                return "<span class='text-danger'><i class='fa fa-info'></i> Save failed no item entered</span>";
            }

        }
        else
        {
            return "<span class='text-danger'><i class='fa fa-info'></i> Progress number not found in beneficiaries list</span>";
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
        $disbursement=MateriaSupport::find($id);
        return view('inventory.disbursement.pdf',compact('disbursement'));
    }
    public function downloadPdf($id)
    {
        //
        $disbursement=MateriaSupport::find($id);
        $fo = 'This form is applicable for identification of functional needs of PWDs/PSNs according to the components <br/>of the Global CBR matrix ( Health , Education ,  Livelihood , social and Empowerment ).';
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
        $disbursement=MateriaSupport::find($id);
        return view('inventory.disbursement.edit',compact('disbursement'));
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
        $disbursement=MateriaSupport::find($request->id);
        $disbursement->donor_type=$request->donor_type;
        $disbursement->item_id=$request->item;
        $disbursement->quantity=$request->quantity;
        $disbursement->distributed_date=$request->distributed_date;
        $disbursement->save();
        return "<span class='text-success'><i class='fa fa-info'></i> Saved successfully</span>";
        
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
        $disbursement=MateriaSupport::find($id);
        if(is_object($disbursement->items) && count($disbursement->items) >0)
            foreach($disbursement->items as $itm)
            {
                $itm->delete();
            }
        $disbursement->delete();
    }
}
