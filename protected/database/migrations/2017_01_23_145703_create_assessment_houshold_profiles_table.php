<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentHousholdProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_houshold_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('q2_1')->nullable();
            $table->string('q2_2')->nullable();
            $table->string('q2_3')->nullable();
            $table->string('q2_4')->nullable();
            $table->string('q2_5')->nullable();
            $table->string('q2_6')->nullable();
            $table->date('q2_7')->nullable();
            $table->string('q2_8')->nullable();
            $table->string('q2_9')->nullable();
            $table->string('q2_10')->nullable();
            $table->string('q2_11')->nullable();
            $table->string('q2_12')->nullable();
            $table->string('q2_13')->nullable();
            $table->string('q2_14')->nullable();
            $table->timestamps();
            $table->foreign('assessment_id')->references('id')->on('vulnerability_assessments')
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
        Schema::dropIfExists('assessment_houshold_profiles');
    }
}
