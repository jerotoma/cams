<?php

namespace App\Http\Controllers;

use App\CashProvision;
use App\CashProvisionClient;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CashProvisionController extends Controller
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
        $provisions=CashProvision::all();
        return view('cash.provision.index',compact('provisions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cash.provision.create');
    }
    public function showBulk()
    {
        //
        return view('cash.provision.bulk');
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

    public function showPrint($id)
    {
        //
        $provision=CashProvision::find($id);
        return view('cash.provision.pdf',compact('provision'));
    }


    public function downloadPdf($id)
    {
        //
        $provision=CashProvision::find($id);
         $pdf = \PDF::loadView('cash.provision.pdf',compact('provision'))
            ->setOption('footer-right', 'Page [page]')
            ->setOption('page-offset', 0);
        return $pdf->download('client_material_support.pdf');
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
                'provision_date' => 'required|before:tomorrow',
                'camp_id' => 'required',
                'activity_id' => 'required',
                'amount' => 'required|numeric',
                'hai_reg_number' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); // 400 being the HTTP code for an invalid request.
            } else {

                if(checkRegistrationByHAIRegCampID($request->hai_reg_number,$request->camp_id)) {


                    $client=Client::where('hai_reg_number','=',$request->hai_reg_number)->get()->first();

                    if (!isClientInProvisionLimit($request->activity_id, $client->id)) {

                        if (!isActivityOutOfFunds($request->activity_id,$request->amount)) {

                            $provision=new CashProvision;
                            $provision->provision_date=$request->provision_date;
                            $provision->provided_by=$request->provided_by;
                            $provision->comments=$request->comments;
                            $provision->camp_id=$request->camp_id;
                            $provision->created_by=Auth::user()->username;
                            $provision->activity_id =$request->activity_id;
                            $provision->save();

                            if (!isActivityOutOfFunds($request->activity_id,$request->amount)) {
                                $provision_client=new CashProvisionClient;
                                $provision_client->client_id=$client->id;
                                $provision_client->activity_id=$request->activity_id;
                                $provision_client->amount=$request->amount;
                                $provision_client->provision_id=$provision->id;
                                $provision_client->provision_date=$provision->provision_date;
                                $provision_client->save();

                                //Deduct money
                                deductActivityAmount($request->activity_id,$request->amount);

                                return Response::json(array(
                                    'success' => true,
                                    'errors' => 0,
                                    'message' => "Record saved successful"
                                ), 200); // 400 being the HTTP code for an invalid request.
                            }

                        }
                        else
                        {
                            return Response::json(array(
                                'success' => false,
                                'errors' => 1,
                                'message' => "activity run out of funds "
                            ), 400); // 400 being the HTTP code for an invalid request.
                        }

                    }
                    else
                    {
                        return Response::json(array(
                            'success' => false,
                            'errors' => 1,
                            'message' => "Client is not eligible for receiving the funds "
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
        $provision=CashProvision::findorfail($id);
        return view('cash.provision.show',compact('provision'));
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
        $provision=CashProvision::findorfail($id);
        return view('cash.provision.edit',compact('provision'));
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
        $provision=CashProvision::findorfail($id)->delete();
    }
}
