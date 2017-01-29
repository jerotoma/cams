<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentPsychosocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_psychosocials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('q8_1')->nullable();
            $table->string('q8_2')->nullable();
            $table->string('q8_3')->nullable();
            $table->string('q8_4')->nullable();
            $table->string('q8_5')->nullable();
            $table->string('q8_6')->nullable();
            $table->string('q8_7')->nullable();
            $table->string('q8_8')->nullable();
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
        Schema::dropIfExists('assessment_psychosocials');
    }
}
