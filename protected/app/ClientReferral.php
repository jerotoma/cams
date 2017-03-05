<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientReferral extends Model
{
    //
    protected $fillable = ['auth_status', 'auth_by', 'auth_date'];
    public function client()
    {
        return $this::belongsTo('\App\Client','client_id','id');
    }
    public function receivingAgency()
    {
        return $this::hasOne('\App\ReceivingAgency','referral_id');
    }
    public function referringAgency()
    {
        return $this::hasOne('\App\ReferringAgency','referral_id');
    }
    public function clientInformation()
    {
        return $this::hasOne('\App\ClientInformation','referral_id');
    }
    public function referralReason()
    {
        return $this::hasOne('\App\ReferralReason','referral_id');
    }
    public function referralServiceRequested()
    {
        return $this::hasOne('\App\ReferralServiceRequested','referral_id');
    }
}
