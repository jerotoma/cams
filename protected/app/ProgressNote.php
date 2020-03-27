<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgressNote extends Model
{
    //
    protected $fillable = ['auth_status', 'auth_by', 'auth_date'];

    public function client()
    {
        return $this::belongsTo('\App\Client','client_id');
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
    public function camp()
    {
        return $this::belongsTo('\App\Camp','camp_id');
    }
}
