<?php
//Items distributions
if (!function_exists('getClientCountItemDistributionByCriteriaInNumber')) {
    function getClientCountItemDistributionByCriteriaInNumber($age_score,$sex,$range,$item_id){
        $query=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->where('clients.age_score','=',$age_score)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*');

        return count($query->get());
    }

}
if (!function_exists('getClientCountItemDistributionByCriteriaInPercentage')) {
    function getClientCountItemDistributionByCriteriaInPercentage($age_score,$sex,$range,$item_id){
        $qsex=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->where('clients.age_score','=',$age_score)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();

        $qtotal=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
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
if (!function_exists('getClientCountItemDistributionByCriteriaInNumberTotal')) {
    function getClientCountItemDistributionByCriteriaInNumberTotal($age_score,$range,$item_id){
        $query=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.age_score','=',$age_score)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();

        return count($query);
    }

}
if (!function_exists('getClientCountItemDistributionByCriteriaInPercentageTotal')) {
    function getClientCountItemDistributionByCriteriaInPercentageTotal($age_score,$range,$item_id){
        $qsex=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.age_score','=',$age_score)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();

        $qtotal=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();
        if (count($qsex) > 0 && count($qtotal) >0) {
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
if (!function_exists('getClientCountItemDistributionByCriteriaInNumberTotalBySex')) {
    function getClientCountItemDistributionByCriteriaInNumberTotalBySex($sex,$range,$item_id){
        $query=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();

        return count($query);
    }

}
if (!function_exists('getClientCountItemDistributionByCriteriaInPercentageTotalBySex')) {
    function getClientCountItemDistributionByCriteriaInPercentageTotalBySex($sex,$range,$item_id){
        $qsex=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();

        $qtotal=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
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
if (!function_exists('getClientCountItemDistributionByCriteriaInNumberTotalByAll')) {
    function getClientCountItemDistributionByCriteriaInNumberTotalByAll($range,$item_id){
        $query=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->select('clients.*')->get();

        return count($query);
    }

}
if (!function_exists('getClientCountItemDistributionByCriteriaInPercentageTotalByAll')) {
    function getClientCountItemDistributionByCriteriaInPercentageTotalByAll($range,$item_id){
        $qsex=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->select('clients.*')->get();

        $qtotal=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->where('items_disbursement_items.item_id','=',$item_id)
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
if (!function_exists('getClientCountItemDistributionByCriteriaInNumberByCamp')) {
    function getClientCountItemDistributionByCriteriaInNumberByCamp($age_score,$sex,$range,$camp_id,$item_id){
        $query=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->where('clients.age_score','=',$age_score)
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();

        return count($query);
    }

}

if (!function_exists('getClientCountItemDistributionByCriteriaInPercentageByCamp')) {
    function getClientCountItemDistributionByCriteriaInPercentageByCamp($age_score,$sex,$range,$camp_id,$item_id){
        $qsex=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->where('clients.age_score','=',$age_score)
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();

        $qtotal=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();

        if (count($qsex) >0 && count($qsex) >0 ) {
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
if (!function_exists('getClientCountItemDistributionByCriteriaInNumberTotalByCamp')) {
    function getClientCountItemDistributionByCriteriaInNumberTotalByCamp($age_score,$range,$camp_id,$item_id){
        $query=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.age_score','=',$age_score)
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();

        return count($query);
    }

}
if (!function_exists('getClientCountItemDistributionByCriteriaInPercentageTotalByCamp')) {
    function getClientCountItemDistributionByCriteriaInPercentageTotalByCamp($age_score,$range,$camp_id,$item_id){
        $qsex=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.age_score','=',$age_score)
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();

        $qtotal=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
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
if (!function_exists('getClientCountItemDistributionByCriteriaInNumberTotalBySexByCamp')) {
    function getClientCountItemDistributionByCriteriaInNumberTotalBySexByCamp($sex,$range,$camp_id,$item_id){
        $query=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();

        return count($query);
    }

}
if (!function_exists('getClientCountItemDistributionByCriteriaInPercentageTotalBySexByCamp')) {
    function getClientCountItemDistributionByCriteriaInPercentageTotalBySexByCamp($sex,$range,$camp_id,$item_id){
        $qsex=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();

        $qtotal=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
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
if (!function_exists('getClientCountItemDistributionByCriteriaInNumberTotalByAllByCamp')) {
    function getClientCountItemDistributionByCriteriaInNumberTotalByAllByCamp($range,$camp_id,$item_id){
        $query=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->select('clients.*')->get();

        return count($query);
    }

}
if (!function_exists('getClientCountItemDistributionByCriteriaInPercentageTotalByAllByCamp')) {
    function getClientCountItemDistributionByCriteriaInPercentageTotalByAllByCamp($range,$camp_id,$item_id){
        $qsex=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->select('clients.*')->get();

        $qtotal=\DB::table('items_disbursement_items')
            ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();

        if (count($qsex) >0 && count($qsex) > 0) {
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
if (!function_exists('getHighChatItemsDistributionByAgeGroup')) {
    function getHighChatItemsDistributionByAgeGroup($range) {

        $series1="";
        $seriesdata1="";

        $series1 .= "{ ";
        $series1 .= " name: '0 - 17',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('items_disbursement_items')
                ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                ->where('clients.age_score','=','A')
                ->whereBetween('items_disbursement_items.distribution_date', $range)
                ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: '17 - 50 ',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('items_disbursement_items')
                ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                ->where('clients.age_score','=','B')
                ->whereBetween('items_disbursement_items.distribution_date', $range)
                ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: '50-60',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('items_disbursement_items')
                ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                ->where('clients.age_score','=','C')
                ->whereBetween('items_disbursement_items.distribution_date', $range)
                ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: '60 > ',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('items_disbursement_items')
                ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                ->where('clients.age_score','=','D')
                ->whereBetween('items_disbursement_items.distribution_date', $range)
                ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}
if (!function_exists('getHighChatItemsDistributionByAgeGroupByCamp')) {
    function getHighChatItemsDistributionByAgeGroupByCamp($range,$camp_id) {

        $series1="";
        $seriesdata1="";

        $series1 .= "{ ";
        $series1 .= " name: '0 - 17',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('items_disbursement_items')
                ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                ->where('clients.age_score','=','A')
                ->where('clients.camp_id','=',$camp_id)
                ->whereBetween('items_disbursement_items.distribution_date', $range)
                ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: '17 - 50 ',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('items_disbursement_items')
                ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                ->where('clients.age_score','=','B')
                ->where('clients.camp_id','=',$camp_id)
                ->whereBetween('items_disbursement_items.distribution_date', $range)
                ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: '50-60',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('items_disbursement_items')
                ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                ->where('clients.age_score','=','C')
                ->where('clients.camp_id','=',$camp_id)
                ->whereBetween('items_disbursement_items.distribution_date', $range)
                ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: '60 > ',";

        $MonthCount = "";
        $monthData = "";
        $MonthCount .= count(\DB::table('items_disbursement_items')
                ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                ->where('clients.age_score','=','D')
                ->where('clients.camp_id','=',$camp_id)
                ->whereBetween('items_disbursement_items.distribution_date', $range)
                ->select('clients.*')->get()) . ",";
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " y:" . intval($monthData);
        $series1 .= "  },";

        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}

//Cash distributions per vulnerability
if (!function_exists('getHighChatItemsDistributionByVulnerability')) {
    function getHighChatItemsDistributionByVulnerability($range) {

        $series1="";
        $seriesdata1="";
        foreach (\App\PSNCode::where('for_reporting','=','Yes')->get() as $code) {
            $series1 .= "{ ";
            $series1 .= " name: '".$code->code."',";

            $MonthCount = "";
            $monthData = "";
            $MonthCount .= count(\DB::table('items_disbursement_items')
                    ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                    ->join('client_vulnerability_codes', 'clients.id', '=', 'client_vulnerability_codes.client_id')
                    ->where('client_vulnerability_codes.code_id','=',$code->id)
                    ->whereBetween('items_disbursement_items.distribution_date', $range)
                    ->select('clients.*')->get()) . ",";
            $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
            $series1 .= " y:" . intval($monthData);
            $series1 .= "  },";
        }

        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}

if (!function_exists('getHighChatItemsDistributionByVulnerabilityByCamp')) {
    function getHighChatItemsDistributionByVulnerabilityByCamp($range,$camp_id) {

        $series1="";
        $seriesdata1="";
        foreach (\App\PSNCode::where('for_reporting','=','Yes')->get() as $code) {
            $series1 .= "{ ";
            $series1 .= " name: '".$code->code."',";

            $MonthCount = "";
            $monthData = "";
            $MonthCount .= count(\DB::table('items_disbursement_items')
                    ->join('clients', 'items_disbursement_items.client_id', '=', 'clients.id')
                    ->join('client_vulnerability_codes', 'clients.id', '=', 'client_vulnerability_codes.client_id')
                    ->where('client_vulnerability_codes.code_id','=',$code->id)
                    ->where('clients.camp_id','=',$camp_id)
                    ->whereBetween('items_disbursement_items.distribution_date', $range)
                    ->select('clients.*')->get()) . ",";
            $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
            $series1 .= " y:" . intval($monthData);
            $series1 .= "  },";
        }

        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}
