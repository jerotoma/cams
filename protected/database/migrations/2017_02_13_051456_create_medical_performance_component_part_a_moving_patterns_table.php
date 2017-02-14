<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalPerformanceComponentPartAMovingPatternsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

       Schema::create('medical_performance_component_part_a_moving_patterns', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('mpc_part_a_id')->unsigned();
			       $table->text('mpc_qn_a_42_remark')->nullable();
             $table->string('mpc_qn_a_43')->nullable();
             $table->string('mpc_qn_a_44')->nullable();
             $table->string('mpc_qn_a_45')->nullable();
             $table->string('mpc_qn_a_46')->nullable();
             $table->string('mpc_qn_a_47')->nullable();
             $table->string('mpc_qn_a_48')->nullable();
             $table->string('mpc_qn_a_49')->nullable();
             $table->string('mpc_qn_a_50')->nullable();
             $table->string('mpc_qn_a_51')->nullable();
             $table->string('mpc_qn_a_53_remark')->nullable();
             $table->string('mpc_qn_a_54')->nullable();
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

        Schema::create('medical_performance_component_part_a_moving_patterns', function (Blueprint $table) {
            //
        });
    }
}
