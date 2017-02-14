<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalPerformanceComponentLongRehabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_performance_component_long_rehabs', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('incl_assessment_id')->unsigned();
             $table->text('mpc_long_rehab_1_remark')->nullable();
             $table->text('mpc_long_rehab_2_remark')->nullable();
             $table->text('mpc_long_rehab_3_remark')->nullable();
             $table->text('mpc_long_rehab_4_remark')->nullable();
             $table->text('mpc_long_rehab_5_remark')->nullable();
             $table->text('mpc_long_rehab_6_remark')->nullable();
             $table->text('mpc_long_rehab_7_remark')->nullable();
             $table->text('mpc_long_rehab_8_remark')->nullable();
             $table->text('mpc_long_rehab_9_remark')->nullable();
             $table->timestamps();
             $table->foreign('incl_assessment_id')->references('id')->on('inclusion_assessments')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }
   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::create('medical_performance_component_long_rehabs', function (Blueprint $table) {
            //
        });
    }
}
