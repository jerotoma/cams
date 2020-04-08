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
use App\Helpers\ChartUtility;
use App\Helpers\CommonConstant;
use DB;

class HomeController extends Controller {
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
                    'monthlyCashProvisions' => $this->getMonthlyCashProvisionCountByYear(Carbon::now()->year),
                    'monthlyItemDistributions' => $this->getMonthlyItemsDistributionCountByYear(Carbon::now()->year),
                    'cases' => $this->loadCasesCountByStatus(),
                    'casesPerStatus' => $this->getMonthlyCasesCountByYear(2017),
                    'clientRegistration' => $this->loadClientRegistrationCountByDateRange('2016-07-01', Carbon::now()->toDateTimeString()),
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
        $clientCountByCodes = array();
        $clientByCodeNames = array();
        foreach ($psnCodes as $key => $code) {
            $clientCountByCodes[] = ClientVulnerabilityCode::where('code_id','=', $code->id)->count();
            $clientByCodeNames[] = $code->code;
        }

        return array(
            'options' => [
                'chart' => [
                    'width' => 400,
                    'type' => 'pie',
                ],
                'labels' => $clientByCodeNames,

            ],
            'series' => $clientCountByCodes
        );
    }

    public function getClientRegistrationByParams($ageGroup, $gender, $dateFrom, $dateTo) {
        return Client::where('age_score', '=', $ageGroup)
                    ->where('sex', '=', $gender)
                    ->whereBetween('date_arrival', array($dateFrom,  $dateTo));

    }

    public function getClientRegistrationCountByAgeGruop() {
        $ageGroups = CommonConstant::AGE_GROUPS;
        $ageGroupCount = array();
        $ageGroupNames = array();
        foreach ($ageGroups  as $key => $ageGroup) {
            $ageGroupNames[] = $ageGroup;
            $ageGroupCount[] = Client::where('age_score', '=', $key)->count();
        }
        return ChartUtility::getBasicPieChartData($ageGroupCount, $ageGroupNames);
    }
    public function getCasesCountByStatus($status) {
        return ClientCase::where('status','=', $status)->count();
    }

    public function getMonthlyCasesCountByStatus($status, $year) {
        $caseCount = array();
        $caseMonth = array();

        foreach(CommonConstant::MONTHS as $num => $monthName) {
            $caseMonth[] = $monthName;
            $caseCount[] = ClientCase::whereMonth('open_date', '=', $num)
                                ->whereYear('open_date', '=', $year)
                                ->where('status', '=', $status)->count();
        }
       return [
           'caseMonth' => $caseMonth,
           'caseCount' => $caseCount
       ];
    }

    public function getMonthlyCasesCountByYear($year) {
        $cases = array();
        foreach (CommonConstant::CASE_STATUSES as $key => $caseStatus) {
            $cases[$key]  = $this->getMonthlyCasesCountByStatus($caseStatus, $year);
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

    private function loadClientRegistrationCountByDateRange($dateFrom, $dateTo) {
        $maleGender = 'Male';
        $femaleGender = 'Female';

        $ageGroups = CommonConstant::AGE_GROUPS;
        $maleClientCount = array();
        $femaleClientCount = array();
        $ageGroupList = array();
        foreach ($ageGroups  as $key => $ageGroup) {
            $maleClientCount[] = $this->getClientRegistrationByParams($key, $maleGender, $dateFrom, $dateTo)->count();
            $femaleClientCount[] = $this->getClientRegistrationByParams($key, $femaleGender, $dateFrom, $dateTo)->count();
            $ageGroupList[] = $ageGroup;
        }

        $dataSeries = [
            [
                'name' => 'Male Client Registered ',
                'type' => 'column',
                'data' => $maleClientCount
            ],
            [
                'name' => 'Female Client Registered ',
                'type' => 'column',
                'data' => $femaleClientCount
            ]
        ];
        return ChartUtility::getBasicColumn($dataSeries, $ageGroupList, $dateFrom, $dateTo);
    }

    public function getMonthlyItemsDistributionCountByYear($year) {
        $maleGender = 'Male';
        $femaleGender = 'Female';

        $ageGroups = CommonConstant::AGE_GROUPS;
        $dataSeries = array();
        $dataCategories = array();
        foreach ($ageGroups  as $key => $ageGroup) {
            $caseMaleCount = array();
            $caseFemaleCount = array();       //
            foreach(CommonConstant::MONTHS as $num => $monthName) {
                $caseMaleCount[] = $this->getItemsDistributionsMonthlyCount($key, $maleGender, $num, $year)->count();
                $caseFemaleCount[] = $this->getItemsDistributionsMonthlyCount($key, $femaleGender, $num, $year)->count();
            }
            $dataSeries[] = [
                'name' => $maleGender. ' (' .$ageGroup . ')',
                'data' => $caseMaleCount,
            ];
            $dataSeries[] = [
                'name' => $femaleGender. ' (' .$ageGroup . ')',
                'data' => $caseFemaleCount,
            ];
        }
        foreach (CommonConstant::MONTHS as $num => $monthName) {           //
            $dataCategories[] = $monthName;
        }

       return ChartUtility::getStackedColumn($dataSeries, $dataCategories, 'Monthly Item Distribution for year '. $year);
    }


    public function getMonthlyCashProvisionCountByYear($year) {
        $maleGender = 'Male';
        $femaleGender = 'Female';

        $ageGroups = CommonConstant::AGE_GROUPS;
        $dataSeries = array();
        $dataCategories = array();
        foreach ($ageGroups  as $key => $ageGroup) {
            $caseMaleCount = array();
            $caseFemaleCount = array();       //
            foreach(CommonConstant::MONTHS as $num => $monthName) {
                $caseMaleCount[] = $this->getCashProvisionMonthlyCount($key, $maleGender, $num, $year)->count();
                $caseFemaleCount[] = $this->getCashProvisionMonthlyCount($key, $femaleGender, $num, $year)->count();
            }
            $dataSeries[] = [
                'name' => $maleGender. ' (' .$ageGroup . ')',
                'data' => $caseMaleCount,
            ];
            $dataSeries[] = [
                'name' => $femaleGender. ' (' .$ageGroup . ')',
                'data' => $caseFemaleCount,
            ];
        }
        foreach (CommonConstant::MONTHS as $num => $monthName) {           //
            $dataCategories[] = $monthName;
        }

       return ChartUtility::getStackedColumn($dataSeries, $dataCategories, 'Monthly Cash Provision for year '. $year);
    }

    public function getItemsDistributionsMonthlyCount($ageGroup, $gender, $month, $year) {
        return DB::table('items_disbursement_items')
                ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                ->where('clients.age_score', '=', $ageGroup)
                ->where('clients.sex', '=', $gender)
                ->whereMonth('distribution_date', '=', $month)
                ->whereYear('distribution_date', '=', $year);
    }

    public function getCashProvisionMonthlyCount($ageGroup, $gender, $month, $year) {
        return DB::table('cash_provision_clients')
                    ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                    ->where('clients.age_score', '=', $ageGroup)
                    ->where('clients.sex', '=', $gender)
                    ->whereMonth('provision_date', '=', $month)
                    ->whereYear('provision_date', '=', $year);

    }
}
