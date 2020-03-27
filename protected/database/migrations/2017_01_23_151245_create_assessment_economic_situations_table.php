<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentEconomicSituationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_economic_situations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('q3_1')->nullable();
            $table->string('q3_2')->nullable();
            $table->string('q3_3')->nullable();
            $table->string('q3_4')->nullable();
            $table->string('q3_5')->nullable();
            $table->string('q3_6')->nullable();
            $table->string('q3_7')->nullable();
            $table->string('q3_8')->nullable();
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
        Schema::dropIfExists('assessment_economic_situations');
    }
}
