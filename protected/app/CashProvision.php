<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashProvision extends Model
{
    //
    public function provisions()
    {
        return $this::hasMany('\App\CashProvisionClient','provision_id');
    }
    public function camp()
    {
        return $this::belongsTo('\App\Camp','camp_id');
    }
    public function activity()
    {
        return $this::belongsTo('\App\BudgetActivity','activity_id');
    }
}
