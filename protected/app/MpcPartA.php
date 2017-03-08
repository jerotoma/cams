<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MpcPartA extends Model
{
     public function mpcPartAPosture(){
        return $this::hasOne('\App\MpcPartAPosture','mpc_part_a_id');
    }
    public function mpcPartAMovingPattern(){
        return $this::hasOne('\App\MpcPartAMovingPattern','mpc_part_a_id');
    }
}
