<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientCase extends Model
{
    //
    public function client()
    {
        return $this::belongsTo('\App\Client','client_id');
    }
    public function camp()
    {
        return $this::belongsTo('\App\Camp','camp_id');
    }
    public function creator()
    {
        return $this::belongsTo('\App\User','created_by');
    }
    public function updatedBy()
    {
        return $this::belongsTo('\App\User','updated_by');
    }
    public function reviewer()
    {
        return $this::belongsTo('\App\User','reviewed_by');
    }
}
