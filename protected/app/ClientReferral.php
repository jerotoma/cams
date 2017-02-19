<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientReferral extends Model
{
    //
    public function client()
    {
        return $this::belongsTo('\App\Client','client_id');
    }
    public function receivingAgency()
    {
        return $this::hasOne('\App\ReceivingAgency','referral_id');
    }
    public function clientInformation()
    {
        return $this::hasOne('\App\ClientInformation','referral_id');
    }
    public function referralReason()
    {
        return $this::hasOne('\App\Client','referral_id');
    }
    public function referralServiceRequested()
    {
        return $this::hasOne('\App\ReferralServiceRequested','referral_id');
    }
}
