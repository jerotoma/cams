<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaediatricAssessment extends Model
{
    //
    public function client()
    {
        return $this::belongsTo('\App\Client','client_id');
    }
    public function creator()
    {
        return $this::belongsTo('\App\User','created_by');
    }
    public function updatedBy()
    {
        return $this::belongsTo('\App\User','updated_by');
    }
    public function reviewer()
    {
        return $this::belongsTo('\App\User','reviewed_by');
    }
    public function assessmentHistory()
    {
        return $this::hasOne('\App\PaediatricAssessmentHistory','assessment_id');
    }
    public function childHistory()
    {
        return $this::hasOne('\App\PaediatricChildHistory','assessment_id');
    }
    public function childGrowth()
    {
        return $this::hasOne('\App\PaediatricChildGrowth','assessment_id');
    }
    public function childInspection()
    {
        return $this::hasMany('\App\PaediatricChildInspection','assessment_id');
    }
    public function childInspectionResult()
    {
        return $this::hasOne('\App\PaediatricChildInspectionResult','assessment_id');
    }
    public function country()
    {
        return $this::belongsTo('\App\Country','nationality','id');
    }
}
