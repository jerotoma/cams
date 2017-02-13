<?php
if (!function_exists('getHighChatMonthlyCasesCountByStatus')) {
    function getHighChatMonthlyCasesCountByStatus($status,$year) {
        $MonthCount="";
        $monthData="";
        for($i=1; $i<= 12; $i++)
        {
            $MonthCount.=count(\App\ClientCase::where('status','=',$status)->where(\DB::raw('Month(open_date)'),'=',$i)->where(\DB::raw('Year(open_date)'),'=',$year)->get()).",";
        }
        $monthData.=substr($MonthCount,0,strlen($MonthCount)-1);
        return $monthData;
    }
}
if (!function_exists('getHighChatCasesCountByStatus')) {
    function getHighChatCasesCountByStatus($status) {

        return count(\App\ClientCase::where('status','=',$status)->get());
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
if (!function_exists('getHighChatClientMonthlyCountByYear')) {
    function getHighChatClientMonthlyCountByYear($year) {

        $series1="";
        $seriesdata1="";
        foreach (\App\Country::all() as $country) {
            $series1 .= "{ ";
            $series1 .= " name: '".$country->country_name."',";

            $MonthCount = "";
            $monthData = "";
            for ($i = 1; $i <= 12; $i++) {
                $MonthCount .= count(\App\Client::where('country_id','=',$country->id)->where(\DB::raw('Month(date_arrival)'), '=', $i)->where(\DB::raw('Year(date_arrival)'), '=', $year)->get()) . ",";
            }
            $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
            $series1 .= " data:[" . $monthData . "]";
            $series1 .= "  },";
        }

        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}
if (!function_exists('getHighChatClientMonthlyCountByNationality')) {
    function getHighChatClientMonthlyCountByNationality() {

        $series1="";
        $seriesdata1="";
        foreach (\App\Country::all() as $country) {
            $series1 .= "{ ";
            $series1 .= " name: '".$country->country_name."',";

            $MonthCount = "";
            $monthData = "";
            $MonthCount .= count(\App\Client::where('country_id','=',$country->id)->get()) . ",";
            $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
            $series1 .= " y:" . intval($monthData);
            $series1 .= "  },";
        }

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
            $MonthCount.=count(\App\ItemsDisbursement::where(\DB::raw('Month(disbursements_date)'),'=',$i)->where(\DB::raw('Year(disbursements_date)'),'=',$year)->get()).",";
        }
        $monthData.=substr($MonthCount,0,strlen($MonthCount)-1);
        return $monthData;
    }
}