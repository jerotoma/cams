<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentImpairmentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_impairment_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('physical_impairment')->nullable();
            $table->string('hearing_impairment')->nullable();
            $table->string('speech_impairment')->nullable();
            $table->string('visual_impairment')->nullable();
            $table->string('mental_Illness')->nullable();
            $table->string('lt_medical_treatment')->nullable();
            $table->string('condition:')->nullable();
            $table->string('drugs_availability')->nullable();
            $table->string('medication')->nullable();
            $table->string('treatment_duration')->nullable();
            $table->string('stopped_medications')->nullable();
            $table->string('when_stopped_medications')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessment_impairment_types');
    }
}
