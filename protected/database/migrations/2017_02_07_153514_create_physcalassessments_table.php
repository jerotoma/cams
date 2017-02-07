<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhyscalassessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('physicalassessments', function (Blueprint $table) {
               $table->increments('id');
			   $table->integer('wc_assessment_id')->unsigned();
               $table->string('physical_assess_presence_risk_qn_1', 100 )->nullable();
			   $table->string('physical_assess_presence_risk_qn_2', 100 )->nullable();
			   $table->string('physical_assess_presence_risk_qn_3', 100 )->nullable();
			   $table->string('physical_assess_presence_risk_qn_4', 100 )->nullable();
			   $table->string('physical_assess_presence_risk_qn_5', 100 )->nullable();
			   $table->string('physical_assess_presence_risk_qn_6', 100 )->nullable();
			   $table->string('physical_assess_method_of_pushing_qn_1', 100 )->nullable();
			   $table->string('physical_assess_method_of_pushing_qn_2', 100 )->nullable();
			   $table->text('physical_assess_method_of_pushing_qn_2_describe')->nullable();
			   $table->string('physical_assess_sitting_posture_without_support_qn_1', 100 )->nullable();
			   $table->string('physical_assess_pelvis_hip_posture_screen_qn_1', 100 )->nullable();
			   $table->string('physical_assess_pelvis_hip_posture_screen_qn_2', 100 )->nullable();
			   $table->text('physical_assess_pelvis_hip_posture_screen_qn_2_angle')->nullable();
			   $table->string('physical_assess_pelvis_hip_posture_screen_qn_3', 100 )->nullable();
			   $table->text('physical_assess_pelvis_hip_posture_screen_qn_3_angle', 100 )->nullable();
			   $table->timestamps();
			   $table->foreign('wc_assessment_id')->references('id')->on('wheelchairassessments')
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
        Schema::table('physicalassessments', function (Blueprint $table) {
            //
        });
    }
}
