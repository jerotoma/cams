<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WheelChairAssessment extends Model
{
    //
    public function client()
    {
        return $this::belongsTo('\App\Client','client_id');
    }
    public function physicalAssessment()
    {
        return $this::hasOne('\App\PhysicalAssessment','wc_assessment_id');
    }
	public function assessmentInterview()
    {
        return $this::hasOne('\App\AssessmentInterview','wc_assessment_id');
    }
    
}
