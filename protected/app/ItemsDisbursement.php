<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsDisbursement extends Model
{
    protected $fillable = ['auth_status', 'auth_by', 'auth_date'];
    //
    public function distributions()
    {
        return $this::hasMany('\App\ItemsDisbursementItems','distribution_id','id');
    }
    public function camp()
    {
        return $this::belongsTo('\App\Camp','camp_id');
    }
}
