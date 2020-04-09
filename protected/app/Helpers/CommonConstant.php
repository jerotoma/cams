<?php
namespace App\Helpers;

class CommonConstant {

    public const AGE_GROUPS = [
        'A' => '0 - 17',
        'B' => '18 - 49',
        'C' => '50 - 59',
        'D' => '60 and Above'
    ];

    public const CASE_STATUSES = [
        'openCase' => 'Open Case',
        'assessment' => 'Assessment',
        'casePlanning' => 'Case Planning',
        'caseFollowup' => 'Case Followup',
        'caseClosed' => 'Case Closed'
    ];

    public const MONTHS = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December'
    ];

    public function getAgeScore($age){
        if($age <=17 ){
            return "A";
        }
        else if($age >17 && $age < 50){
            return "B";
        }
        else if($age >=50 && $age < 60){
            return "C";
        }
        else if($age >= 60 ){
            return "D";
        }
    }
}
