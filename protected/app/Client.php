<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = ['auth_status', 'auth_by', 'auth_date'];

    public function fromOrigin()
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
    public function homeAssessment()
    {
        return $this::hasOne('\App\HomeAssessment','client_id');
    }
    public function referrals()
    {
        return $this::hasMany('\App\ClientReferral','client_id');
    }
    public function cases()
    {
        return $this::hasMany('\App\ClientCase','client_id');
    }
    public function notes()
    {
        return $this::hasMany('\App\ProgressNote','client_id');
    }
    public function cashProvisions()
    {
        return $this::hasMany('\App\CashProvisionClient','client_id');
    }
    public function itemsDistributions()
    {
        return $this::hasMany('\App\ItemsDisbursementItems','client_id');
    }
    public function wheelChairAssessment()
    {
        return $this::hasMany('\App\WheelChairAssessment','client_id');
    }
    public function clientNeeds()
    {
        return $this::hasMany('\App\ClientNeed','client_id');
    }

}
