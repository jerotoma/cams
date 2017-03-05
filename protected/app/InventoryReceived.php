<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryReceived extends Model
{
    //
    protected $fillable = ['auth_status', 'auth_by', 'auth_date'];

    public function items()
    {
        return $this::hasMany('\App\ItemReceived','received_id');
    }
}
