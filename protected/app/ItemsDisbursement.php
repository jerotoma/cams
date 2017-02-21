<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsDisbursement extends Model
{
    //
    public function distributions()
    {
        return $this::hasMany('\App\ItemsDisbursementItems','distribution_id','id');
    }
}
