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
            $table->string('q8_1')->unsigned();
            $table->string('q8_2')->unsigned();
            $table->string('q8_3')->unsigned();
            $table->string('q8_4')->unsigned();
            $table->string('q8_5')->unsigned();
            $table->string('q8_6')->unsigned();
            $table->string('q8_7')->unsigned();
            $table->string('q8_8')->unsigned();
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
        Schema::dropIfExists('assessment_psychosocials');
    }
}
