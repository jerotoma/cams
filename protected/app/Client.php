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
}
