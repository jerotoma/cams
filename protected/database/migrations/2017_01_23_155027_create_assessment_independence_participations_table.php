<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentIndependenceParticipationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_independence_participations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('q7_1')->nullable();
            $table->string('q7_2')->nullable();
            $table->string('q7_3')->nullable();
            $table->string('q7_4')->nullable();
            $table->string('q7_5')->nullable();
            $table->string('q7_6')->nullable();
            $table->string('q7_7')->nullable();
            $table->string('q7_8')->nullable();
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
        Schema::dropIfExists('assessment_independence_participations');
    }
}
