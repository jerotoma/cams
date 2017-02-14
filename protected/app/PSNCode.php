<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PSNCode extends Model
{
    //
    public function clientsCodes()
    {
        return $this::hasMany('\App\ClientVulnerabilityCode','code_id','id');
    }
}
