<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InclusionAssesment extends Model
{
    //
    public function client(){
        return $this::belongsTo('\App\Client','client_id');
    }
    public function inclusionMedicalHistory(){
        return $this::hasOne('\App\InclusionMedicalHistory','incl_assessment_id');
    }
	public function medicalPerfomanceComponentPartA(){
        return $this::hasOne('\App\MedicalPerfomanceComponentPartA','incl_assessment_id');
    }
    public function medicalPerfomanceComponentPartB{
            return $this::hasOne('App\MedicalPerfomanceComponentPartB','incl_assessment_id');
    }
    public function medicalPerfomanceComponentPartC(){
            return $this::hasOne('\App\MedicalPerfomanceComponentPartC','incl_assessment_id');
    }
    public function medicalPerfomanceComponentPartD(){
            return $this::hasOne('App\MedicalPerfomanceComponentPartD','incl_assessment_id');
    }
    public function medicalPerfomanceComponentPartE(){
            return $this::hasOne('App\MedicalPerfomanceComponentPartE','incl_assessment_id');
    }
    public function medicalPerfomanceComponentPartF(){
            return $this::hasOne('App\MedicalPerfomanceComponentPartF','incl_assessment_id');
    }
    public function medicalPerfomanceComponentPerformanceArea(){
            return $this::hasOne('App\MedicalPerfomanceComponentPerformanceArea','incl_assessment_id');
    }
    public function medicalPerfomanceComponentContext(){
            return $this::hasOne('App\MedicalPerfomanceComponentContext','incl_assessment_id');
    }
    public function medicalPerfomanceComponentSwot(){
            return $this::hasOne('App\MedicalPerfomanceComponentSwot','incl_assessment_id');
    }
    public function medicalPerfomanceComponentShortRehab(){
            return $this::hasOne('App\MedicalPerfomanceComponentShortRehab','incl_assessment_id');
    }
    public function medicalPerfomanceComponentLongRehab(){
            return $this::hasOne('App\MedicalPerfomanceComponentLongRehab','incl_assessment_id');
    }
    
}
