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
            ->where('clients.sex','=',$sex)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

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
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->select('clients.*')->get();
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

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
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->select('clients.*')->get();
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

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
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

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
            ->where('clients.age_score','=',$age_score)
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->select('clients.*')->get();
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

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
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->select('clients.*')->get();
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

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
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->select('clients.*')->get();
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

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
            ->whereBetween('items_disbursement_items.distribution_date', $range)
            ->where('clients.camp_id','=',$camp_id)
            ->where('items_disbursement_items.item_id','=',$item_id)
            ->select('clients.*')->get();
        $calcper=(intval(count($qsex))/intval(count($qtotal))) * 100 ;

        $percentage=number_format($calcper,2) ."%";

        return $percentage;
    }

}
