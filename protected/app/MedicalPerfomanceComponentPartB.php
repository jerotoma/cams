<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalPerfomanceComponentPartB extends Model
{
    public function medicalPerfomanceComponentPartBBodySense(){
        return $this::hasOne('\App\MedicalPerfomanceComponentPartBBodySenses','mpc_part_b_id');
    }
}
