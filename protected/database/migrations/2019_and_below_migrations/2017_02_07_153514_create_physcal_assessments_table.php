<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhyscalAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physical_assessments', function (Blueprint $table) {
               $table->increments('id');
			   $table->integer('wc_assessment_id')->unsigned();
               $table->string('physical_assess_presence_risk_qn_1')->nullable();
			   $table->string('physical_assess_presence_risk_qn_2' )->nullable();
			   $table->string('physical_assess_presence_risk_qn_3' )->nullable();
			   $table->string('physical_assess_presence_risk_qn_4' )->nullable();
			   $table->string('physical_assess_presence_risk_qn_5' )->nullable();
			   $table->string('physical_assess_presence_risk_qn_6' )->nullable();
			   $table->string('physical_assess_method_of_pushing_qn_1' )->nullable();
			   $table->string('physical_assess_method_of_pushing_qn_2' )->nullable();
			   $table->text('physical_assess_method_of_pushing_qn_2_describe')->nullable();
			   $table->string('physical_assess_sitting_posture_without_support_qn_1')->nullable();
			   $table->string('physical_assess_pelvis_hip_posture_screen_qn_1' )->nullable();
			   $table->string('physical_assess_pelvis_hip_posture_screen_qn_2' )->nullable();
			   $table->text('physical_assess_pelvis_hip_posture_screen_qn_2_angle')->nullable();
			   $table->string('physical_assess_pelvis_hip_posture_screen_qn_3' )->nullable();
			   $table->text('physical_assess_pelvis_hip_posture_screen_qn_3_angle')->nullable();
			   $table->timestamps();
			   $table->foreign('wc_assessment_id')->references('id')->on('wheel_chair_assessments')
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
        Schema::dropIfExists('physical_assessments');
    }
}
