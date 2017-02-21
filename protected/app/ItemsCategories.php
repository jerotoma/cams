<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsCategories extends Model
{
    //
    public function items()
    {
        return $this::hasMany('\App\ItemsInventory','category_id','id');
    }
}
