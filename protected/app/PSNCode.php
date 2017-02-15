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

    public function category()
    {
        return $this::belongsTo('\App\PSNCodeCategory','category_id');
    }
}
