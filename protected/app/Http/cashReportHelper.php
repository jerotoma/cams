<?php

///Cash distribution per populations reports
if (!function_exists('getClientCountCashProvisionByCriteriaInNumber')) {
    function getClientCountCashProvisionByCriteriaInNumber($age_score,$sex,$range){
        $query=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->where('clients.age_score','=',$age_score)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*');

        return count($query->get());
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
            ->where('clients.sex','=',$sex)
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
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

        return $percentage;
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInNumberTotalBySex')) {
    function getClientCountCashProvisionByCriteriaInNumberTotalBySex($sex,$range){
        $query=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->where('clients.sex','=',$sex)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

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
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

        return $percentage;
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInNumberTotalByAll')) {
    function getClientCountCashProvisionByCriteriaInNumberTotalByAll($range){
        $query=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();

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
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

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
            ->where('clients.age_score','=',$age_score)
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->select('clients.*')->get();
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

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
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->where('clients.camp_id','=',$camp_id)
            ->select('clients.*')->get();
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

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
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->where('clients.camp_id','=',$camp_id)
            ->select('clients.*')->get();
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

        return $percentage;
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInNumberTotalByAllByCamp')) {
    function getClientCountCashProvisionByCriteriaInNumberTotalByAllByCamp($range,$camp_id){
        $query=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->where('clients.camp_id','=',$camp_id)
            ->select('clients.*')->get();

        return count($query);
    }

}
if (!function_exists('getClientCountCashProvisionByCriteriaInPercentageTotalByAllByCamp')) {
    function getClientCountCashProvisionByCriteriaInPercentageTotalByAllByCamp($range,$camp_id){
        $qsex=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->where('clients.camp_id','=',$camp_id)
            ->select('clients.*')->get();

        $qtotal=\DB::table('cash_provision_clients')
            ->join('clients', 'cash_provision_clients.client_id', '=', 'clients.id')
            ->whereBetween('cash_provision_clients.provision_date', $range)
            ->where('clients.camp_id','=',$camp_id)
            ->select('clients.*')->get();
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

        return $percentage;
    }

}