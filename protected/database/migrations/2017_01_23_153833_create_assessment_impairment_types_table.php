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
            $table->string('q5_1')->nullable();
            $table->string('q5_2')->nullable();
            $table->string('q5_3')->nullable();
            $table->string('q5_4')->nullable();
            $table->string('q5_5')->nullable();
            $table->string('q5_6')->nullable();
            $table->string('q5_7')->nullable();
            $table->string('q5_8')->nullable();
            $table->string('q5_9')->nullable();
            $table->string('q5_10')->nullable();
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
        Schema::dropIfExists('assessment_impairment_types');
    }
}
