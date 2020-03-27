<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhysicalAssessment extends Model
{
    public function takeMeasurement()
    {
        return $this::hasOne('\App\TakeMeasurement','p_assessment_id');
    }
	public function handsimulation()
    {
        return $this::hasOne('\App\Handsimulation','p_assessment_id');
    }
}
