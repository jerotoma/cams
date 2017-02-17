<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    public function origin()
    {
        return $this::belongsTo('\App\Origin','origin_id');
    }
    public function nationality()
    {
        return $this::belongsTo('\App\Country','country_id');
    }
    public function camp()
    {
        return $this::belongsTo('\App\Camp','camp_id');
    }
    public function vulnerability()
    {
        return $this::hasOne('\App\ClientVulnerabilityCode','client_id');
    }
    public function vulnerabilityCodes()
    {
        return $this::hasMany('\App\ClientVulnerabilityCode','client_id');
    }
    public function vulAssessment()
    {
        return $this::hasOne('\App\VulnerabilityAssessment','client_id');
    }
    public function pdlAssessment()
    {
        return $this::hasOne('\App\PaediatricAssessment','client_id');
    }
    public function needs()
    {
        return $this::hasOne('\App\HomeAssessment','client_id');
    }
    public function referrals()
    {
        return $this::hasMany('\App\Referral','client_id');
    }
    public function wheelChairAssessment()
    {
        return $this::hasMany('\App\WheelChairAssessment','client_id');
    }

}
