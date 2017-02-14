<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalPerformanceComponentPartDsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('medical_performance_component_part_ds', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('incl_assessment_id')->unsigned();
             $table->text('mpc_qn_d_1')->nullable();
             $table->text('mpc_qn_d_2')->nullable();
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
        Schema::create('medical_performance_component_part_ds', function (Blueprint $table) {
            //
        });
    }
}
