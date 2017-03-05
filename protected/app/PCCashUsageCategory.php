<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PCCashUsageCategory extends Model
{
    //
    public function usage()
    {
        return $this::belongsTo('\App\PCCashUsage','usage_id','id');
    }
    public function category()
    {
        return $this::belongsTo('\App\PCCategories','category_id');
    }
}
