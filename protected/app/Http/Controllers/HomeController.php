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
        return array(
            'options' => [
                'chart' => [
                    'width' => 400,
                    'type' => 'pie',
                ],
                'labels' => $ageGroupNames,
            ],
            'series' => $ageGroupCount
        );
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
        //dd($cases);
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
        return array(
            'series' => [
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
            ],
            'options' => [
                'chart' => [
                    'height' => 350,
                    'type' => 'line',
                    'stacked' => false
                ],
                'dataLabels' => [
                    'enabled' => false,
                ],
                'stroke' => [
                    'width' => [1, 1],
                    'curve' => 'smooth'
                ],
                'title' => [
                    'text' => 'Number of Registered Clients from '. Carbon::parse($dateFrom)->isoFormat('MMMM Do, YYYY') . ' to ' .Carbon::parse($dateTo)->isoFormat('MMMM Do, YYYY'),
                    'align' => 'left',
                    'offsetX' => 50
                ],
                'xaxis' => [
                    'categories' => $ageGroupList
                ],
                'yaxis' => [
                    'axisTicks' => [
                        'show' => true,
                    ],
                    'axisBorder' => [
                        'show' => true,
                        'color' => '#008FFB'
                    ],
                    'labels' => [
                        'style' => [
                            'colors' => '#008FFB'
                        ]
                    ],
                    'title' => [
                        'text' => 'Number of Registered Clients per Age Group',
                        'style' => [
                            'colors' => '#008FFB'
                        ]
                    ]
                ]
            ],
        );
    }
    public function getItemsDistributionsMonthlyCountByYear($year) {
        $maleGender = 'Male';
        $femaleGender = 'Female';

        $ageGroups = CommonConstant::AGE_GROUPS;
        $dataSeries = [];
        $caseMonths = array();
        foreach ($ageGroups  as $key => $ageGroup) {
            $caseMaleCount = array();
            $caseFemaleCount = array();       //
            foreach(CommonConstant::MONTHS as $num => $monthName) {
                $caseMaleCount[] = $this->getItemsDistributionsMonthlyCount($key, $maleGender, $num, $year)->count();
                $caseFemaleCount[] = $this->getItemsDistributionsMonthlyCount($key, $femaleGender, $num, $year)->count();
            }
            $dataSeries[] = [
                'name' => $ageGroup,
                'data' => $caseMaleCount,
                'name' => $ageGroup,
                'data' => $caseFemaleCount
            ];
        }

        foreach (CommonConstant::MONTHS as $num => $monthName) {           //
            $caseMonths[] = $monthName;
        }

        return array(
            'series' => $dataSeries,
            'options' => [
                'chart' => [
                    'height' => 350,
                    'type' => 'bar',
                    'stacked' => true,
                    'toolbar' => [
                        'show' => true
                    ],
                    'zoom' => [
                        'enabled' => true,
                    ],
                ],
                'dataLabels' => [
                    'enabled' => false,
                ],
                'title' => [
                    'text' => 'Monthly Cash Distribution for year ' . $year,
                    'align' => 'left',
                    'offsetX' => 50
                ],
                'plotOptions' => [
                    'bar' => [
                      'horizontal' => false,
                    ],
                ],
                'xaxis' => [
                    'categories' => $caseMonths
                ],
                'yaxis' => [
                    'axisTicks' => [
                        'show' => true,
                    ],
                    'axisBorder' => [
                        'show' => true,
                        'color' => '#008FFB'
                    ],
                    'labels' => [
                        'style' => [
                            'colors' => '#008FFB'
                        ]
                    ],
                    'title' => [
                        'text' => 'Number of Monthly Cash Distribution for year '. $year,
                        'style' => [
                            'colors' => '#008FFB'
                        ]
                    ]
                ]
            ],
        );
    }

    public function getItemsDistributionsMonthlyCount($ageGroup, $gender, $month, $year) {
        return DB::table('items_disbursement_items')
                ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                ->where('clients.age_score', '=', $ageGroup)
                ->where('clients.sex', '=', $gender)
                ->whereMonth('distribution_date', '=', $month)
                ->whereYear('distribution_date', '=', $year);
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
