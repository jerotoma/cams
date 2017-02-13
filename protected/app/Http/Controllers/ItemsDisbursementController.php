<?php

namespace App\Http\Controllers;


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
        return view('inventory.disbursement.index',compact('disbursements'));
    }
    
    public function showImport()
    {
        //
        return view('inventory.disbursement.import');
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
                    if(count(ItemsDisbursement::where('beneficiary_id','=',$beneficiary->id)->where('item_id','=',$item->id)->where('distributed_date','=',date("Y-m-d",strtotime($row->distributed_date)))->get()) > 0)
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
                        $disbursement=new ItemsDisbursement;
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
            $validator = Validator::make($request->all(), [
                'disbursements_date' => 'required',
                'items_distribution_file' => 'required|mimes:xls,xlsx',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {
               if (count(ItemsDisbursement::where('disbursements_date','=',date('Y-m-d',strtotime($request->disbursements_date)))
                                    ->where('disbursements_by','=',ucwords(strtolower($request->disbursements_by)))->get())){
                   $distribution=ItemsDisbursement::where('disbursements_date','=',date('Y-m-d',strtotime($request->disbursements_date)))
                       ->where('disbursements_by','=',ucwords(strtolower($request->disbursements_by)))->get()->first();
               }
               else {
                   $distribution = new ItemsDisbursement;
                   $distribution->disbursements_date = date('Y-m-d', strtotime($request->disbursements_date));
                   $distribution->comments = $request->comments;
                   $distribution->disbursements_by = ucwords(strtolower($request->disbursements_by));
                   $distribution->save();
               }

                $file= $request->file('items_distribution_file');
                $destinationPath = public_path() .'/uploads/temp/';
                $filename   = str_replace(' ', '_', $file->getClientOriginalName());
                $file->move($destinationPath, $filename);

                Excel::load($destinationPath . $filename, function ($reader)use ($distribution) {
                    $reader->formatDates(false, 'Y-m-d');
                    $results= $reader->get();
                    $results->each(function($row)use ($distribution) {

                        if(count(Client::where('client_number','=',strtoupper($row->client_number))->get()) >0)
                        {
                            $client=Client::where('client_number','=',strtoupper($row->client_number))->get()->first();
                        }
                        else
                        {
                            $client=new Client;
                            $client->client_number =strtoupper($row->client_number);
                            $client->full_name =ucwords(strtolower($row->full_name));
                            $client->sex =ucwords($row->sex);
                            $client->age =$row->age;
                            $client->save();
                        }
                        if(count(ItemsCategories::where('category_name','=',ucwords(strtolower($row->item_category)))->get()) >0) {
                            $category =ItemsCategories::where('category_name','=',ucwords(strtolower($row->item_category)))->get()->first();
                        }
                        else {
                            $category = new ItemsCategories;
                            $category->category_name = ucwords(strtolower($row->item_category));
                            $category->status="Available";
                            $category->save();
                        }
                        if(count(ItemsInventory::where('item_name','=',ucwords(strtolower($row->item_name)))->get()) >0) {
                            $item=ItemsInventory::where('item_name','=',ucwords(strtolower($row->item_name)))->get()->first();
                        }else{
                            $item=new ItemsInventory;
                            $item->item_name=ucwords(strtolower($row->item_name));
                            $item->category_id= $category->id;
                            $item->status="Available";
                            $item->save();
                        }
                        if(reduceItemQuantity($item->id,$row->quantity)) {
                            if (!count(ItemsDisbursementItems::where('item_id','=',$item->id)
                                                             ->where('distribution_id','=',$distribution->id)
                                                             ->where('client_id','=',$client->id)
                                                             ->where('quantity','=',$row->quantity)->get()) >0) {
                                $dist_items = new ItemsDisbursementItems;
                                $dist_items->client_id = $client->id;
                                $dist_items->item_id = $item->id;
                                $dist_items->quantity = $row->quantity;
                                $dist_items->distribution_id = $distribution->id;
                                $dist_items->save();
                            }
                        }

                     });

            });

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
            ), 402); // 400 being the HTTP code for an invalid request.
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
    public function update(Request $request)
    {
        //
        $disbursement=ItemsDisbursement::find($request->id);
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
        $disbursement=ItemsDisbursement::find($id);
        if(is_object($disbursement->items) && count($disbursement->items) >0)
            foreach($disbursement->items as $itm)
            {
                $itm->delete();
            }
        $disbursement->delete();
    }
}
