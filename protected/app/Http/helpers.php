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
if (!function_exists('getHighChatClientByCodes')) {
    function getHighChatClientByCodes() {

        $series1="";
        $seriesdata1="";
        foreach (\App\PSNCode::where('for_reporting','=','Yes')->get() as $code) {
            $series1 .= "{ ";
            $series1 .= " name: '".$code->description."',";

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
        $data = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
            ->where('client_vulnerability_codes.code_id','=',$id)
            ->where('clients.camp_id','=',$camp_id)
            ->where('clients.age_score','=',$score)
            ->whereBetween('clients.date_arrival', $range)->get());

        return $data;
    }
}
if (!function_exists('getClientsSumCountByCreteriaAgeScore')) {
    function getClientsSumCountByCreteriaAgeScore($id,$camp_id,$range) {
        $data = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
            ->where('client_vulnerability_codes.code_id','=',$id)
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('clients.date_arrival', $range)->get());

        return $data;
    }
}
if (!function_exists('getClientsCountByCreteria')) {
    function getClientsCountByCreteria($id,$sex,$score,$camp_id,$range) {
        $data = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
            ->where('client_vulnerability_codes.code_id','=',$id)
            ->where('clients.camp_id','=',$camp_id)
            ->where('clients.sex','=',$sex)
            ->where('clients.age_score','=',$score)
            ->whereBetween('clients.date_arrival', $range)->get());

        return $data;
    }
}
if (!function_exists('getClientsSumCountByCreteria')) {
    function getClientsSumCountByCreteria($id,$sex,$camp_id,$range) {
        $data = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
            ->where('client_vulnerability_codes.code_id','=',$id)
            ->where('clients.camp_id','=',$camp_id)
            ->where('clients.sex','=',$sex)
            ->whereBetween('clients.date_arrival', $range)->get());

        return $data;
    }
}
if (!function_exists('getClientsCountPercentageByCreteria')) {
    function getClientsCountPercentageByCreteria($id,$sex,$score,$camp_id,$range) {
        $sexcount = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
            ->where('client_vulnerability_codes.code_id','=',$id)
            ->where('clients.camp_id','=',$camp_id)
            ->where('clients.sex','=',$sex)
            ->where('clients.age_score','=',$score)
            ->whereBetween('clients.date_arrival', $range)->get());

        $total=count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
            ->where('client_vulnerability_codes.code_id','=',$id)
            ->where('clients.camp_id','=',$camp_id)
            ->where('clients.age_score','=',$score)
            ->whereBetween('clients.date_arrival', $range)->get());

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
        $sexcount = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
            ->where('client_vulnerability_codes.code_id','=',$id)
            ->where('clients.camp_id','=',$camp_id)
            ->where('clients.sex','=',$sex)
            ->whereBetween('clients.date_arrival', $range)->get());

        $total=count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
            ->where('client_vulnerability_codes.code_id','=',$id)
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('clients.date_arrival', $range)->get());

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
        $sexcount = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
            ->where('client_vulnerability_codes.code_id','=',$id)
            ->where('clients.camp_id','=',$camp_id)
            ->where('clients.age_score','=',$score)
            ->whereBetween('clients.date_arrival', $range)->get());

        $total=count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
            ->where('client_vulnerability_codes.code_id','=',$id)
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('clients.date_arrival', $range)->get());

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
        $sexcount = count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
            ->where('client_vulnerability_codes.code_id','=',$id)
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('clients.date_arrival', $range)->get());

        $total=count(\DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
            ->where('client_vulnerability_codes.code_id','=',$id)
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('clients.date_arrival', $range)->get());

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

        $data = \DB::table('client_vulnerability_codes')->leftjoin('clients','client_vulnerability_codes.client_id','=','clients.id')
            ->where('client_vulnerability_codes.code_id','=',$id)
            ->where('clients.camp_id','=',$camp_id)
            ->whereBetween('clients.date_arrival', $range)->get();

        return count($data);
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

if (!function_exists('getClientNumberBySex')) {
    function getClientNumberBySex($sex) {
        return count(\App\Client::where('sex','=',ucwords(strtolower($sex)))->get());
    }
}
if (!function_exists('getClientNumberBySexByCamp')) {
    function getClientNumberBySexByCamp($sex,$camp_id,$range) {
        return count(\App\Client::whereBetween('date_arrival', $range)->where('camp_id','=',$camp_id)->where('sex','=',ucwords(strtolower($sex)))->get());
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
        return count(\App\Client::whereBetween('date_arrival', $range)->where('camp_id','=',$camp_id)->where('sex','=',ucwords(strtolower($sex)))->where('age_score','=',$score)->get());
    }
}
if (!function_exists('getClientNumberByAgeScore')) {
    function getClientNumberByAgeScore($score) {
        return count(\App\Client::where('age_score','=',$score)->get());
    }
}
if (!function_exists('getClientNumberByAgeScoreByCamp')) {
    function getClientNumberByAgeScoreByCamp($score,$camp_id,$range) {
        return count(\App\Client::whereBetween('date_arrival', $range)->where('camp_id','=',$camp_id)->where('age_score','=',$score)->get());
    }
}
if (!function_exists('getAllClientsNumber')) {
    function getAllClientsNumber() {
        return count(\App\Client::all());
    }
}
if (!function_exists('getAllClientsNumberByCamp')) {
    function getAllClientsNumberByCamp($camp_id,$range) {
        return count(\App\Client::whereBetween('date_arrival', $range)->where('camp_id','=',$camp_id)->get());
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
        $sexcount= count(\App\Client::whereBetween('date_arrival', $range)->where('camp_id','=',$camp_id)->where('age_score','=',$score)->get());
        $total=count(\App\Client::whereBetween('date_arrival', $range)->where('camp_id','=',$camp_id)->get());
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