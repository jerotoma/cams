<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryReceived extends Model
{
    //
    public function items()
    {
        return $this::hasMany('\App\ItemReceived','received_id');
    }
}
