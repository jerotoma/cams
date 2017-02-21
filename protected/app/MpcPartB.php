<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MpcPartB extends Model
{
    public function mpcPartBBodySense(){
        return $this::hasOne('\App\MpcPartBBodySense','mpc_part_b_id');
    }
}
