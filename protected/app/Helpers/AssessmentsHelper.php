<?php
if (!function_exists('getHighAssessmentsMonthlyCountByYear')) {
    function getHighAssessmentsMonthlyCountByYear($year) {

        $series1="";
        $seriesdata1="";

        $series1 .= "{ ";
        $series1 .= " name: 'Male ( 0 - 17)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=count(\DB::table('vulnerability_assessments')
                    ->join('clients', 'vulnerability_assessments.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','A')
                    ->where('clients.sex','=','Male')
                    ->where(\DB::raw('Month(q1_5)'), '=', $i)
                    ->where(\DB::raw('Year(q1_5)'), '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Female ( 0 - 17)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=count(\DB::table('vulnerability_assessments')
                    ->join('clients', 'vulnerability_assessments.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','A')
                    ->where('clients.sex','=','Female')
                    ->where(\DB::raw('Month(q1_5)'), '=', $i)
                    ->where(\DB::raw('Year(q1_5)'), '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Male (17 - 50)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=count(\DB::table('vulnerability_assessments')
                    ->join('clients', 'vulnerability_assessments.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','B')
                    ->where('clients.sex','=','Male')
                    ->where(\DB::raw('Month(q1_5)'), '=', $i)
                    ->where(\DB::raw('Year(q1_5)'), '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Female (17 - 50)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=count(\DB::table('vulnerability_assessments')
                    ->join('clients', 'vulnerability_assessments.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','B')
                    ->where('clients.sex','=','Female')
                    ->where(\DB::raw('Month(q1_5)'), '=', $i)
                    ->where(\DB::raw('Year(q1_5)'), '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Male (50 - 60)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=count(\DB::table('vulnerability_assessments')
                    ->join('clients', 'vulnerability_assessments.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','C')
                    ->where('clients.sex','=','Male')
                    ->where(\DB::raw('Month(q1_5)'), '=', $i)
                    ->where(\DB::raw('Year(q1_5)'), '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Female (50 - 60)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=count(\DB::table('vulnerability_assessments')
                    ->join('clients', 'vulnerability_assessments.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','C')
                    ->where('clients.sex','=','Female')
                    ->where(\DB::raw('Month(q1_5)'), '=', $i)
                    ->where(\DB::raw('Year(q1_5)'), '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";

        $series1 .= "{ ";
        $series1 .= " name: 'Male (60 >)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=count(\DB::table('vulnerability_assessments')
                    ->join('clients', 'vulnerability_assessments.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','D')
                    ->where('clients.sex','=','Male')
                    ->where(\DB::raw('Month(q1_5)'), '=', $i)
                    ->where(\DB::raw('Year(q1_5)'), '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";
        $series1 .= "{ ";
        $series1 .= " name: 'Female (60 >)',";

        $MonthCount = "";
        $monthData = "";
        for ($i = 1; $i <= 12; $i++) {
            $MonthCount .=count(\DB::table('vulnerability_assessments')
                    ->join('clients', 'vulnerability_assessments.client_id', '=', 'clients.id')
                    ->where('clients.age_score','=','D')
                    ->where('clients.sex','=','Female')
                    ->where(\DB::raw('Month(q1_5)'), '=', $i)
                    ->where(\DB::raw('Year(q1_5)'), '=', $year)->get()) . ",";
        }
        $monthData .= substr($MonthCount, 0, strlen($MonthCount) - 1);
        $series1 .= " data:[" . $monthData . "]";
        $series1 .= "  },";



        $seriesdata1=substr($series1,0,strlen($series1)-1);
        return $seriesdata1;
    }
}


if (!function_exists('getClientAssessmentNeedsAll')) {
    function getClientAssessmentNeedsAll($clients_needs,$sex,$score,$range) {
            $data = count(\DB::table('vulnerability_assessments')
                ->join('client_needs', 'vulnerability_assessments.id', '=', 'client_needs.assessment_id')
                ->where('need_id', '=', $clients_needs)
                ->where('client_needs.status', '=', "Yes")
                ->join('clients', 'vulnerability_assessments.client_id', '=', 'clients.id')
                ->where('clients.sex', '=', $sex)
                ->where('clients.age_score', '=', $score)
                ->whereBetween('vulnerability_assessments.q1_5', $range)->get());

        return $data;
    }
}

if (!function_exists('getClientAssessmentNeedsTotalAll')) {
    function getClientAssessmentNeedsTotalAll($clients_needs,$range) {
        $data = count(\DB::table('vulnerability_assessments')
            ->join('client_needs', 'vulnerability_assessments.id', '=', 'client_needs.assessment_id')
            ->where('need_id', '=', $clients_needs)
            ->where('client_needs.status', '=', "Yes")
            ->join('clients', 'vulnerability_assessments.client_id', '=', 'clients.id')
            ->whereBetween('vulnerability_assessments.q1_5', $range)->get());

        return $data;
    }
}

if (!function_exists('getClientAssessmentNeedsAllByCamp')) {
    function getClientAssessmentNeedsAllByCamp($clients_needs,$sex,$score,$camp_id,$range) {
        $data = count(\DB::table('vulnerability_assessments')
            ->join('client_needs', 'vulnerability_assessments.id', '=', 'client_needs.assessment_id')
            ->where('need_id', '=', $clients_needs)
            ->where('client_needs.status', '=', "Yes")
            ->join('clients', 'vulnerability_assessments.client_id', '=', 'clients.id')
            ->where('clients.sex', '=', $sex)
            ->where('clients.age_score', '=', $score)
            ->where('vulnerability_assessments.q1_3', '=', $camp_id)
            ->whereBetween('vulnerability_assessments.q1_5', $range)->get());

        return $data;
    }
}

if (!function_exists('getClientAssessmentNeedsAllByCampTotal')) {
    function getClientAssessmentNeedsAllByCampTotal($clients_needs,$range,$camp_id) {
        $data = count(\DB::table('vulnerability_assessments')
            ->join('client_needs', 'vulnerability_assessments.id', '=', 'client_needs.assessment_id')
            ->where('need_id', '=', $clients_needs)
            ->where('client_needs.status', '=', "Yes")
            ->join('clients', 'vulnerability_assessments.client_id', '=', 'clients.id')
            ->where('vulnerability_assessments.q1_3', '=', $camp_id)
            ->whereBetween('vulnerability_assessments.q1_5', $range)->get());

        return $data;
    }
}