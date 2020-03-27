<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeAssessment extends Model
{
    //
    protected $fillable = ['auth_status', 'auth_by', 'auth_date'];


    public function client()
    {
        return $this::belongsTo('\App\Client','client_id');
    }
}
