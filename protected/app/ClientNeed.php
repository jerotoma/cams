<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientNeed extends Model
{
    //
    public function need()
    {
        return $this::belongsTo('\App\Need','need_id');
    }
    public function client()
    {
        return $this::belongsTo('\App\Client','client_id');
    }
    public function vulAssessment()
    {
        return $this::belongsTo('\App\VulnerabilityAssessment','assessment_id');
    }
}
