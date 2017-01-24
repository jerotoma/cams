<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriaSupport extends Model
{
    //
    public function beneficiary()
    {
        return $this::belongsTo('\App\Beneficiary','beneficiary_id');
    }
    public function item()
    {
        return $this::belongsTo('\App\ItemsInventory','item_id');
    }
    public function items()
    {
        return $this::hasMany('\App\MaterialSuportItems','support_id');
    }
}
