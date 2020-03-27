<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    //
    public function region()
    {
        return $this::belongsTo('\App\Region','region_id');
    }
    public function district()
    {
        return $this::belongsTo('\App\District','district_id');
    }
}
