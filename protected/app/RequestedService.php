<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestedService extends Model
{
    //

    public function services()
    {
        return $this::hasOne('\App\RequestedService','referral_id');
    }
}
