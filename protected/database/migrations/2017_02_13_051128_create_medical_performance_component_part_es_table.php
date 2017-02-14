<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalPerformanceComponentPartEsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_performance_component_part_es', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('incl_assessment_id')->unsigned();
             $table->string('mpc_qn_e_1')->nullable();
             $table->string('mpc_qn_e_2')->nullable();
             $table->string('mpc_qn_e_3')->nullable();
             $table->string('mpc_qn_e_4')->nullable();
             $table->string('mpc_qn_e_5')->nullable();
             $table->string('mpc_qn_e_6')->nullable();
             $table->string('mpc_qn_e_7')->nullable();
             $table->text('mpc_qn_e_8')->nullable();
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
        Schema::create('medical_performance_component_part_es', function (Blueprint $table) {
            //
        });
    }
}
