<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemReceived extends Model
{
    //
    public function received()
    {
        return $this::belongsTo('\App\InventoryReceived','received_id');
    }
    public function item()
    {
        return $this::belongsTo('\App\ItemsInventory','item_id');
    }
}
