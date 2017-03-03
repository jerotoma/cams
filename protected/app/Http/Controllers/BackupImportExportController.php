<?php

namespace App\Http\Controllers;

use App\Camp;
use App\Client;
use App\Country;
use App\District;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class BackupImportExportController extends Controller
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
    }
    public function showExport()
    {
        //
        return view('backups.exports.index');
    }
    public function postExport(Request $request)
    {
        //
        $this->validate($request, [
            'module' => 'required',
        ]);

        if ($request->module == 1) {
            $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $xml .= "<ApplicationData>";
            $xml .= "<Countries>";
            foreach (Country::all() as $country)
            {
                $xml .= "<Country>";
                $xml .= "<country_name><![CDATA[" . $country->country_name . "]]></country_name>";
                $xml .= "<country_code><![CDATA[" . $country->country_code . "]]></country_code>";
                $xml .= "<auth_status><![CDATA[" . $country->auth_status . "]]></auth_status>";
                $xml .= "<created_by><![CDATA[" . $country->created_by . "]]></created_by>";
                $xml .= "<updated_by><![CDATA[" . $country->updated_by . "]]></updated_by>";
                $xml .= "<auth_by><![CDATA[" . $country->auth_by . "]]></auth_by>";
                $xml .= "</Country>";
                $xml .= "<Regions>";
                foreach (Region::where('country_id','=',$country->id)->get() as $region)
                {
                    $xml .= "<Region>";
                    $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                    $xml .= "<auth_status><![CDATA[" . $region->auth_status . "]]></auth_status>";
                    $xml .= "<created_by><![CDATA[" . $region->created_by . "]]></created_by>";
                    $xml .= "<updated_by><![CDATA[" . $region->updated_by . "]]></updated_by>";
                    $xml .= "<auth_by><![CDATA[" . $region->auth_by . "]]></auth_by>";
                    $xml .= "<Districts>";
                    foreach (District::where('region_id','=',$region->id)->get() as $district)
                    {
                        $xml .= "<District>";
                        $xml .= "<district_name><![CDATA[" . $district->district_name . "]]></district_name>";
                        $xml .= "<auth_status><![CDATA[" . $district->auth_status . "]]></auth_status>";
                        $xml .= "<created_by><![CDATA[" . $district->created_by . "]]></created_by>";
                        $xml .= "<updated_by><![CDATA[" . $district->updated_by . "]]></updated_by>";
                        $xml .= "<auth_by><![CDATA[" . $district->auth_by . "]]></auth_by>";
                        $xml .= "<Camps>";
                        foreach (Camp::where('district_id','=',$district->id)->get() as $camp)
                        {
                            $xml .= "<Camp>";
                            $xml .= "<reg_no><![CDATA[" . $camp->reg_no . "]]></reg_no>";
                            $xml .= "<camp_name><![CDATA[" . $camp->camp_name . "]]></camp_name>";
                            $xml .= "<description><![CDATA[" . $camp->description . "]]></description>";
                            $xml .= "<address><![CDATA[" . $camp->address . "]]></address>";
                            $xml .= "<tel><![CDATA[" . $camp->tel . "]]></tel>";
                            $xml .= "<status><![CDATA[" . $camp->status . "]]></status>";
                            $xml .= "<auth_status><![CDATA[" . $camp->auth_status . "]]></auth_status>";
                            $xml .= "<created_by><![CDATA[" . $camp->created_by . "]]></created_by>";
                            $xml .= "<updated_by><![CDATA[" . $camp->updated_by . "]]></updated_by>";
                            $xml .= "<auth_by><![CDATA[" . $camp->auth_status . "]]></auth_by>";
                            $xml .= "<Clients>";
                            foreach (Client::where('camp_id','=',$camp->id)->get() as $client)
                            {
                                $xml .= "<Client>";
                                $xml .= "<hai_reg_number><![CDATA[" . $client->hai_reg_number . "]]></hai_reg_number>";
                                $xml .= "<client_number><![CDATA[" . $client->client_number . "]]></client_number>";
                                $xml .= "<full_name><![CDATA[" . $client->full_name . "]]></full_name>";
                                $xml .= "<sex><![CDATA[" . $client->sex . "]]></sex>";
                                $xml .= "<birth_date><![CDATA[" . $client->birth_date . "]]></birth_date>";
                                $xml .= "<age><![CDATA[" . $client->age . "]]></age>";
                                $xml .= "<marital_status><![CDATA[" . $client->marital_status . "]]></marital_status>";
                                $xml .= "<spouse_name><![CDATA[" . $client->spouse_name . "]]></spouse_name>";
                                $xml .= "<care_giver><![CDATA[" . $client->care_giver . "]]></care_giver>";
                                $xml .= "<child_care_giver><![CDATA[" . $client->child_care_giver . "]]></child_care_giver>";
                                $xml .= "<date_arrival><![CDATA[" . $client->date_arrival . "]]></date_arrival>";
                                $xml .= "<present_address><![CDATA[" . $client->present_address . "]]></present_address>";
                                $xml .= "<females_total><![CDATA[" . $client->females_total . "]]></females_total>";
                                $xml .= "<males_total><![CDATA[" . $client->males_total . "]]></males_total>";
                                $xml .= "<household_number><![CDATA[" . $client->household_number . "]]></household_number>";
                                $xml .= "<ration_card_number><![CDATA[" . $client->ration_card_number . "]]></ration_card_number>";
                                $xml .= "<assistance_received><![CDATA[" . $client->assistance_received . "]]></assistance_received>";
                                $xml .= "<problem_specification><![CDATA[" . $client->problem_specification . "]]></problem_specification>";
                                $xml .= "<status><![CDATA[" . $client->status . "]]></status>";
                                $xml .= "<share_info><![CDATA[" . $client->share_info . "]]></share_info>";
                                $xml .= "<hh_relation><![CDATA[" . $client->hh_relation . "]]></hh_relation>";
                                $xml .= "<auth_status><![CDATA[" . $client->auth_status . "]]></auth_status>";
                                $xml .= "<created_by><![CDATA[" . $client->created_by . "]]></created_by>";
                                $xml .= "<updated_by><![CDATA[" . $client->updated_by . "]]></updated_by>";
                                $xml .= "<auth_by><![CDATA[" . $client->auth_by . "]]></auth_by>";
                                $xml .= "<auth_date><![CDATA[" . $client->auth_date . "]]></auth_date>";
                                $xml .= "<Origin>";
                                if (is_object($client->fromOrigin) && $client->fromOrigin != null)
                                {
                                    $origin = $client->fromOrigin;
                                    $xml .= "<origin_name><![CDATA[" . $origin->origin_name . "]]></origin_name>";
                                    $xml .= "<auth_status><![CDATA[" . $origin->auth_status . "]]></auth_status>";
                                    $xml .= "<created_by><![CDATA[" . $origin->created_by . "]]></created_by>";
                                    $xml .= "<updated_by><![CDATA[" . $origin->updated_by . "]]></updated_by>";
                                    $xml .= "<auth_by><![CDATA[" . $origin->auth_by . "]]></auth_by>";
                                }
                                $xml .= "</Origin>";
                                $xml .= "</Client>";
                            }
                            $xml .= "</Clients>";
                            $xml .= "</Camp>";
                        }
                        $xml .= "</Camps>";
                        $xml .= "</District>";
                    }
                    $xml .= "</Districts>";
                    $xml .= "</Region>";
                }
                $xml .= "<Regions>";
                $xml .= "<Country>";
            }
            $xml .= "<Countries>";
            $xml .= "</ApplicationData>";

            File::put(storage_path() . '/SystemData.xml', $xml);
            return Response::download(storage_path() . '/SystemData.xml');
        }
        if ($request->module == 2)
        {
            $clients = Client::all();
            $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $xml .= "<ApplicationData>";
            $xml .= "<Countries>";
            foreach (Country::all() as $country)
            {
                $xml .= "<Country>";
                $xml .= "<country_name><![CDATA[" . $country->country_name . "]]></country_name>";
                $xml .= "<country_code><![CDATA[" . $country->country_code . "]]></country_code>";
                $xml .= "<auth_status><![CDATA[" . $country->auth_status . "]]></auth_status>";
                $xml .= "<created_by><![CDATA[" . $country->created_by . "]]></created_by>";
                $xml .= "<updated_by><![CDATA[" . $country->updated_by . "]]></updated_by>";
                $xml .= "<auth_by><![CDATA[" . $country->auth_by . "]]></auth_by>";
                $xml .= "</Country>";
                $xml .= "<Regions>";
                foreach (Region::where('country_id','=',$country->id)->get() as $region)
                {
                    $xml .= "<Region>";
                    $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                    $xml .= "<auth_status><![CDATA[" . $region->auth_status . "]]></auth_status>";
                    $xml .= "<created_by><![CDATA[" . $region->created_by . "]]></created_by>";
                    $xml .= "<updated_by><![CDATA[" . $region->updated_by . "]]></updated_by>";
                    $xml .= "<auth_by><![CDATA[" . $region->auth_by . "]]></auth_by>";
                    $xml .= "<Districts>";
                    foreach (District::where('region_id','=',$region->id)->get() as $district)
                    {
                        $xml .= "<District>";
                        $xml .= "<district_name><![CDATA[" . $district->district_name . "]]></district_name>";
                        $xml .= "<auth_status><![CDATA[" . $district->auth_status . "]]></auth_status>";
                        $xml .= "<created_by><![CDATA[" . $district->created_by . "]]></created_by>";
                        $xml .= "<updated_by><![CDATA[" . $district->updated_by . "]]></updated_by>";
                        $xml .= "<auth_by><![CDATA[" . $district->auth_by . "]]></auth_by>";
                        $xml .= "<Camps>";
                        foreach (Camp::where('district_id','=',$district->id)->get() as $camp)
                        {
                            $xml .= "<Camp>";
                            $xml .= "<reg_no><![CDATA[" . $camp->reg_no . "]]></reg_no>";
                            $xml .= "<camp_name><![CDATA[" . $camp->camp_name . "]]></camp_name>";
                            $xml .= "<description><![CDATA[" . $camp->description . "]]></description>";
                            $xml .= "<address><![CDATA[" . $camp->address . "]]></address>";
                            $xml .= "<tel><![CDATA[" . $camp->tel . "]]></tel>";
                            $xml .= "<zone><![CDATA[" . $camp->zone . "]]></zone>";
                            $xml .= "<status><![CDATA[" . $camp->status . "]]></status>";
                            $xml .= "<auth_status><![CDATA[" . $camp->auth_status . "]]></auth_status>";
                            $xml .= "<created_by><![CDATA[" . $camp->created_by . "]]></created_by>";
                            $xml .= "<updated_by><![CDATA[" . $camp->updated_by . "]]></updated_by>";
                            $xml .= "<auth_by><![CDATA[" . $camp->auth_status . "]]></auth_by>";
                            $xml .= "</Camp>";
                        }
                        $xml .= "</Camps>";
                        $xml .= "</District>";
                    }
                    $xml .= "</Districts>";
                    $xml .= "</Region>";
                }
                $xml .= "<Regions>";
                $xml .= "<Country>";
            }
            $xml .= "<Countries>";

            $xml .= "<Clients>";
            foreach ($clients as $client) {
                $xml .= "<Client>";
                $xml .= "<hai_reg_number><![CDATA[" . $client->hai_reg_number . "]]></hai_reg_number>";
                $xml .= "<client_number><![CDATA[" . $client->client_number . "]]></client_number>";
                $xml .= "<full_name><![CDATA[" . $client->full_name . "]]></full_name>";
                $xml .= "<sex><![CDATA[" . $client->sex . "]]></sex>";
                $xml .= "<birth_date><![CDATA[" . $client->birth_date . "]]></birth_date>";
                $xml .= "<age><![CDATA[" . $client->age . "]]></age>";
                $xml .= "<marital_status><![CDATA[" . $client->marital_status . "]]></marital_status>";
                $xml .= "<spouse_name><![CDATA[" . $client->spouse_name . "]]></spouse_name>";
                $xml .= "<care_giver><![CDATA[" . $client->care_giver . "]]></care_giver>";
                $xml .= "<child_care_giver><![CDATA[" . $client->child_care_giver . "]]></child_care_giver>";
                $xml .= "<Origin>";
                if (is_object($client->fromOrigin) && $client->fromOrigin != null) {
                    $origin = $client->fromOrigin;
                    $xml .= "<origin_name><![CDATA[" . $origin->origin_name . "]]></origin_name>";
                    $xml .= "<auth_status><![CDATA[" . $origin->auth_status . "]]></auth_status>";
                    $xml .= "<created_by><![CDATA[" . $origin->created_by . "]]></created_by>";
                    $xml .= "<updated_by><![CDATA[" . $origin->updated_by . "]]></updated_by>";
                    $xml .= "<auth_by><![CDATA[" . $origin->auth_by . "]]></auth_by>";
                }
                $xml .= "</Origin>";
                $xml .= "<Camp>";
                if (is_object($client->camp) && $client->camp != null) {
                    $camp = $client->camp;
                    $xml .= "<reg_no><![CDATA[" . $camp->reg_no . "]]></reg_no>";
                    $xml .= "<camp_name><![CDATA[" . $camp->camp_name . "]]></camp_name>";
                    $xml .= "<description><![CDATA[" . $camp->description . "]]></description>";
                    $xml .= "<address><![CDATA[" . $camp->address . "]]></address>";
                    $xml .= "<tel><![CDATA[" . $camp->tel . "]]></tel>";
                    $xml .= "<zone><![CDATA[" . $camp->zone . "]]></zone>";
                    $xml .= "<status><![CDATA[" . $camp->status . "]]></status>";
                    $xml .= "<auth_status><![CDATA[" . $camp->auth_status . "]]></auth_status>";
                    $xml .= "<created_by><![CDATA[" . $camp->created_by . "]]></created_by>";
                    $xml .= "<updated_by><![CDATA[" . $camp->updated_by . "]]></updated_by>";
                    $xml .= "<auth_by><![CDATA[" . $camp->auth_status . "]]></auth_by>";
                    $xml .= "<Region>";
                    $region = Region::find($camp->region_id);
                    if (count($region) > 0 && $region != null) {
                        $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                    }
                    $xml .= "</Region>";
                    $xml .= "<District>";
                    $district = District::find($camp->district_id);
                    if (count($district) > 0 && $district != null) {
                        $xml .= "<district_name><![CDATA[" . $district->district_name . "]]></district_name>";
                        $xml .= "<Region>";
                        $region = Region::find($district->region_id);
                        if (count($region) > 0 && $region != null) {
                            $xml .= "<region_name><![CDATA[" . $region->region_name . "]]></region_name>";
                        }
                        $xml .= "</Region>";
                    }
                    $xml .= "</District>";

                }
                $xml .= "</Camp>";
                $xml .= "<date_arrival><![CDATA[" . $client->date_arrival . "]]></date_arrival>";
                $xml .= "<present_address><![CDATA[" . $client->present_address . "]]></present_address>";
                $xml .= "<females_total><![CDATA[" . $client->females_total . "]]></females_total>";
                $xml .= "<males_total><![CDATA[" . $client->males_total . "]]></males_total>";
                $xml .= "<household_number><![CDATA[" . $client->household_number . "]]></household_number>";
                $xml .= "<ration_card_number><![CDATA[" . $client->ration_card_number . "]]></ration_card_number>";
                $xml .= "<assistance_received><![CDATA[" . $client->assistance_received . "]]></assistance_received>";
                $xml .= "<problem_specification><![CDATA[" . $client->problem_specification . "]]></problem_specification>";
                $xml .= "<status><![CDATA[" . $client->status . "]]></status>";
                $xml .= "<share_info><![CDATA[" . $client->share_info . "]]></share_info>";
                $xml .= "<hh_relation><![CDATA[" . $client->hh_relation . "]]></hh_relation>";
                $xml .= "<auth_status><![CDATA[" . $client->auth_status . "]]></auth_status>";
                $xml .= "<created_by><![CDATA[" . $client->created_by . "]]></created_by>";
                $xml .= "<updated_by><![CDATA[" . $client->updated_by . "]]></updated_by>";
                $xml .= "<auth_by><![CDATA[" . $client->auth_by . "]]></auth_by>";
                $xml .= "<auth_date><![CDATA[" . $client->auth_date . "]]></auth_date>";
                $xml .= "</Client>";
            }
            $xml .= "</Clients>";
            $xml .= "</ApplicationData>";

            File::put(storage_path() . '/SystemData.xml', $xml);
            return Response::download(storage_path() . '/SystemData.xml');
        }

    }
    //Data export
    public function showImport()
    {
        //
        return view('backups.imports.index');
    }
    public function postImport(Request $request)
    {
        //
        $this->validate($request, [
            'system_data_file' => 'required|mimes:xml',
        ]);

        return redirect('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }
}
