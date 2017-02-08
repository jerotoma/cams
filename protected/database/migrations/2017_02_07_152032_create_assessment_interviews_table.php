<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_interviews', function (Blueprint $table) {
               $table->increments('id');
			   $table->integer('wc_assessment_id')->unsigned();
			   $table->string('assess_interview_diagnosis_qn_1', 100 )->nullable();
			   $table->string('assess_interview_diagnosis_qn_2', 100 )->nullable();
			   $table->string('assess_interview_physical_issues_qn_1', 100 )->nullable();
			   $table->string('assess_interview_physical_issues_qn_2', 100 )->nullable();
			   $table->string('assess_interview_physical_issues_qn_3', 100 )->nullable();
			   $table->text('assess_interview_physical_issues_qn_3_describe')->nullable();
			   $table->string('assess_interview_physical_issues_qn_4', 100 )->nullable();
			   $table->string('assess_interview_physical_issues_qn_5', 100 )->nullable();
			   $table->string('assess_interview_physical_issues_qn_6', 100 )->nullable();
			   $table->text('assess_interview_lifestyle_env_qn_1_describe')->nullable();
			   $table->string('assess_interview_lifestyle_env_qn_1', 100 )->nullable();
			   $table->string('assess_interview_lifestyle_env_qn_2', 100 )->nullable();
			   $table->string('assess_interview_lifestyle_env_qn_3', 100 )->nullable();
			   $table->string('assess_interview_lifestyle_env_qn_4', 100 )->nullable();
			   $table->string('assess_interview_lifestyle_env_qn_5', 100 )->nullable();
			   $table->string('assess_interview_lifestyle_env_qn_6', 100 )->nullable();
			   $table->string('assess_interview_lifestyle_env_qn_7', 100 )->nullable();
			   $table->text('assess_interview_lifestyle_env_qn_7_describe')->nullable();
			   $table->string('assess_interview_existing_wheelchair_qn_1')->nullable();
			   $table->string('assess_interview_existing_wheelchair_qn_2')->nullable();
			   $table->string('assess_interview_existing_wheelchair_qn_3')->nullable();
			   $table->string('assess_interview_existing_wheelchair_qn_4')->nullable();
			   $table->string('assess_interview_existing_wheelchair_qn_5')->nullable();
			   $table->string('assess_interview_existing_wheelchair_qn_6')->nullable();
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
        Schema::table('assessmentinterviews', function (Blueprint $table) {
            //
        });
    }
}
