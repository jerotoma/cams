<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalPerformanceComponentPerformanceAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_performance_component_performance_areas', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('incl_assessment_id')->unsigned();
             $table->text('mpc_perf_area_1')->nullable();
             $table->text('mpc_perf_area_2')->nullable();
             $table->text('mpc_perf_area_3')->nullable();
             $table->text('mpc_perf_area_4_remark')->nullable();
             $table->text('mpc_perf_area_5_remark')->nullable();
             $table->text('mpc_perf_area_6')->nullable();
             $table->text('mpc_perf_area_7')->nullable();
             $table->text('mpc_perf_area_8')->nullable();
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
        Schema::table('medical_performance_component_performance_areas', function (Blueprint $table) {
            //
        });
    }
}
