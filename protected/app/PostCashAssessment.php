<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCashAssessment extends Model
{
    //
    protected $fillable = ['auth_status', 'auth_by', 'auth_date'];

    public function client()
    {
        return $this::belongsTo('\App\Client','client_id');
    }
    public function district()
    {
        return $this::belongsTo('\App\District','district_id');
    }
    public function camp()
    {
        return $this::belongsTo('\App\Camp','camp_id');
    }
    public function demographicDetails()
    {
        return $this::hasOne('\App\PCDemographicDetails','assessment_id');
    }
    public function cashWithdrawal()
    {
        return $this::hasOne('\App\PCCashWithdrawal','assessment_id');
    }
    public function physicallyReceivingCash()
    {
        return $this::hasOne('\App\PCPhysicallyReceivingCash','assessment_id');
    }
    public function communalRelations()
    {
        return $this::hasOne('\App\PCCommunalRelations','assessment_id');
    }
    public function cashUsage()
    {
        return $this::hasOne('\App\PCCashUsage','assessment_id');
    }
}
