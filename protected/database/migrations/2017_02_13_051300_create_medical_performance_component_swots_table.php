<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalPerformanceComponentSwotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('medical_performance_component_swots', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('incl_assessment_id')->unsigned();
             $table->text('mpc_swot_1_remark')->nullable();
             $table->text('mpc_swot_2_remark')->nullable();
             $table->text('mpc_swot_3_remark')->nullable();
             $table->text('mpc_swot_4_remark')->nullable();
             $table->text('mpc_swot_5_remark')->nullable();
             $table->text('mpc_swot_6_remark')->nullable();
             $table->text('mpc_swot_7_remark')->nullable();
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
       Schema::table('medical_performance_component_swots', function (Blueprint $table) {
            //
        });
    }
}
