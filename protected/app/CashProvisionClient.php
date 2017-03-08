<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashProvisionClient extends Model
{
    //
    public function client()
    {
        return $this::belongsTo('\App\Client','client_id');
    }
    public function activity()
    {
        return $this::belongsTo('\App\BudgetActivity','activity_id');
    }
    public function provision()
    {
        return $this::belongsTo('\App\CashProvision','provision_id');
    }
}
