<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PCCashUsage extends Model
{
    //

    public function usages()
    {
        return $this::hasMany('\App\PCCashUsageCategory ','usage_id','id');
    }
}
