<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NeedCategory extends Model
{
    //
    public function needs()
    {
        return $this::hasMany('\App\Need','category_id');
    }
}
