<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Client;
use App\User;
use App\PSNCode;
use App\ClientCase;
use App\ClientVulnerabilityCode;
use App\ItemsDisbursement;


use App\Helpers\AuthUtility;
use App\Helpers\PaginateUtility;
use App\Helpers\ValidatorUtility;
use App\Helpers\CommonConstant;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth');
    }
    //

    public function index()
    {
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('authorizer') || Auth::user()->hasPermission('reports')) {
            return view('site.dashboard', [
                'usersCount' => User::count(),
                'clientCasesCount' => ClientCase::count(),
                'clientsCount' => Client::count(),
            ]);
        } else {
            return redirect('account/profile');
        }
    }

    public function findChartStats(Request $request) {
        try {

            if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('authorizer') || Auth::user()->hasPermission('reports')) {

                return response()->json([
                    'authRole' => AuthUtility::getRoleName(),
                    'authPermission' => AuthUtility::getPermissionName(),
                    'ageGroups' => $this->getClientRegistrationCountByAgeGruop(),
                    'clientNeeds' => $this->getClientVulnerabilityCountByCode(),
                    'monthlyNfisDistributions' => $this->getItemsDistributionCountByYear(Carbon::now()->year),
                    'monthlyCashProvisions' =>  $this->getItemsDistributionsMonthlyCountByYear(Carbon::now()->year),
                    'cases' => $this->loadCasesCountByStatus(),
                    'casesPerStatus' => $this->getMonthlyCasesCountByYear(Carbon::now()->year),
                    'clientRegistration' => $this->loadClientCountByDateRange(Carbon::now()->subYear()->toDateTimeString(), Carbon::now()->toDateTimeString()),
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 400); // 400 being the HTTP code for an invalid request.
        }

    }

    public function getClientVulnerabilityCountByCode() {
        $psnCodes = PSNCode::where('for_reporting','=','Yes')->get();
        $clientByCodes = array();
        foreach ($psnCodes as $key => $code) {
            $clientByCodes[] = [
                'name' => $code->code,
                'count' => ClientVulnerabilityCode::where('code_id','=',$code->id)->count()
            ];
        }
        return $clientByCodes;
    }

    public function getClientRegistrationByParams($ageGroup, $gender, $dateFrom, $dateTo) {
        return Client::where('age_score', '=', $ageGroup)
                    ->where('sex', '=', $gender)
                    ->whereBetween('date_arrival', array($dateFrom,  $dateTo));

    }

    public function getClientRegistrationCountByAgeGruop() {
        $ageGroups = CommonConstant::AGE_GROUPS;
        $ageGroupCount = array();
        foreach ($ageGroups  as $key => $ageGroup) {
            $ageGroupCount[] = [
                'ageGroup' => $ageGroup,
                'count' =>  Client::where('age_score', '=', $key)->count()
            ];
        }
        return $ageGroupCount;
    }
    public function getCasesCountByStatus($status) {
        return ClientCase::where('status','=', $status)->count();
    }

    public function getMonthlyCasesCountByStatus($status, $year) {
        $clientCaseCount = array();
        for($i = 1; $i <= 12; $i++) {
            $clientCaseCount[] = [
                'month' => $i,
                'status' => $status,
                'count' => ClientCase::where('status', '=', $status)
                    ->whereMonth('open_date', '=', $i)
                    ->whereYear('open_date', '=', $year)
                    ->count()
            ];
        }
        return $clientCaseCount;
    }

    public function getMonthlyCasesCountByYear($year) {
        $cases = [];
        foreach (CommonConstant::CASE_STATUSES as $key => $caseStatus) {
            $cases[]  = $this->getMonthlyCasesCountByStatus($caseStatus, $year);
        }
        return $cases;
    }

    public function loadCasesCountByStatus() {
        $cases = [];
        foreach (CommonConstant::CASE_STATUSES as $key => $caseStatus) {
            $cases[]  = [
                'status' => $caseStatus,
                'count' => $this->getCasesCountByStatus($caseStatus)
            ];
        }
        return $cases;
    }

    private function loadClientCountByDateRange($dateFrom, $dateTo) {
        $maleGender = 'Male';
        $femaleGender = 'Female';

        $ageGroups = CommonConstant::AGE_GROUPS;
        $maleClientStats = array();
        foreach ($ageGroups  as $key => $ageGroup) {
            $maleClientStats[] = [
                'ageGroup' => $ageGroup,
                'count' => $this->getClientRegistrationByParams($key, $maleGender, $dateFrom, $dateTo)->count(),
                'dateRange' => [
                    'from' => $dateFrom,
                    'to' => $dateTo
                ],
                'gender' => $maleGender
            ];
        }

        $femaleClientStats = array();
        foreach ($ageGroups as $key => $ageGroup) {
            $femaleClientStats[] = [
                'ageGroup' => $ageGroup,
                'count' => $this->getClientRegistrationByParams($key, $femaleGender, $dateFrom, $dateTo)->count(),
                'dateRange' => [
                    'from' => $dateFrom,
                    'to' => $dateTo
                ],
                'gender' => $femaleGender
            ];
        }
        $clientRegStats = [
            'maleClientStats' => $maleClientStats,
            'femaleClientStats' => $femaleClientStats
        ];
        return $clientRegStats;
    }
    public function getItemsDistributionsMonthlyCountByYear($year) {
        $maleGender = 'Male';
        $femaleGender = 'Female';

        $ageGroups = CommonConstant::AGE_GROUPS;
        $maleClientStats = [
            'gender' => $maleGender,
            'year' => $year,
            'data' => array()
        ];
        foreach ($ageGroups  as $key => $ageGroup) {
           //
           $maleClientStats['data'][$key] = [
                        'ageGroup' => $ageGroup,
                        'mounthes' => array()
                    ];
            for ($i = 1; $i <= 12; $i++) {
                $maleClientStats['data'][$key]['mounthes'][] = [
                    'count' => $this->getClientRegistrationByParams($key, $maleGender, $i, $year)->count(),
                    'month' => $i];
            }
        }

        $femaleClientStats = [
            'gender' => $femaleGender,
            'year' => $year,
            'data' => array()
        ];
        foreach ($ageGroups  as $key => $ageGroup) {           //
           $femaleClientStats['data'][$key] = [
                        'ageGroup' => $ageGroup,
                        'mounthes' => array()
                    ];
            for ($i = 1; $i <= 12; $i++) {
                $femaleClientStats['data'][$key]['mounthes'][] = [
                    'count' => $this->getClientRegistrationByParams($key, $femaleGender, $i, $year)->count(),
                    'month' => $i];
            }
        }
        $clientRegStats = [
            'maleClientStats' => $maleClientStats,
            'femaleClientStats' => $femaleClientStats
        ];
        return $clientRegStats;
    }

    public function getItemsDistributionsMonthlyCount($ageGroup, $gender, $month, $year) {
        return DB::table('items_disbursement_items')
                ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                ->where('clients.age_score', '=', $ageGroup)
                ->where('clients.sex', '=', $gender)
                ->whereMonth('distribution_date', '=', $month)
                ->whereYear('distribution_date', '=', $year)->count();
    }

    public function getItemsDistributionCountByYear($year) {

        $monthData = [];
        for($i=1; $i <= 12; $i++) {
           $monthData[] = [
                'month' => $i,
                'count' => ItemsDisbursement::whereMonth('disbursements_date', '=', $i)->whereYear('disbursements_date', '=', $year)->count()
                ];
        }
        return $monthData;
    }

}
