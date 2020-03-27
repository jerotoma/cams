<?php

///Cash distribution per populations reports
if (!function_exists('getClientCountCashProvisionByCriteriaInNumber')) {
    function getClientCountCashProvisionByCriteriaInNumber($age_score,$sex,$range){
        $query=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->where('clients.age_score','=',$age_score)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

        return count($query);
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInPercentage')) {
    function getClientCountCashProvisionByCriteriaInPercentage($age_score,$sex,$range){
        $qsex=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->where('clients.age_score','=',$age_score)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

        $qtotal=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

        return $percentage;
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInNumberTotal')) {
    function getClientCountCashProvisionByCriteriaInNumberTotal($age_score,$range){
        $query=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.age_score','=',$age_score)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

        return count($query);
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInPercentageTotal')) {
    function getClientCountCashProvisionByCriteriaInPercentageTotal($age_score,$range){

        $qsex=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.age_score','=',$age_score)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

        $qtotal=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();
        if (count($qsex) >0 && count($qtotal)) {
            $calcper = (intval(count($qsex)) / intval(count($qtotal))) * 100;

            $percentage = number_format($calcper, 2) . "%";
        }else
        {
            $percentage = "0%";
        }

        return $percentage;
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInNumberTotalBySex')) {
    function getClientCountCashProvisionByCriteriaInNumberTotalBySex($sex,$range){
        $query=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();;

        return count($query);
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInPercentageTotalBySex')) {
    function getClientCountCashProvisionByCriteriaInPercentageTotalBySex($sex,$range){
        $qsex=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

        $qtotal=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();
        if (count($qsex) >0 && count($qtotal) >0) {
            $calcper = (intval(count($qsex)) / intval(count($qtotal))) * 100;

            $percentage = number_format($calcper, 2) . "%";
        }
        else
        {
            $percentage = "0%";
        }

        return $percentage;
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInNumberTotalByAll')) {
    function getClientCountCashProvisionByCriteriaInNumberTotalByAll($range){
        $query=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();;

        return count($query);
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInPercentageTotalByAll')) {
    function getClientCountCashProvisionByCriteriaInPercentageTotalByAll($range){
        $qsex=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

        $qtotal=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

        if (count($qsex) >0 && count($qtotal) >0 ) {
            $calcper = (intval(count($qsex)) / intval(count($qtotal))) * 100;

            $percentage = number_format($calcper, 2) . "%";
        }else
        {
            $percentage = "%";
        }

        return $percentage;
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInNumberByCamp')) {
    function getClientCountCashProvisionByCriteriaInNumberByCamp($age_score,$sex,$range,$camp_id){
        $query=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->where('clients.age_score','=',$age_score)
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();


        return count($query);
    }

}

if (!function_exists('getClientCountCashProvisionByCriteriaInPercentageByCamp')) {
    function getClientCountCashProvisionByCriteriaInPercentageByCamp($age_score,$sex,$range,$camp_id){
        $qsex=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->where('clients.age_score','=',$age_score)
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

        $qtotal=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();
        if (count($qsex) >0 && count($qtotal) >0 ) {
            $calcper = (intval(count($qsex)) / intval(count($qtotal))) * 100;

            $percentage = number_format($calcper, 2) . "%";
        }
        else
        {
            $percentage = "0%";
        }

        return $percentage;
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInNumberTotalByCamp')) {
    function getClientCountCashProvisionByCriteriaInNumberTotalByCamp($age_score,$range,$camp_id){
        $query=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.age_score','=',$age_score)
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

        return count($query);
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInPercentageTotalByCamp')) {
    function getClientCountCashProvisionByCriteriaInPercentageTotalByCamp($age_score,$range,$camp_id){
        $qsex=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.age_score','=',$age_score)
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

        $qtotal=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();
        if (count($qsex) >0 && count($qtotal)) {
            $calcper = (intval(count($qsex)) / intval(count($qtotal))) * 100;

            $percentage = number_format($calcper, 2) . "%";
        }else
        {
            $percentage = "0%";
        }

        return $percentage;
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInNumberTotalBySexByCamp')) {
    function getClientCountCashProvisionByCriteriaInNumberTotalBySexByCamp($sex,$range,$camp_id){
        $query=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

        return count($query);
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInPercentageTotalBySexByCamp')) {
    function getClientCountCashProvisionByCriteriaInPercentageTotalBySexByCamp($sex,$range,$camp_id){
        $qsex=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

        $qtotal=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

        if (count($qsex) >0 && count($qsex) >0) {
            $calcper = (intval(count($qsex)) / intval(count($qtotal))) * 100;

            $percentage = number_format($calcper, 2) . "%";
        }
        else
        {
            $percentage = "0%";
        }

        return $percentage;
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInNumberTotalByAllByCamp')) {
    function getClientCountCashProvisionByCriteriaInNumberTotalByAllByCamp($range,$camp_id){
        $query=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

        return count($query);
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInPercentageTotalByAllByCamp')) {
    function getClientCountCashProvisionByCriteriaInPercentageTotalByAllByCamp($range,$camp_id){
        $qsex=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

        $qtotal=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();
        if (count($qsex) >0 && count($qtotal) > 0) {
            $calcper = (intval(count($qsex)) / intval(count($qtotal))) * 100;

            $percentage = number_format($calcper, 2) . "%";
        }
        else
        {
            $percentage = "0%";
        }

        return $percentage;
    }

}

//Graphics
if (!function_exists('getHighChatCashDistributionByAgeGroup')) {
    function getHighChatCashDistributionByAgeGroup($range) {

        $series1="";
        $seriesdata1="";

        $series1 .= "{ ";
        $series1 .= " name: '0 - 17',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.age_score','=','A')
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: '17 - 50 ',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('cash_provision_clients')
                ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                ->where('clients.age_score','=','B')
                ->whereBetween('cash_provision_clients.provision_date', $range)
                ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: '50-60',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('cash_provision_clients')
                ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                ->where('clients.age_score','=','C')
                ->whereBetween('cash_provision_clients.provision_date', $range)
                ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: '60 > ',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('cash_provision_clients')
                ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                ->where('clients.age_score','=','D')
                ->whereBetween('cash_provision_clients.provision_date', $range)
                ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}
if (!function_exists('getHighChatCashDistributionByAgeGroupByCamp')) {
    function getHighChatCashDistributionByAgeGroupByCamp($range,$camp_id) {

        $series1="";
        $seriesdata1="";

        $series1 .= "{ ";
        $series1 .= " name: '0 - 17',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('cash_provision_clients')
                ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                ->where('clients.age_score','=','A')
                ->where('clients.camp_id','=',$camp_id)
                ->whereBetween('cash_provision_clients.provision_date', $range)
                ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: '17 - 50 ',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('cash_provision_clients')
                ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                ->where('clients.age_score','=','B')
                ->where('clients.camp_id','=',$camp_id)
                ->whereBetween('cash_provision_clients.provision_date', $range)
                ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: '50-60',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('cash_provision_clients')
                ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                ->where('clients.age_score','=','C')
                ->where('clients.camp_id','=',$camp_id)
                ->whereBetween('cash_provision_clients.provision_date', $range)
                ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: '60 > ',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('cash_provision_clients')
                ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                ->where('clients.age_score','=','D')
                ->where('clients.camp_id','=',$camp_id)
                ->whereBetween('cash_provision_clients.provision_date', $range)
                ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}

//Cash distributions per vulnerability
if (!function_exists('getHighChatCashDistributionByVulnerability')) {
    function getHighChatCashDistributionByVulnerability($range) {

        $series1="";
        $seriesdata1="";
        foreach (\App\PSNCode::where('for_reporting','=','Yes')->get() as $code) {
            $series1 .= "{ ";
            $series1 .= " name: '".$code->code."',";

            $MonthCount = "";
            $monthData = "";
            $MonthCount .= count(\DB::table('cash_provision_clients')
                    ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                    ->join('client_vulnerability_codes', 'clients.id', '=', 'client_vulnerability_codes.client_id')
                    ->where('client_vulnerability_codes.code_id','=',$code->id)
                    ->whereBetween('cash_provision_clients.provision_date', $range)
                    ->select('clients.*')->get()) . ",";
            $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
            $series1 .= " y:" . intval($monthData);
            $series1 .= "  },";
        }

        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}

if (!function_exists('getHighChatCashDistributionByVulnerabilityByCamp')) {
    function getHighChatCashDistributionByVulnerabilityByCamp($range,$camp_id) {

        $series1="";
        $seriesdata1="";
        foreach (\App\PSNCode::where('for_reporting','=','Yes')->get() as $code) {
            $series1 .= "{ ";
            $series1 .= " name: '".$code->code."',";

            $MonthCount = "";
            $monthData = "";
            $MonthCount .= count(\DB::table('cash_provision_clients')
                    ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
                    ->join('client_vulnerability_codes', 'clients.id', '=', 'client_vulnerability_codes.client_id')
                    ->where('client_vulnerability_codes.code_id','=',$code->id)
                    ->where('clients.camp_id','=',$camp_id)
                    ->whereBetween('cash_provision_clients.provision_date', $range)
                    ->select('clients.*')->get()) . ",";
            $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
            $series1 .= " y:" . intval($monthData);
            $series1 .= "  },";
        }

        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}