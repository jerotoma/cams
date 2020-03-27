<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsDisbursementItems extends Model
{
    //
    public function item()
    {
        return $this::belongsTo('\App\ItemsInventory','item_id','id');
    }
    public function client()
    {
        return $this::belongsTo('\App\Client','client_id','id');
    }
    public function distribution()
    {
        return $this::belongsTo('\App\ItemsDisbursement','distribution_id','id');
    }
}
