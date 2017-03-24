<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralServiceRequested extends Model
{
    //
    public function services()
    {
        return $this::hasMany('\App\RequestedService','requested_id');
    }
}
