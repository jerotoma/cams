<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    public function parent() {
        return $this::belongsTo('\App\Department','parent_id');
    }

    public function department() {
        return $this->hasOne('\App\Department');
    }
}
