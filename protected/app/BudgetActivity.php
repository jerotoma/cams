<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetActivity extends Model
{
    //
    public function provisions()
    {
        return $this::hasMany('\App\CashProvisionClient','activity_id');
    }
}
