<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInclusionMedicalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inclusion_medical_histories', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('incl_assessment_id')->unsigned();
             $table->text('med_history_info_qn_1')->nullable();
             $table->text('med_history_info_qn_2')->nullable();
             $table->string('med_history_info_qn_3')->nullable();
             $table->string('med_history_info_qn_4')->nullable();
             $table->string('med_history_info_qn_4_remark')->nullable();
             $table->string('med_history_info_qn_5')->nullable();
             $table->string('med_history_info_qn_6')->nullable();
             $table->string('med_history_info_qn_6_remark')->nullable();
             $table->string('med_history_info_qn_7')->nullable();
             $table->string('med_history_info_qn_7_remark')->nullable();
             $table->string('med_history_info_qn_8')->nullable();
             $table->string('med_history_info_qn_8_remark')->nullable();
             $table->string('med_history_info_qn_9')->nullable();
             $table->string('med_history_info_qn_9_remark')->nullable();
             $table->string('med_history_info_qn_10')->nullable();
             $table->string('med_history_info_qn_10_remark')->nullable();
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
        Schema::table('inclusion_medical_histories', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('incl_assessment_id')->unsigned();
             $table->text('med_history_info_qn_1')->nullable();
             $table->text('med_history_info_qn_2')->nullable();
             $table->string('med_history_info_qn_3')->nullable();
             $table->string('med_history_info_qn_4')->nullable();
             $table->string('med_history_info_qn_4_remark')->nullable();
             $table->string('med_history_info_qn_5')->nullable();
             $table->string('med_history_info_qn_6')->nullable();
             $table->string('med_history_info_qn_6_remark')->nullable();
             $table->string('med_history_info_qn_7')->nullable();
             $table->string('med_history_info_qn_7_remark')->nullable();
             $table->string('med_history_info_qn_8')->nullable();
             $table->string('med_history_info_qn_8_remark')->nullable();
             $table->string('med_history_info_qn_9')->nullable();
             $table->string('med_history_info_qn_9_remark')->nullable();
             $table->string('med_history_info_qn_10')->nullable();
             $table->string('med_history_info_qn_10_remark')->nullable();
             $table->timestamps();
             $table->foreign('incl_assessment_id')->references('id')->on('inclusion_assessments')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }
}
