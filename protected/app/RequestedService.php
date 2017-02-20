<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestedService extends Model
{
    //

    public function referralServiceRequested()
    {
        return $this::belongsTo('\App\ReferralServiceRequested','requested_id');
    }
}
