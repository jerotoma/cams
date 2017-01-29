<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
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
        return $this::belongsTo('\App\ClientVulnerabilityCode','client_id');
    }
    public function vulAssessment()
    {
        return $this::hasOne('\App\VulnerabilityAssessment','client_id');
    }

}
