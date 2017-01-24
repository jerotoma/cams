<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryReceived extends Model
{
    //
    public function item()
    {
        return $this::belongsTo('\App\ItemsInventory','item_id');
    }
}
