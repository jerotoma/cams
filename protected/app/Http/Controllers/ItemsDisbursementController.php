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
        return view('inventory.disbursement.index',compact('disbursements'));
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
                'disbursements_date' => 'required',
                'camp_id' => 'required',
                'category_id' => 'required',
                'item_id' => 'required',
                'items_distribution_file' => 'required|mimes:xls,xlsx',
            ]);



            $camp_id=$request->camp_id;
                $item_id=$request->item_id;
                $import_type=$request->import_type;

         if (!isItemOutOfStock($item_id)) {

             $distribution = new ItemsDisbursement;
             $distribution->disbursements_date = date('Y-m-d', strtotime($request->disbursements_date));
             $distribution->camp_id = $camp_id;
             $distribution->comments = $request->comments;
             $distribution->disbursements_by = ucwords(strtolower($request->disbursements_by));
             $distribution->save();

             $file = $request->file('items_distribution_file');
             $destinationPath = public_path() . '/uploads/temp/';
             $filename = str_replace(' ', '_', $file->getClientOriginalName());
             $file->move($destinationPath, $filename);
             $orfile=$destinationPath . $filename;
             Excel::load($destinationPath . $filename, function ($reader) use ($distribution, $item_id, $import_type, $camp_id) {
                 $reader->formatDates(false, 'Y-m-d');
                 $results = $reader->get();



                 $results->each(function ($row) use ($distribution, $item_id, $import_type, $camp_id) {

                     if ($import_type == 2) {

                         //Check registrations
                         $sex = "";
                         if (strtolower($row->sex) == "k" || strtolower($row->sex) == "mk" || strtolower($row->sex) == "f") {
                             $sex = "Female";
                         } else {
                             $sex = "Male";
                         }
                         if ($row->ration_card_number != "" && $row->sex != "" && $row->age != "") {
                             if (isClientRegistered($row->names, $row->sex, $row->age, $row->present_address, $row->ration_card_number)) {

                                 $client = getClientIdFromData($row->names, $row->sex, $row->age, $row->present_address, $row->ration_card_number);
                                 if (!isNotInDistributionLimit($item_id, $client->id)) {
                                     if (!count(ItemsDisbursementItems::where('item_id', '=', $item_id)
                                             ->where('distribution_id', '=', $distribution->id)
                                             ->where('client_id', '=', $client->id)
                                             ->where('quantity', '=', 1)->get()) > 0
                                     ) {
                                         if (!isItemOutOfStock($item_id)) {
                                             $dist_items = new ItemsDisbursementItems;
                                             $dist_items->client_id = $client->id;
                                             $dist_items->item_id = $item_id;
                                             $dist_items->quantity = 1;
                                             $dist_items->distribution_id = $distribution->id;
                                             $dist_items->distribution_date = $distribution->disbursements_date;
                                             $dist_items->save();
                                             if (!isItemOutOfStock($item_id)) {
                                                 deductItems($item_id, 1);
                                             }
                                         }
                                     }
                                 }
                             }
                         }
                     } else {
                         if (count(Client::where('hai_reg_number', '=', $row->hai_reg_number)->where('camp_id', '=', $camp_id)->get()) > 0) {


                             $client = Client::where('hai_reg_number', '=', $row->hai_reg_number)->get()->first();

                             if (!isNotInDistributionLimit($item_id, $client->id)) {

                                 if (!isItemOutOfStock($item_id)) {

                                     if (!count(ItemsDisbursementItems::where('item_id', '=', $item_id)
                                             ->where('distribution_id', '=', $distribution->id)
                                             ->where('client_id', '=', $client->id)
                                             ->where('quantity', '=', 1)->get()) > 0
                                     ) {
                                         $dist_items = new ItemsDisbursementItems;
                                         $dist_items->client_id = $client->id;
                                         $dist_items->item_id = $item_id;
                                         $dist_items->quantity = 1;
                                         $dist_items->distribution_id = $distribution->id;
                                         $dist_items->distribution_date = $distribution->disbursements_date;
                                         $dist_items->save();
                                         if (!isItemOutOfStock($item_id)) {
                                             deductItems($item_id, 1);
                                         }
                                     }
                                 }


                             }

                         }

                     }
                 });

             });

             File::delete($orfile);

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

                    if (!isNotInDistributionLimit($request->item_id, $client->id)) {

                            if (!isItemOutOfStock($request->item_id)) {

                                $distribution = new ItemsDisbursement;
                                $distribution->disbursements_date = date('Y-m-d', strtotime($request->disbursements_date));
                                $distribution->camp_id = $request->camp_id;
                                $distribution->comments = $request->comments;
                                $distribution->disbursements_by = ucwords(strtolower($request->disbursements_by));
                                $distribution->save();
                                if (!count(ItemsDisbursementItems::where('item_id', '=', $request->item_id)
                                        ->where('distribution_id', '=', $distribution->id)
                                        ->where('client_id', '=', $client->id)
                                        ->where('quantity', '=', 1)->get()) > 0
                                ) {
                                    $dist_items = new ItemsDisbursementItems;
                                    $dist_items->client_id = $client->id;
                                    $dist_items->item_id = $request->item_id;
                                    $dist_items->quantity = $request->quantity;
                                    $dist_items->distribution_id = $distribution->id;
                                    $dist_items->distribution_date = $distribution->disbursements_date;
                                    $dist_items->save();
                                    if (!isItemOutOfStock($request->item_id)) {
                                        deductItems($request->item_id, $request->quantity);

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
