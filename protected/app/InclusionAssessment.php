<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InclusionAssessment extends Model
{
    //
    public function client(){
        return $this::belongsTo('\App\Client','client_id');
    }
    public function inclusionMedicalHistory(){
        return $this::hasOne('\App\InclusionMedicalHistory','incl_assessment_id');
    }
	public function mpcPartA(){
        return $this::hasOne('\App\MpcPartA','incl_assessment_id');
    }
    public function mpcPartB(){
            return $this::hasOne('App\MpcPartB','incl_assessment_id');
    }
    public function mpcPartC(){
            return $this::hasOne('\App\MpcPartC','incl_assessment_id');
    }
    public function mpcPartD(){
            return $this::hasOne('App\mpcPartD','incl_assessment_id');
    }
    public function mpcPartE(){
            return $this::hasOne('App\MpcPartE','incl_assessment_id');
    }
    public function mpcPartF(){
            return $this::hasOne('App\MpcPartF','incl_assessment_id');
    }
    public function mpcPerformanceArea(){
            return $this::hasOne('App\MpcPerformanceArea','incl_assessment_id');
    }
    public function mpcContext(){
            return $this::hasOne('App\MpcContext','incl_assessment_id');
    }
    public function mpcSwot(){
            return $this::hasOne('App\MpcSwot','incl_assessment_id');
    }
    public function mpcShortRehab(){
            return $this::hasOne('App\MpcShortRehab','incl_assessment_id');
    }
    public function mpcLongRehab(){
            return $this::hasOne('App\MpcLongRehab','incl_assessment_id');
    }
    public function mpcPartARomLower(){
            return $this::hasOne('App\MpcPartARomLower','incl_assessment_id');
    }
    public function mpcPartARomUpper(){
            return $this::hasOne('App\MpcPartARomUpper','incl_assessment_id');
    }

}
