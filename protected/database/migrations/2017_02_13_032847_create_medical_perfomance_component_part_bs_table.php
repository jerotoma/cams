<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalPerfomanceComponentPartBsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_performance_component_part_bs', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('incl_assessment_id')->unsigned();
             $table->text('med_performance_comp_qn_b_1')->nullable();
             $table->text('med_performance_comp_qn_b_1_remark')->nullable();
             $table->text('med_performance_comp_qn_b_2')->nullable();
             $table->text('med_performance_comp_qn_b_2_remark')->nullable();
             $table->text('med_performance_comp_qn_b_3_remark')->nullable();
             $table->text('med_performance_comp_qn_b_4')->nullable();
             $table->string('med_performance_comp_qn_b_5')->nullable();
             $table->string('med_performance_comp_qn_b_6')->nullable();
             $table->string('med_performance_comp_qn_b_7')->nullable();
             $table->string('med_performance_comp_qn_b_8')->nullable();
             $table->string('med_performance_comp_qn_b_9')->nullable();
             $table->string('med_performance_comp_qn_b_10')->nullable();
             $table->string('med_performance_comp_qn_b_11')->nullable();
             $table->string('med_performance_comp_qn_b_12')->nullable();
             $table->string('med_performance_comp_qn_b_13')->nullable();
             $table->string('med_performance_comp_qn_b_14')->nullable();
             $table->string('med_performance_comp_qn_b_15')->nullable();
             $table->string('med_performance_comp_qn_b_16')->nullable();
             $table->string('med_performance_comp_qn_b_17')->nullable();
             $table->string('med_performance_comp_qn_b_18')->nullable();
             $table->string('med_performance_comp_qn_b_19')->nullable();
             $table->string('med_performance_comp_qn_b_20')->nullable();
             $table->string('med_performance_comp_qn_b_21')->nullable();
             $table->string('med_performance_comp_qn_b_22')->nullable();
             $table->string('med_performance_comp_qn_b_23')->nullable();
             $table->string('med_performance_comp_qn_b_24')->nullable();
             $table->string('med_performance_comp_qn_b_25')->nullable();
             $table->string('med_performance_comp_qn_b_26')->nullable();
             $table->text('med_performance_comp_qn_b_27_remak')->nullable();
             $table->text('med_performance_comp_qn_b_28')->nullable();
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
        Schema::table('medical_performance_component_part_bs', function (Blueprint $table) {
            //
        });
    }
}
