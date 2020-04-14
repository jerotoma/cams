<?php
if (!function_exists('getHighChatMonthlyCasesCountByStatus')) {
    function getHighChatMonthlyCasesCountByStatus($status,$year) {
        $MonthCount="";
        $monthData="";
        for($i=1; $i<= 12; $i++)
        {
            $MonthCount.=count(\App\ClientCase::where('status','=',$status)->whereMonth('open_date','=', $i)->whereYear('open_date','=',$year)->get()).",";
        }
        $monthData.=substr($MonthCount,0,strlen($MonthCount)-1);
        return $monthData;
    }
}
if (!function_exists('getHighChatCasesCountByStatus')) {
    function getHighChatCasesCountByStatus($status) {

        return \App\ClientCase::where('status','=',$status)->get()->count();
    }
}
if (!function_exists('reduceItemQuantity')) {
    function reduceItemQuantity($id,$q) {

        $item= \App\ItemsInventory::findorfail($id);
        if(($item->quantity - $q) >=0)
        {
            $item->quantity =($item->quantity -$q);
            $item->save();

            return true;
        }
        else
            return false;
    }
}
if (!function_exists('getHighChatReferralsMonthlyCountByYear')) {
    function getHighChatReferralsMonthlyCountByYear($year) {

        $series1="";
        $seriesdata1="";

            $series1 .= "{ ";
            $series1 .= " name: 'Referrals',";

            $MonthCount = "";
            $monthData = "";
            for ($i = 1; $i <= 12; $i++) {
                $MonthCount .= count(\App\ClientReferral::whereMonth('referral_date', '=', $i)->whereYear('referral_date', '=', $year)->get()) . ",";
            }
            $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
            $series1 .= " data:[" . $monthData . "]";
            $series1 .= "  },";


        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}
if (!function_exists('getHighCashProvisionsMonthlyCountByYear')) {
    function getHighCashProvisionsMonthlyCountByYear($year) {

        $series1="";
        $seriesdata1="";

        $series1 .= "{ ";
        $series1 .= " name: 'Male (0 - 17)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {

            $MonthCount .=\DB::table('cash_provision_clients')
                    ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','A')
                    ->where('clients.sex','=','Male')
                    ->whereMonth('provision_date', '=', $i)
                    ->whereYear('provision_date', '=', $year)->sum( 'amount'). ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Female (0 - 17)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {

            $MonthCount .=\DB::table('cash_provision_clients')
                    ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','A')
                    ->where('clients.sex','=','Female')
                    ->whereMonth('provision_date', '=', $i)
                    ->whereYear('provision_date', '=', $year)->sum( 'amount'). ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Male (17 - 50)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=\DB::table('cash_provision_clients')
                    ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','B')
                    ->where('clients.sex','=','Male')
                    ->whereMonth('provision_date', '=', $i)
                    ->whereYear('provision_date', '=', $year)->sum( 'amount'). ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Female (17 - 50)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=\DB::table('cash_provision_clients')
                    ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','B')
                    ->where('clients.sex','=','Female')
                    ->whereMonth('provision_date', '=', $i)
                    ->whereYear('provision_date', '=', $year)->sum( 'amount'). ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Male (50 - 60)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=\DB::table('cash_provision_clients')
                    ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','C')
                    ->where('clients.sex','=','Male')
                    ->whereMonth('provision_date', '=', $i)
                    ->whereYear('provision_date', '=', $year)->sum( 'amount'). ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";
        $series1 .= "{ ";
        $series1 .= " name: 'Female (50 - 60)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=\DB::table('cash_provision_clients')
                    ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','C')
                    ->where('clients.sex','=','Female')
                    ->whereMonth('provision_date', '=', $i)
                    ->whereYear('provision_date', '=', $year)->sum( 'amount'). ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Male (60 >)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=\DB::table('cash_provision_clients')
                    ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','D')
                    ->where('clients.sex','=','Male')
                    ->whereMonth('provision_date', '=', $i)
                    ->whereYear('provision_date', '=', $year)->sum( 'amount'). ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Female (60 >)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=\DB::table('cash_provision_clients')
                    ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','D')
                    ->where('clients.sex','=','Female')
                    ->whereMonth('provision_date', '=', $i)
                    ->whereYear('provision_date', '=', $year)->sum( 'amount'). ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";


        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}
if (!function_exists('getHighItemsDistributionsMonthlyCountByYear')) {
    function getHighItemsDistributionsMonthlyCountByYear($year) {

        $series1="";
        $seriesdata1="";

        $series1 .= "{ ";
        $series1 .= " name: 'Male (0 - 17)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {

            $MonthCount .= count(\DB::table('items_disbursement_items')
                                ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                                ->where('clients.age_score','=','A')
                                ->where('clients.sex','=','Male')
                                ->whereMonth('distribution_date', '=', $i)
                                ->whereYear('distribution_date', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Female (0 - 17)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {

            $MonthCount .= count(\DB::table('items_disbursement_items')
                    ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','A')
                    ->where('clients.sex','=','Female')
                    ->whereMonth('distribution_date', '=', $i)
                    ->whereYear('distribution_date', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Male (17 - 50)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .= count(\DB::table('items_disbursement_items')
                    ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','B')
                    ->where('clients.sex','=','Male')
                    ->whereMonth('distribution_date', '=', $i)
                    ->whereYear('distribution_date', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";
        $series1 .= "{ ";
        $series1 .= " name: 'Female (17 - 50)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .= count(\DB::table('items_disbursement_items')
                    ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','B')
                    ->where('clients.sex','=','Female')
                    ->whereMonth('distribution_date', '=', $i)
                    ->whereYear('distribution_date', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Male (50 - 60)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=count(\DB::table('items_disbursement_items')
                    ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','C')
                    ->where('clients.sex','=','Male')
                    ->whereMonth('distribution_date', '=', $i)
                    ->whereYear('distribution_date', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Female (50 - 60)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=count(\DB::table('items_disbursement_items')
                    ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','C')
                    ->where('clients.sex','=','Female')
                    ->whereMonth('distribution_date', '=', $i)
                    ->whereYear('distribution_date', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Male (60 >)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .= count(\DB::table('items_disbursement_items')
                    ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','D')
                    ->where('clients.sex','=','Male')
                    ->whereMonth('distribution_date', '=', $i)
                    ->whereYear('distribution_date', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";
        $series1 .= "{ ";
        $series1 .= " name: 'Male (60 >)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .= count(\DB::table('items_disbursement_items')
                    ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','D')
                    ->where('clients.sex','=','Female')
                    ->whereMonth('distribution_date', '=', $i)
                    ->whereYear('distribution_date', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";


        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}
if (!function_exists('getHighChatClientMonthlyCountByYear')) {
    function getHighChatClientMonthlyCountByYear($year) {

        $series1="";
        $seriesdata1="";

            $series1 .= "{ ";
            $series1 .= " name: 'Male (0 - 17)',";

            $MonthCount = "";
            $monthData = "";
            for ($i = 1; $i <= 12; $i++) {
                $MonthCount .= count(\App\Client::where('age_score','=','A')
                        ->where('sex','=','Male')
                        ->whereMonth('date_arrival', '=', $i)
                        ->whereYear('date_arrival', '=', $year)->get()) . ",";
            }
            $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
            $series1 .= " data:[" . $monthData . "]";
            $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Female (0 - 17)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .= count(\App\Client::where('age_score','=','A')
                    ->where('sex','=','Female')
                    ->whereMonth('date_arrival', '=', $i)
                    ->whereYear('date_arrival', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Male (17 - 50)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .= count(\App\Client::where('age_score','=','B')
                    ->where('sex','=','Male')
                    ->whereMonth('date_arrival', '=', $i)
                    ->whereYear('date_arrival', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Female (17 - 50)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .= count(\App\Client::where('age_score','=','B')
                    ->where('sex','=','Female')
                    ->whereMonth('date_arrival', '=', $i)
                    ->whereYear('date_arrival', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Male (50 - 60)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .= count(\App\Client::where('age_score','=','C')
                    ->where('sex','=','Male')
                    ->whereMonth('date_arrival', '=', $i)
                    ->whereYear('date_arrival', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Female (50 - 60)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .= count(\App\Client::where('age_score','=','C')
                    ->where('sex','=','Female')
                    ->whereMonth('date_arrival', '=', $i)
                    ->whereYear('date_arrival', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Male (60 >)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .= count(\App\Client::where('age_score','=','D')
                    ->where('sex','=','Male')
                    ->whereMonth('date_arrival', '=', $i)
                    ->whereYear('date_arrival', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Female (60 >)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .= count(\App\Client::where('age_score','=','D')
                    ->where('sex','=','Female')
                    ->whereMonth('date_arrival', '=', $i)
                    ->whereYear('date_arrival', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";


        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}
if (!function_exists('getHighChatReferralsMonthlyCountByYear')) {
    function getHighChatReferralsMonthlyCountByYear($year) {

        $series1="";
        $seriesdata1="";

            $series1 .= "{ ";
            $series1 .= " name: 'Referrals',";

            $MonthCount = "";
            $monthData = "";
            for ($i = 1; $i <= 12; $i++) {
                $MonthCount .= count(\App\ClientReferral::whereMonth('referral_date', '=', $i)->whereYear('referral_date', '=', $year)->get()) . ",";
            }
            $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
            $series1 .= " data:[" . $monthData . "]";
            $series1 .= "  },";


        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}
if (!function_exists('getHighAssessmentsClientMonthlyCountByYear')) {
    function getHighAssessmentsClientMonthlyCountByYear($year) {

        $series1="";
        $seriesdata1="";

            $series1 .= "{ ";
            $series1 .= " name: 'Vulnerability Assessment',";

            $MonthCount = "";
            $monthData = "";
            for ($i = 1; $i <= 12; $i++) {
                $MonthCount .= count(\App\VulnerabilityAssessment::whereMonth('q1_5', '=', $i)->whereYear('q1_5', '=', $year)->get()) . ",";
            }
            $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
            $series1 .= " data:[" . $monthData . "]";
            $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Paediatric Assessment',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .= count(\App\PaediatricAssessment::whereMonth('created_at', '=', $i)->whereYear('created_at', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Function Assessment',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .= count(\App\InclusionAssessment::whereMonth('created_at', '=', $i)->whereYear('created_at', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Function Assessment',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .= count(\App\HomeAssessment::whereMonth('assessment_date', '=', $i)->whereYear('assessment_date', '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";


        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}
if (!function_exists('getHighChatClientByCodes')) {
    function getHighChatClientByCodes() {

        $series1="";
        $seriesdata1="";
        foreach (\App\PSNCode::where('for_reporting','=','Yes')->get() as $code) {
            $series1 .= "{ ";
            $series1 .= " name: '".$code->code."',";

            $MonthCount = "";
            $monthData = "";
            $MonthCount .= count(\App\ClientVulnerabilityCode::where('code_id','=',$code->id)->get()) . ",";
            $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
            $series1 .= " y:" . intval($monthData);
            $series1 .= "  },";
        }

        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}
if (!function_exists('getClientsCountByCreteriaAgeScore')) {
    function getClientsCountByCreteriaAgeScore($id,$score,$camp_id,$range) {
        if ($range =="") {
            $data = count(\DB::table('client_vulnerability_codes')->leftjoin('clients', 'client_vulnerability_codes.client_id', '=', 'clients.id')
                ->where('client_vulnerability_codes.code_id', '=', $id)
                ->where('clients.camp_id', '=', $camp_id)
                ->where('clients.age_score', '=', $score)
                ->where('clients.date_arrival', null)->get());
        }else{
            $data = count(\DB::table('client_vulnerability_codes')->leftjoin('clients', 'client_vulnerability_codes.client_id', '=', 'clients.id')
                ->where('client_vulnerability_codes.code_id', '=', $id)
                ->where('clients.camp_id', '=', $camp_id)
                ->where('clients.age_score', '=', $score)
                ->whereBetween('clients.date_arrival', $range)->get());
        }

        return $data;
    }
}
if (!function_exists('getClientsSumCountByCreteriaAgeScore')) {
    function getClientsSumCountByCreteriaAgeScore($id,$camp_id,$range) {
        if ($range ==""){
            $data = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
                ->where('client_vulnerability_codes.code_id','=',$id)
                ->where('clients.camp_id','=',$camp_id)
                ->where('clients.date_arrival', null)->get());
        }
        else{
            $data = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
                ->where('client_vulnerability_codes.code_id','=',$id)
                ->where('clients.camp_id','=',$camp_id)
                ->whereBetween('clients.date_arrival', $range)->get());
        }

        return $data;
    }
}
if (!function_exists('getClientsCountByCreteria')) {
    function getClientsCountByCreteria($id,$sex,$score,$camp_id,$range) {
        if ($range == "") {
            $data = count(\DB::table('client_vulnerability_codes')->leftjoin('clients', 'client_vulnerability_codes.client_id', '=', 'clients.id')
                ->where('client_vulnerability_codes.code_id', '=', $id)
                ->where('clients.camp_id', '=', $camp_id)
                ->where('clients.sex', '=', $sex)
                ->where('clients.age_score', '=', $score)
                ->where('clients.date_arrival', null)->get());
        }
        else
        {
            $data = count(\DB::table('client_vulnerability_codes')->leftjoin('clients', 'client_vulnerability_codes.client_id', '=', 'clients.id')
                ->where('client_vulnerability_codes.code_id', '=', $id)
                ->where('clients.camp_id', '=', $camp_id)
                ->where('clients.sex', '=', $sex)
                ->where('clients.age_score', '=', $score)
                ->whereBetween('clients.date_arrival', $range)->get());
        }

        return $data;
    }
}
if (!function_exists('getClientsSumCountByCreteria')) {
    function getClientsSumCountByCreteria($id,$sex,$camp_id,$range) {
        if ($range ==""){
            $data = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
                ->where('client_vulnerability_codes.code_id','=',$id)
                ->where('clients.camp_id','=',$camp_id)
                ->where('clients.sex','=',$sex)
                ->where('clients.date_arrival', null)->get());
        }
        else{
            $data = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
                ->where('client_vulnerability_codes.code_id','=',$id)
                ->where('clients.camp_id','=',$camp_id)
                ->where('clients.sex','=',$sex)
                ->whereBetween('clients.date_arrival', $range)->get());
        }


        return $data;
    }
}
if (!function_exists('getClientsCountPercentageByCreteria')) {
    function getClientsCountPercentageByCreteria($id,$sex,$score,$camp_id,$range) {
        if ($range =="") {
            $sexcount = count(\DB::table('client_vulnerability_codes')->leftjoin('clients', 'client_vulnerability_codes.client_id', '=', 'clients.id')
                ->where('client_vulnerability_codes.code_id', '=', $id)
                ->where('clients.camp_id', '=', $camp_id)
                ->where('clients.sex', '=', $sex)
                ->where('clients.age_score', '=', $score)
                ->where('clients.date_arrival', null)->get());

            $total = count(\DB::table('client_vulnerability_codes')->leftjoin('clients', 'client_vulnerability_codes.client_id', '=', 'clients.id')
                ->where('client_vulnerability_codes.code_id', '=', $id)
                ->where('clients.camp_id', '=', $camp_id)
                ->where('clients.age_score', '=', $score)
                ->where('clients.date_arrival', null)->get());
        }
        else
        {
            $sexcount = count(\DB::table('client_vulnerability_codes')->leftjoin('clients', 'client_vulnerability_codes.client_id', '=', 'clients.id')
                ->where('client_vulnerability_codes.code_id', '=', $id)
                ->where('clients.camp_id', '=', $camp_id)
                ->where('clients.sex', '=', $sex)
                ->where('clients.age_score', '=', $score)
                ->whereBetween('clients.date_arrival', $range)->get());

            $total = count(\DB::table('client_vulnerability_codes')->leftjoin('clients', 'client_vulnerability_codes.client_id', '=', 'clients.id')
                ->where('client_vulnerability_codes.code_id', '=', $id)
                ->where('clients.camp_id', '=', $camp_id)
                ->where('clients.age_score', '=', $score)
                ->whereBetween('clients.date_arrival', $range)->get());
        }

        $percent=0;
        if($sexcount > 0 && $total >0 ) {
            $num=(($sexcount / $total) * 100);
            $percent =  number_format($num,2). "%";
        }
        else{
            $percent .="%";
        }
        return $percent;
    }
}
if (!function_exists('getClientsSumCountPercentageByCreteria')) {
    function getClientsSumCountPercentageByCreteria($id,$sex,$camp_id,$range) {
        if ($range ==""){
            $sexcount = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
                ->where('client_vulnerability_codes.code_id','=',$id)
                ->where('clients.camp_id','=',$camp_id)
                ->where('clients.sex','=',$sex)
                ->where('clients.date_arrival', null)->get());

            $total=count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
                ->where('client_vulnerability_codes.code_id','=',$id)
                ->where('clients.camp_id','=',$camp_id)
                ->where('clients.date_arrival', null)->get());
        }else{
            $sexcount = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
                ->where('client_vulnerability_codes.code_id','=',$id)
                ->where('clients.camp_id','=',$camp_id)
                ->where('clients.sex','=',$sex)
                ->whereBetween('clients.date_arrival', $range)->get());

            $total=count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
                ->where('client_vulnerability_codes.code_id','=',$id)
                ->where('clients.camp_id','=',$camp_id)
                ->whereBetween('clients.date_arrival', $range)->get());
        }

        $percent=0;
        if($sexcount > 0 && $total >0 ) {
            $num=(($sexcount / $total) * 100);
            $percent =  number_format($num,2). "%";
        }
        else{
            $percent .="%";
        }
        return $percent;
    }
}
if (!function_exists('getClientsCountPercentageByCreteriaAgeScore')) {
    function getClientsCountPercentageByCreteriaAgeScore($id,$score,$camp_id,$range) {
        if ($range =="") {
            $sexcount = count(\DB::table('client_vulnerability_codes')->leftjoin('clients', 'client_vulnerability_codes.client_id', '=', 'clients.id')
                ->where('client_vulnerability_codes.code_id', '=', $id)
                ->where('clients.camp_id', '=', $camp_id)
                ->where('clients.age_score', '=', $score)
                ->where('clients.date_arrival', null)->get());

            $total = count(\DB::table('client_vulnerability_codes')->leftjoin('clients', 'client_vulnerability_codes.client_id', '=', 'clients.id')
                ->where('client_vulnerability_codes.code_id', '=', $id)
                ->where('clients.camp_id', '=', $camp_id)
                ->where('clients.date_arrival', null)->get());
        }else{
            $sexcount = count(\DB::table('client_vulnerability_codes')->leftjoin('clients', 'client_vulnerability_codes.client_id', '=', 'clients.id')
                ->where('client_vulnerability_codes.code_id', '=', $id)
                ->where('clients.camp_id', '=', $camp_id)
                ->where('clients.age_score', '=', $score)
                ->whereBetween('clients.date_arrival', $range)->get());

            $total = count(\DB::table('client_vulnerability_codes')->leftjoin('clients', 'client_vulnerability_codes.client_id', '=', 'clients.id')
                ->where('client_vulnerability_codes.code_id', '=', $id)
                ->where('clients.camp_id', '=', $camp_id)
                ->whereBetween('clients.date_arrival', $range)->get());
        }

        $percent=0;
        if($sexcount > 0 && $total >0 ) {
            $num=(($sexcount / $total) * 100);
            $percent =  number_format($num,2). "%";
        }
        else{
            $percent .="%";
        }
        return $percent;
    }
}
if (!function_exists('getClientsSumCountPercentageByCreteriaAgeScore')) {
    function getClientsSumCountPercentageByCreteriaAgeScore($id,$camp_id,$range) {
        if ($range ==""){
            $sexcount = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
                ->where('client_vulnerability_codes.code_id','=',$id)
                ->where('clients.camp_id','=',$camp_id)
                ->where('clients.date_arrival', null)->get());

            $total=count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
                ->where('client_vulnerability_codes.code_id','=',$id)
                ->where('clients.camp_id','=',$camp_id)
                ->where('clients.date_arrival', null)->get());
        }
        else{
            $sexcount = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
                ->where('client_vulnerability_codes.code_id','=',$id)
                ->where('clients.camp_id','=',$camp_id)
                ->whereBetween('clients.date_arrival', $range)->get());

            $total=count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
                ->where('client_vulnerability_codes.code_id','=',$id)
                ->where('clients.camp_id','=',$camp_id)
                ->whereBetween('clients.date_arrival', $range)->get());
        }

        $percent=0;
        if($sexcount > 0 && $total >0 ) {
            $num=(($sexcount / $total) * 100);
            $percent =  number_format($num,2). "%";
        }
        else{
            $percent .="%";
        }
        return $percent;
    }
}
if (!function_exists('getClientsCountAll')) {
    function getClientsCountAll($id,$range,$camp_id) {
       if($range =="") {
           $data = \DB::table('client_vulnerability_codes')->leftjoin('clients', 'client_vulnerability_codes.client_id', '=', 'clients.id')
               ->where('client_vulnerability_codes.code_id', '=', $id)
               ->where('clients.camp_id', '=', $camp_id)
               ->where('clients.date_arrival', null)->get();
       }else
       {
           $data = \DB::table('client_vulnerability_codes')->leftjoin('clients', 'client_vulnerability_codes.client_id', '=', 'clients.id')
               ->where('client_vulnerability_codes.code_id', '=', $id)
               ->where('clients.camp_id', '=', $camp_id)
               ->whereBetween('clients.date_arrival', $range)->get();
       }

        return count($data);
    }
}
if (!function_exists('getHighChatClientMonthlyCountByNationality')) {
    function getHighChatClientMonthlyCountByNationality() {

        $series1="";
        $seriesdata1="";

            $series1 .= "{ ";
            $series1 .= " name: '0 - 17',";

            $MonthCount = "";
            $monthData = "";
            $MonthCount .= count(\App\Client::where('age_score','=','A')->get()) . ",";
            $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
            $series1 .= " y:" . intval($monthData);
            $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: '17 - 50 ',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\App\Client::where('age_score','=','B')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: '50-60',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\App\Client::where('age_score','=','C')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: '60 > ',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\App\Client::where('age_score','=','D')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}
if (!function_exists('getHighChatItemsDistributionByYear')) {
    function getHighChatItemsDistributionByYear($year) {
        $MonthCount="";
        $monthData="";
        for($i=1; $i<= 12; $i++)
        {
            $MonthCount.=count(\App\ItemsDisbursement::whereMonth('disbursements_date','=',$i)->whereYear('disbursements_date','=',$year)->get()).",";
        }
        $monthData.=substr($MonthCount,0,strlen($MonthCount)-1);
        return $monthData;
    }
}

if (!function_exists('getClientNumberBySex')) {
    function getClientNumberBySex($sex) {
        return count(\App\Client::where('sex','=',ucwords(strtolower($sex)))->get());
    }
}
if (!function_exists('getClientNumberBySexByCamp')) {
    function getClientNumberBySexByCamp($sex,$camp_id,$range) {
        if ($range ==""){
            return count(\App\Client::where('date_arrival', null)
                ->where('camp_id','=',$camp_id)
                ->where('sex','=',ucwords(strtolower($sex)))->get());
        }
        else{
            return count(\App\Client::whereBetween('date_arrival', $range)
                ->where('camp_id','=',$camp_id)
                ->where('sex','=',ucwords(strtolower($sex)))->get());
        }
    }
}
if (!function_exists('getClientPercentageBySex')) {
    function getClientPercentageBySex($sex) {
        $sexcount= count(\App\Client::where('sex','=',ucwords(strtolower($sex)))->get());
        $total=count(\App\Client::all());
        $percent=0;
        if($sexcount > 0 && $total >0 ) {
            $num=(($sexcount / $total) * 100);
            $percent =  number_format($num,2). "%";
        }
        else{
            $percent .="%";
        }
        return $percent;

    }
}
if (!function_exists('getClientNumberBySexAgescore')) {
    function getClientNumberBySexAgescore($sex,$score) {
        return count(\App\Client::where('sex','=',ucwords(strtolower($sex)))->where('age_score','=',$score)->get());
    }
}
if (!function_exists('getClientNumberBySexAgescoreByCamp')) {
    function getClientNumberBySexAgescoreByCamp($sex,$score,$camp_id,$range) {
        if ($range ==""){
            return count(\App\Client::where('date_arrival', null)
                        ->where('camp_id','=',$camp_id)->where('sex','=',ucwords(strtolower($sex)))
                        ->where('age_score','=',$score)->get());
        }
        else{
            return count(\App\Client::whereBetween('date_arrival', $range)
                        ->where('camp_id','=',$camp_id)->where('sex','=',ucwords(strtolower($sex)))
                        ->where('age_score','=',$score)->get());
        }

    }
}
if (!function_exists('getClientNumberByAgeScore')) {
    function getClientNumberByAgeScore($score) {
        return count(\App\Client::where('age_score','=',$score)->get());
    }
}
if (!function_exists('getClientNumberByAgeScoreByCamp')) {
    function getClientNumberByAgeScoreByCamp($score,$camp_id,$range) {
        if ($range ==""){
            return count(\App\Client::where('date_arrival', null)
                ->where('camp_id','=',$camp_id)->where('age_score','=',$score)->get());
        }
        else{
            return count(\App\Client::whereBetween('date_arrival', $range)
                ->where('camp_id','=',$camp_id)->where('age_score','=',$score)->get());
        }

    }
}
if (!function_exists('getAllClientsNumber')) {
    function getAllClientsNumber() {
        return count(\App\Client::all());
    }
}
if (!function_exists('getAllClientsNumberByCamp')) {
    function getAllClientsNumberByCamp($camp_id,$range) {
        if ($range ==""){
            return count(\App\Client::where('date_arrival', null)
                ->where('camp_id','=',$camp_id)->get());
        }else{
            return count(\App\Client::whereBetween('date_arrival', $range)->where('camp_id','=',$camp_id)->get());
        }
    }
}
if (!function_exists('getClientPercentageBySexAgeScore')) {
    function getClientPercentageBySexAgeScore($sex,$score) {
        $sexcount= count(\App\Client::where('sex','=',ucwords(strtolower($sex)))->where('age_score','=',$score)->get());
        $total=count(\App\Client::where('age_score','=',$score)->get());
        $percent=0;
        if($sexcount > 0 && $total >0 ) {
            $num=(($sexcount / $total) * 100);
            $percent =  number_format($num,2). "%";
        }
        else{
            $percent .="%";
        }
        return $percent;

    }
}
if (!function_exists('getClientPercentageByAgeScore')) {
    function getClientPercentageByAgeScore($score) {
        $sexcount= count(\App\Client::where('age_score','=',$score)->get());
        $total=count(\App\Client::all());
        $percent=0;
        if($sexcount > 0 && $total >0 ) {
            $num=(($sexcount / $total) * 100);
            $percent =  number_format($num,2). "%";
        }
        else{
            $percent .="%";
        }
        return $percent;

    }
}
if (!function_exists('getClientPercentageByAgeScoreByCamp')) {
    function getClientPercentageByAgeScoreByCamp($score,$camp_id,$range) {
        if ($range ==""){
            $sexcount= count(\App\Client::where('date_arrival', null)
                ->where('camp_id','=',$camp_id)->where('age_score','=',$score)->get());
            $total=count(\App\Client::where('date_arrival', null)
                ->where('camp_id','=',$camp_id)->get());
        }
        else{
            $sexcount= count(\App\Client::whereBetween('date_arrival', $range)
                ->where('camp_id','=',$camp_id)->where('age_score','=',$score)->get());
            $total=count(\App\Client::whereBetween('date_arrival', $range)
                ->where('camp_id','=',$camp_id)->get());
        }
        $percent=0;
        if($sexcount > 0 && $total >0 ) {
            $num=(($sexcount / $total) * 100);
            $percent =  number_format($num,2). "%";
        }
        else{
            $percent .="%";
        }
        return $percent;

    }
}

if (!function_exists('isClientRegistered')) {
    function isClientRegistered($name,$sex,$age,$present_address,$ration_card_number) {
        if(count(\App\Client::where('full_name','=',ucwords(strtolower(preg_replace('/\s+/S', " ",$name))))
                ->where('age','=',$age)
                ->where('sex','=',$sex)
                ->where('present_address','=',ucwords(strtolower(preg_replace('/\s+/S', " ",$present_address))))
                ->where('ration_card_number','=',preg_replace('/\s+/S', "",$ration_card_number))->get()) > 0){

            return true;
        }
        else{
            return false;
        }

    }
}
if (!function_exists('getClientIdFromData')) {
    function getClientIdFromData($name,$sex,$age,$present_address,$ration_card_number) {
        if(count(\App\Client::where('full_name','=',ucwords(strtolower(preg_replace('/\s+/S', " ",$name))))
            ->where('age','=',$age)
            ->where('sex','=',$sex)
            ->where('present_address','=',ucwords(strtolower(preg_replace('/\s+/S', " ",$present_address))))
            ->where('ration_card_number','=',preg_replace('/\s+/S', "",$ration_card_number))->get())){

            $client=\App\Client::where('full_name','=',ucwords(strtolower(preg_replace('/\s+/S', " ",$name))))
                ->where('age','=',$age)
                ->where('sex','=',$sex)
                ->where('present_address','=',ucwords(strtolower(preg_replace('/\s+/S', " ",$present_address))))
                ->where('ration_card_number','=',preg_replace('/\s+/S', "",$ration_card_number))->get()->first();

            return $client;
        }
        else{
            return null;
        }

    }
}
if (!function_exists('isNotInDistributionLimit')) {
    function isNotInDistributionLimit($item_id,$client_id,$distribution_date) {

        if(count(\App\ItemsDisbursementItems::where('item_id','=',$item_id)
                ->where('client_id','=',$client_id)->orderBy('distribution_date','desc')->get()) >0)
        {

            $itemsds=\App\ItemsDisbursementItems::where('item_id','=',$item_id)
                ->where('client_id','=',$client_id)->orderBy('distribution_date','desc')->get()->first();

            $inventoryItem= \App\ItemsInventory::find($item_id);
            $limit =$inventoryItem->redistribution_limit;

            $ts1 = strtotime($itemsds->distribution_date);
            $ts2 = strtotime($distribution_date);
            $datediff =$ts2-$ts1;
            $dayspass= floor($datediff / (60 * 60 * 24));
            if( $dayspass < 0 ) {
                $dayspass = -1 * $dayspass;
            }
            if($dayspass <= $limit ){
                return true;
            }
            else
            {
                return false;
            }

        }
        else
        {
            return false;
        }

    }
}
if (!function_exists('isInDistributionLimit')) {

    function isInDistributionLimit($item_id, $client_id, $distribution_date) {

        $disBasement = \App\ItemsDisbursementItems::where('item_id','=',$item_id)
                        ->where('client_id','=',$client_id)
                        ->orderBy('distribution_date','desc')
                        ->first();

        if($disBasement !=  null) {
            $itemsds= $disBasement;

            $inventoryItem= \App\ItemsInventory::find($item_id);
            $limit =$inventoryItem->redistribution_limit;

            $ts1 = strtotime($itemsds->distribution_date);
            $ts2 = strtotime($distribution_date);
            $datediff =$ts2-$ts1;

            $dayspass= floor($datediff / (60 * 60 * 24));
            if( $dayspass < 0 ) {
                $dayspass = -1 * $dayspass;
            }
            if($dayspass <= $limit ){
                return true;
            }
            else
            {
                return false;
            }

        }
        else
        {
            return false;
        }

    }
}

if (!function_exists('deductItems')) {
    function deductItems($item_id, $q) {
        $item = \App\ItemsInventory::find($item_id);
        $quantityLeft = $item->quantity - $q;
        $item->quantity = $quantityLeft;
        $item->save();
        if($quantityLeft <= 0) {
            $item->quantity = 0;
            $item->status = "Out of stock";
            $item->save();
        }
    }
}

if (!function_exists('isItemOutOfStock')) {
    function isItemOutOfStock($item_id, $quantity) {

        $item = \App\ItemsInventory::find($item_id);
        if ($item == null) {
            return true;
        }
        if ($item->quantity < 0) {
            return true;
        }
        return ($item->quantity - $quantity) < 0;
    }
}
if (!function_exists('isItemOutOfStockNoQ')) {
    function isItemOutOfStockNoQ($item_id) {

        $item=\App\ItemsInventory::find($item_id);
        if(($item->quantity) < 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

if (!function_exists('getAllClientsReceivedItemByItemId')) {
    function getAllClientsReceivedItemByItemId($item_id,$range) {

        if ($range ==""){
            $itemsUsers=\App\ItemsDisbursementItems::where('item_id','=',$item_id)
                ->where('distribution_date', null)->get();
            $itemsUsers= \DB::table('items_disbursement_items')
                ->leftjoin('clients','items_disbursement_items.client_id','=','clients.id')
                ->select('clients.*')
                ->where('distribution_date', null)->get();
        }
        else
        {
            $itemsUsers=\App\ItemsDisbursementItems::where('item_id','=',$item_id)
                ->whereBetween('distribution_date', $range)->get();
            $itemsUsers= \DB::table('items_disbursement_items')
                ->leftjoin('clients','items_disbursement_items.client_id','=','clients.id')
                ->select('clients.*')
                ->whereBetween('distribution_date', $range)->get();
        }

    }
}
if (!function_exists('isAuthorized')) {
    function isAuthorized($status) {
        if(strtolower($status) =="pending"){
            return false;
        } else {
            return true;
        }
    }
}

//Check if service was selected
if (!function_exists('isReferralServiceSelected')) {
    function isReferralServiceSelected($id,$service_request) {
        if(\App\RequestedService::where('service_request', '=', $service_request)->where('requested_id', '=', $id)->get() != null){
            return true;
        } else {
            return false;
        }
    }
}

//Is client registered
if (!function_exists('checkRegistrationByHAIReg')) {
    function checkRegistrationByHAIReg($hai_reg_number) {

        if(count(\App\Client::where('hai_reg_number','=',$hai_reg_number)->get()) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

if (!function_exists('checkRegistrationByHAIRegCampID')) {
    function checkRegistrationByHAIRegCampID($hai_reg_number,$camp_id) {

        if(count(\App\Client::where('hai_reg_number','=',$hai_reg_number)->where('camp_id','=',$camp_id)->get()) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

if (!function_exists('hasClientReachedProvisionLimit')) {
    function hasClientReachedProvisionLimit($activity_id, $client_id, $provision_date) {

       $cashProvisionClient =  \App\CashProvisionClient::where('activity_id', '=', $activity_id)
                                    ->where('client_id', '=', $client_id)->orderBy('provision_date', 'desc')->first();

        if($cashProvisionClient != null) {

            $activity = \App\BudgetActivity::find($activity_id);
            $limit = $activity->provision_limit;

            $ts1 = strtotime($cashProvisionClient->provision_date);
            $ts2 = strtotime($provision_date);

            $datediff = $ts2 - $ts1;

            $dayspass = floor($datediff / (60 * 60 * 24));

            if( $dayspass < 0 ) {
                $dayspass = -1 * $dayspass;
            }

            if($dayspass <= $limit ) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}


if (!function_exists('isActivityOutOfFunds')) {
    function isActivityOutOfFunds($activity_id, $amount) {
        $actvy = \App\BudgetActivity::find($activity_id);
        $current_amount = $actvy->amount;
        if(($current_amount - $amount) <= 0 ) {
            return true;
        } else {
            return false;
        }
    }
}
if (!function_exists('isActivityOutOfFundsbyID')) {
    function isActivityOutOfFundsbyID($activity_id) {
        $actvy = \App\BudgetActivity::find($activity_id);
        if($actvy->amount <= 0 ) {
            return true;
        } else {
            return false;
        }
    }
}

//Deduct money
if (!function_exists('deductActivityAmount')) {
    function deductActivityAmount($activity_id, $amount){
        $actvy = \App\BudgetActivity::find($activity_id);
        if ($actvy != null && $actvy->amount != null) {

            $current_amount = $actvy->amount;
            $after_amount = $current_amount - $amount;

            if ($after_amount <= 0) {
                $actvy->status = "Insufficient Funds";
                $actvy->amount = 0.0;
            } else {
                $actvy->amount = $after_amount;
            }
            $actvy->save();
            return true;
        }
        else
        {
            return false;
        }
    }


}

if (!function_exists('isSidebarOpen')) {
    function isSidebarOpen() {
        $setting = \App\Helpers\SystemConfig::getUserSettingByUserIdAndKey(auth()->user()->id,
        \App\Helpers\SystemConstant::SIDE_BAR_OPEN_CLOSE_STATUS);

        if ($setting != null) {
            return toBool($setting->setting_value);
        }
        return  false;
    }
}

if (!function_exists('toBool')) {
    function toBool($var) {
        if (!is_string($var)) return (bool) $var;
        switch (strtolower($var)) {
        case '1':
        case 'true':
        case 'on':
        case 'yes':
        case 'y':
            return true;
        default:
            return false;
        }
    }
}


//Get client ID
