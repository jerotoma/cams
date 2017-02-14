<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalPerfomanceComponentPartA extends Model
{
     public function medicalPerfomanceComponentPartAPosture(){
        return $this::hasOne('\App\MedicalPerfomanceComponentPartAPosture','mpc_part_a_id');
    }
    public function medicalPerfomanceComponentPartAMovingPattern(){
        return $this::hasOne('\App\MedicalPerfomanceComponentPartAMovingPattern','mpc_part_a_id');
    }
}
