<?php

namespace App\Http\Controllers;


use App\Camp;
use App\Client;
use App\ClientVulnerabilityCode;
use App\DumpItemsDisbursement;
use App\ItemsCategories;
use App\ItemsDisbursement;
use App\ItemsDisbursementItems;
use App\ItemsInventory;
use App\Origin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

use App\Helpers\ValidatorUtility;
use App\Helpers\AuthUtility;
use App\Helpers\PaginateUtility;
use DB;

class ItemsDisbursementController extends Controller
{
    protected  $error_found;
    protected $import_errors;
    public function __construct()
    {
        $this->middleware('auth');
        $this->error_found="";
        $this->import_errors="";
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
        if (Auth::user()->hasPermission('authorize')){
            $disbursements = ItemsDisbursement::where('auth_status', '=', 'pending')
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
        if (Auth::user()->hasPermission('authorize')){

            $disbursements=ItemsDisbursement::find($id)
                ->update([
                    'auth_status' => 'authorized',
                    'auth_by' => Auth::user()->username,
                    'auth_date' => date('Y-m-d H:i')
                ]);
            //Audit trail
            AuditRegister("ItemsDisbursementController","AuthorizeItemsDisbursementById", $disbursements);
        }else{
            return null;
        }
    }

    private function processSortRequest(Request $request, $disbursements) {
        return $disbursements->orderBy($request->sortField, $request->sortType);
     }

    public function findItemDistributions(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'sortField' => 'required',
                'sortType' => 'required|max:5',
                'perPage' => 'required',
                'page' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => ValidatorUtility::processValidatorErrorMessages($validator),
                ], 422); // 400 being the HTTP code for an invalid request.
            } else {
                $disbursements = ItemsDisbursement::join('items_disbursement_items', 'items_disbursement_items.distribution_id', '=', 'items_disbursements.id')
                        ->join('clients', 'clients.id', '=', 'items_disbursement_items.client_id')
                        ->join('origins', 'origins.id', '=', 'clients.origin_id')
                        ->join('camps', 'camps.id', '=', 'clients.camp_id');
                $disbursements = $this->processSortRequest($request,  $this->getSelectItems($disbursements))->paginate($request->perPage);
                $itemDistributions = $this->mapItemDisbursements($disbursements);

                return response()->json([
                    'authRole' => AuthUtility::getRoleName(),
                    'authPermission' => AuthUtility::getPermissionName(),
                    'itemDistributions' => $itemDistributions,
                    'pagination' =>  PaginateUtility::mapPagination($disbursements),
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 400); // 400 being the HTTP code for an invalid request.
        }
    }

    public function searchItemDistributionPaginated(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'sortField' => 'required',
                'sortType' => 'required|max:5',
                'perPage' => 'required',
                'page' => 'required',
                'searchTerm' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => ValidatorUtility::processValidatorErrorMessages($validator),
                ], 422); // 400 being the HTTP code for an invalid request.
            } else {
                $disbursements = $this->processSortRequest($request,  $this->findItemDistributionsBySearchTerm($request->searchTerm))->paginate($request->perPage);
                $itemDistributions = $this->mapItemDisbursements($disbursements);
                return response()->json([
                    'authRole' => AuthUtility::getRoleName(),
                    'authPermission' => AuthUtility::getPermissionName(),
                    'itemDistributions' => $itemDistributions,
                    'pagination' =>  PaginateUtility::mapPagination($disbursements),
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 400); // 400 being the HTTP code for an invalid request.
        }
    }

    private function findItemDistributionsBySearchTerm($searchTerm) {
        $dataType = config('database.default') == 'pgsql' ? 'INTEGER' : 'UNSIGNED';
        $dbPrefix = DB::getTablePrefix();

        $disbursements = ItemsDisbursement::join('items_disbursement_items', 'items_disbursement_items.distribution_id', '=', 'items_disbursements.id')
            ->join('clients', 'clients.id', '=', 'items_disbursement_items.client_id')
            ->join('origins', 'origins.id', '=', 'clients.origin_id')
            ->join('camps', 'camps.id', '=', 'clients.camp_id');
        $disbursements = $this->getSelectItems($disbursements);
        $disbursements = $disbursements->where(DB::raw('lower('.$dbPrefix.'items_disbursements.comments)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'items_disbursements.disbursements_by)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'items_disbursements.created_by)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'items_disbursements.auth_status)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'clients.full_name)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'origins.origin_name)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' )
            ->orWhere(DB::raw('lower('.$dbPrefix.'camps.camp_name)'), 'LIKE', '%'. Str::lower($searchTerm) . '%' );
        return $disbursements;
    }

    public function mapItemDisbursements($disbursements = array()) {
        $itemDistributions = array();
        foreach ($disbursements as $key => $disbursement) {
            $itemDistributions[] = [
                'id'=> $disbursement->id,
                'disbursements_date'=> $disbursement->disbursements_date,
                'disbursements_by'=> $disbursement->disbursements_by,
                'comments'=> $disbursement->comments,
                'camp_id'=> $disbursement->camp_id,
                'created_by'=> $disbursement->created_by,
                'updated_by'=> $disbursement->updated_by,
                'auth_status'=> $disbursement->auth_status,
                'auth_by'=> $disbursement->auth_by,
                'auth_date'=> $disbursement->auth_date,
                'created_at'=> $disbursement->created_at,
                'updated_at'=> $disbursement->updated_at,
                'full_name'=> $disbursement->full_name,
                'client_number'=> $disbursement->client_number,
                'hai_reg_number'=> $disbursement->hai_reg_number,
                'client_id'=> $disbursement->client_id,
                'camp_name'=> $disbursement->camp_name,
                'origin_name'=> $disbursement->origin_name,
                'quantity' => $disbursement->quantity,
                'items' => [
                    $this->getItems($disbursement->item_id)->item_name
                ]
            ];
        }
        return $itemDistributions;
    }

    private function getItems($item_id) {
        return ItemsInventory::find($item_id);
    }
    private function getSelectItems($inventories) {
        return $inventories->select(
            'items_disbursements.*',
            'items_disbursement_items.item_id',
            'items_disbursement_items.quantity',
            'clients.full_name',
            'clients.client_number',
            'clients.hai_reg_number',
            'clients.id AS client_id',
            'camps.camp_name',
            'origins.origin_name'
        );
    }

    public function showImport() {
        //
        return view('inventory.disbursement.import');
    }
    public function showImportErrors()
    {

        if (Auth::user()->hasPermission('edit')) {
            $clients=DumpItemsDisbursement::all();
            return view('inventory.disbursement.importerrors',compact('clients'));
        }
        else
        {
            return redirect('home');
        }
    }
    public function downloadImportErrors()
    { ob_clean();
        $clients = DumpItemsDisbursement::all();
        \Excel::create("list_of_clients_failed_import", function($excel) use($clients)  {
            $excel->sheet('sheet', function($sheet) use($clients){
                $sheet->loadView('inventory.disbursement.excel',compact('clients'));
            });
        })->download('xlsx');
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
            $validator = Validator::make($request->all(), [
                'disbursements_date' => 'required|before:tomorrow',
                'camp_id' => 'required',
                'category_id' => 'required',
                'item_id' => 'required',
                'import_type' => 'required',
                'items_distribution_file' => 'required',
            ]);
            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator)->withInput();

            }

            $extension= strtolower($request->file('items_distribution_file')->getClientOriginalExtension());
            if($extension !="xlsx" && $extension !="xls")
            {
                return redirect()->back()->with('message', 'Invalid file type! allowed only xls, xlsx')->withInput();
            }

         if (!isItemOutOfStockNoQ($request->item_id)) {


             \DB::table('dump_items_disbursements')->truncate();

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

                              if($row->names != "" && $row->sex !="" && is_numeric($row->age) && $row->marital_status !="" &&
                                 is_numeric($row->m) &&  is_numeric($row->f) &&  is_numeric($row->t) &&
								 $row->origin != "" && $row->date_of_arrival !="" && $row->vul_1 !="" && is_numeric($row->quantity) )
                              {
                                $sex ="";
								if(strtolower($row->sex) =="k" || strtolower($row->sex) =="mk" || strtolower($row->sex) =="f")
								{
									$sex = "Female";
								}
								else
								{
									$sex = "Male";
								}
								$full_name=ucwords(strtolower(preg_replace('/\s+/S', " ",$row->names)));
								$age=intval($row->age);
								$marital_status=ucwords(strtolower(preg_replace('/\s+/S', "",$row->marital_status)));
								$date_arrival=null;
								if($row->date_of_arrival != "") {
									$date_arrival = date("Y-m-d", strtotime(preg_replace('/\s+/S', "",$row->date_of_arrival)));
								}

								$origin="";
								$origin_name=ucwords(strtolower(preg_replace('/\s+/S', "", $row->origin)));
								if($origin_name =="Nyarugusu" || $origin_name =="Nyrugusu" || $origin_name =="Nyarugusi"|| $origin_name =="Nyaruguu"){

									$origin_name="Nyarugusu";
								}

								$females_total=intval($row->f);
								$males_total=intval($row->m);
								$household_number=$females_total+$males_total;

								$origin_id="";
								if($row->origin !="") {
									if (count(Origin::where('origin_name', '=', $origin_name)->get()) > 0) {
										$origin = Origin::where('origin_name', '=', $origin_name)->get()->first();
										$origin_id=$origin->id;
									}
								}
                                 $quantity = intval($row->quantity);

                                 if(count(Client::where('full_name','=',$full_name)
											->where('age','=',$age)
											->where('sex','=',$sex)
											->where('marital_status','=',$marital_status)
											->where('date_arrival','=',$date_arrival)
											->where('household_number','=',$household_number)
											->where('females_total','=',$females_total)
											->where('males_total','=',$males_total)
											->where('origin_id','=',$origin_id)
											->where('camp_id','=',$request->camp_id)
											->get()) > 0)
                                 {

                                     $client = Client::where('full_name','=',$full_name)
											->where('age','=',$age)
											->where('sex','=',$sex)
											->where('marital_status','=',$marital_status)
											->where('date_arrival','=',$date_arrival)
											->where('household_number','=',$household_number)
											->where('females_total','=',$females_total)
											->where('males_total','=',$males_total)
											->where('origin_id','=',$origin_id)
											->where('camp_id','=',$request->camp_id)
											->get()->first();


                                     if ($client != null && count($client) > 0) {

                                         if (!isInDistributionLimit($request->item_id, $client->id,$distribution->disbursements_date)) {

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
											 else
											 {
												$client =new DumpItemsDisbursement;
												$client->names=$row->names;
												$client->sex=$row->sex;
												$client->age = $row->age;
												$client->marital_status=$row->marital_status;
												$client->m=$row->m;
												$client->f=$row->f;
												$client->t=$row->t;
												$client->origin=$row->origin;
												$client->date_of_arrival=$row->date_of_arrival;
												$client->vul_1=$row->vul_1;
												$client->quantity=intval($row->quantity);
												$client->error_descriptions="Item is out of stock ";
												$client->save();
												$this->import_errors="Missing filed is marked with red";
											 }


                                         }
										 else
										 {
											   $client =new DumpItemsDisbursement;
												$client->names=$row->names;
												$client->sex=$row->sex;
												$client->age = $row->age;
												$client->marital_status=$row->marital_status;
												$client->m=$row->m;
												$client->f=$row->f;
												$client->t=$row->t;
												$client->origin=$row->origin;
												$client->date_of_arrival=$row->date_of_arrival;
												$client->vul_1=$row->vul_1;
												$client->quantity=intval($row->quantity);
												$client->error_descriptions="Client is not eligible to receive the item, is in distribution limit ";
												$client->save();
												$this->import_errors="Missing filed is marked with red";
										 }
                                     }

                                 }
								 else
								 {
									 $client =new DumpItemsDisbursement;
									$client->names=$row->names;
									$client->sex=$row->sex;
									$client->age = $row->age;
									$client->marital_status=$row->marital_status;
									$client->m=$row->m;
									$client->f=$row->f;
									$client->t=$row->t;
									$client->origin=$row->origin;
									$client->date_of_arrival=$row->date_of_arrival;
									$client->vul_1=$row->vul_1;
									$client->quantity=intval($row->quantity);
									$client->error_descriptions="Client is not registered";
									$client->save();
									$this->import_errors="Missing filed is marked with red";
								 }

                             }
							 else
							 {
								 $filed_error="";

								if($row->names == "" ){
									$filed_error .="Names is  Missing-";
								}
								if( $row->sex == "" ){
									$filed_error .="Sex is Missing-";
								}
								if(  !is_numeric($row->age)){
									$filed_error .="Age is Missing-";
								}
								if( $row->marital_status == "" ){
									$filed_error .="Marital Status is Missing-";
								}
								if( !is_numeric($row->m) ){
									$filed_error .="Number of males is Missing-";
								}
								if( !is_numeric($row->f)){
									$filed_error .="Number of females is Missing-";
								}
								if( !is_numeric($row->t) ){
									$filed_error .="HouseHold Number is Missing-";
								}
								if( $row->origin ==""){
									$filed_error .="Origin is Missing-";
								}
								if( $row->date_of_arrival == "" ){
									$filed_error .="date of arrival is Missing-";
								}
								if( !is_numeric($row->quantity)){
									$filed_error .="Quantity is Missing-";
								}

								if( $row->vul_1 == "" ){
									$filed_error .="Vulnerability code(s) is Missing-";
								}
								$filed_error=substr($filed_error,0,strlen($filed_error)-1);

								$client =new DumpItemsDisbursement;
								$client->names=$row->names;
								$client->sex=$row->sex;
								$client->age = $row->age;
								$client->marital_status=$row->marital_status;
								$client->m=$row->m;
								$client->f=$row->f;
								$client->t=$row->t;
								$client->origin=$row->origin;
								$client->date_of_arrival=$row->date_of_arrival;
								$client->vul_1=$row->vul_1;
								$client->quantity=intval($row->quantity);
								$client->error_descriptions=$filed_error;
								$client->save();
                                $this->import_errors="Missing filed is marked with red";
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
                             if (count(Client::where('hai_reg_number', '=', $row->hai_reg_number)->where('camp_id', '=', $request->camp_id)->get()) > 0 && is_numeric($row->quantity) && intval($row->quantity) >0) {


                                 $client = Client::where('hai_reg_number', '=', $row->hai_reg_number)->get()->first();

                                 if (!isInDistributionLimit($request->item_id, $client->id,$distribution->disbursements_date)) {

                                     if (!isItemOutOfStock($request->item_id,intval($row->quantity))) {

                                         if (!count(ItemsDisbursementItems::where('item_id', '=', $request->item_id)
                                                 ->where('distribution_id', '=', $distribution->id)
                                                 ->where('client_id', '=', $client->id)
                                                 ->where('quantity', '=', intval($row->quantity))->get()) > 0
                                         ) {
                                             $dist_items = new ItemsDisbursementItems;
                                             $dist_items->client_id = $client->id;
                                             $dist_items->item_id = $request->item_id;
                                             $dist_items->quantity = intval($row->quantity);
                                             $dist_items->distribution_id = $distribution->id;
                                             $dist_items->distribution_date = $distribution->disbursements_date;
                                             $dist_items->save();
                                             if (!isItemOutOfStock($request->item_id,intval($row->quantity))) {
                                                 deductItems($request->item_id, intval($row->quantity));
                                             }
                                         }
                                     }
									 else
									 {

                                         $clientdt=Client::where('hai_reg_number', '=', $row->hai_reg_number)->get()->first();
                                         $client =new DumpItemsDisbursement;
                                         $client->names=$row->names;
                                         $client->sex=$row->sex;
                                         $client->age = $row->age;
                                         $client->marital_status=$clientdt->marital_status;
                                         $client->m=$clientdt->males_total;
                                         $client->f=$clientdt->females_total;
                                         $client->t=$clientdt->females_total + $clientdt->males_total;
                                         if (is_object($clientdt->fromOrigin) && $clientdt->fromOrigin != null) {
                                             $client->origin = $clientdt->fromOrigin->origin_name;
                                         }
                                         $client->date_of_arrival=$clientdt->date_of_arrival;
                                         $vul="";
                                         if (count(ClientVulnerabilityCode::where('client_id','=',$clientdt->id)->get()) >0)
                                         {
                                             $vlc=ClientVulnerabilityCode::where('client_id','=',$clientdt->id)->get()->first();
                                             if (is_object($vlc->code))
                                             {
                                                 $vul= $vlc->code->code;
                                             }
                                         }
                                         $client->vul_1= $vul;
                                         $client->quantity=intval($row->quantity);
                                         $client->date_of_arrival=$clientdt->date_arrival;
                                         $client->error_descriptions="Item is out of stock";
                                         $client->save();
                                         $this->import_errors="Missing filed is marked with red";
									 }


                                 }
								 else{
                                     $clientdt=Client::where('hai_reg_number', '=', $row->hai_reg_number)->get()->first();
                                     $client =new DumpItemsDisbursement;
                                     $client->names=$row->names;
                                     $client->sex=$row->sex;
                                     $client->age = $row->age;
                                     $client->marital_status=$clientdt->marital_status;
                                     $client->m=$clientdt->males_total;
                                     $client->f=$clientdt->females_total;
                                     $client->t=$clientdt->females_total + $clientdt->males_total;
                                     if (is_object($clientdt->fromOrigin) && $clientdt->fromOrigin != null) {
                                         $client->origin = $clientdt->fromOrigin->origin_name;
                                     }
                                     $client->date_of_arrival=$clientdt->date_of_arrival;
                                     $vul="";
                                     if (count(ClientVulnerabilityCode::where('client_id','=',$clientdt->id)->get()) >0)
                                     {
                                         $vlc=ClientVulnerabilityCode::where('client_id','=',$clientdt->id)->get()->first();
                                         if (is_object($vlc->code))
                                         {
                                             $vul= $vlc->code->code;
                                         }
                                     }
                                     $client->vul_1= $vul;
                                     $client->quantity=intval($row->quantity);
                                     $client->date_of_arrival=$clientdt->date_arrival;
									$client->error_descriptions="Client is not eligible to receive item, is in distribution limit";
									$client->save();
									$this->import_errors="Missing filed is marked with red";
								 }

                             }
							 else
							 {
                                 $filed_error="";
                                 if($row->quantity ==""){
                                     $filed_error .="quantity is Missing-";
                                 }
                                 if( intval($row->quantity) < 0){
                                     $filed_error .="quantity can not be less than zero";
                                 }
                                 if (!count(Client::where('hai_reg_number', '=', $row->hai_reg_number)->where('camp_id', '=', $request->camp_id)->get()) > 0)
                                 {
                                     $camp =Camp::find($request->camp_id);
                                     $filed_error .="Client not found in registration list for $camp->camp_name camp";
                                 }

							     $clientdt=Client::where('hai_reg_number', '=', $row->hai_reg_number)->get()->first();
                                 $client =new DumpItemsDisbursement;
                                 $client->names=$row->names;
                                 $client->sex=$row->sex;
                                 $client->age = $row->age;
                                 $client->marital_status=$clientdt->marital_status;
                                 $client->m=$clientdt->males_total;
                                 $client->f=$clientdt->females_total;
                                 $client->t=$clientdt->females_total + $clientdt->males_total;
                                 if (is_object($clientdt->fromOrigin) && $clientdt->fromOrigin != null) {
                                     $client->origin = $clientdt->fromOrigin->origin_name;
                                 }
                                 $client->date_of_arrival=$clientdt->date_of_arrival;
                                 $vul="";
                                 if (count(ClientVulnerabilityCode::where('client_id','=',$clientdt->id)->get()) >0)
                                 {
                                     $vlc=ClientVulnerabilityCode::where('client_id','=',$clientdt->id)->get()->first();
                                     if (is_object($vlc->code))
                                     {
                                         $vul= $vlc->code->code;
                                     }
                                 }
                                 $client->vul_1= $vul;
                                 $client->quantity=intval($row->quantity);
								$client->error_descriptions=$filed_error;
								$client->save();
                                $this->import_errors="Missing filed is marked with red";
							 }
                         });
                     }


             });

                 File::delete($orfile);

                 //Audit trail
                 if ($this->import_errors =="") {
                     AuditRegister("ItemsDisbursementController", "Imported Item Distribution ", $orfile);

                     return redirect('items/distributions');
                 }
                 else
                 {
                     return redirect('import/items/distributions/error');
                 }

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
                $client = Client::where('hai_reg_number','=',$request->hai_reg_number)->where('camp_id', '=', $request->camp_id)->first();
                if($client != null && $client->id != null) {
                    if (!isInDistributionLimit($request->item_id, $client->id, date('Y-m-d', strtotime($request->disbursements_date)))) {
                        if (!isItemOutOfStock($request->item_id, intval($request->quantity))) {
                            $distribution = new ItemsDisbursement;
                            $distribution->disbursements_date = date('Y-m-d', strtotime($request->disbursements_date));
                            $distribution->camp_id = $request->camp_id;
                            $distribution->comments = $request->comments;
                            $distribution->disbursements_by = ucwords(strtolower($request->disbursements_by));
                            $distribution->save();



                            $dist_items = new ItemsDisbursementItems;
                            $dist_items->item_id = $request->item_id;
                            $dist_items->client_id = $client->id;
                            $dist_items->quantity = intval($request->quantity);
                            $dist_items->distribution_id = $distribution->id;
                            $dist_items->distribution_date = $distribution->disbursements_date;
                            $dist_items->save();

                            deductItems($request->item_id, intval($request->quantity));
                            AuditRegister("ItemsDisbursementController","Imported Item Distribution ",$dist_items);

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
                    } else {
                        return Response::json(array(
                            'success' => false,
                            'errors' => 1,
                            'message' => "Client is not eligible for receiving the item "
                        ), 400); // 400 being the HTTP code for an invalid request.
                    }
                } else {
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


                    if (!isInDistributionLimit($request->item_id, $client->id,date('Y-m-d', strtotime($request->disbursements_date)))) {

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
