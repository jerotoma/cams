<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentItemNeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_item_needs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('q10_1')->nullable();
            $table->string('q10_2')->nullable();
            $table->string('q10_3')->nullable();
            $table->string('q10_4')->nullable();
            $table->string('q10_5')->nullable();
            $table->string('q10_6')->nullable();
            $table->string('q10_7')->nullable();
            $table->string('q10_8')->nullable();
            $table->string('q10_9')->nullable();
            $table->string('q10_10')->nullable();
            $table->string('q10_11')->nullable();
            $table->string('q10_12')->nullable();
            $table->string('q10_13')->nullable();
            $table->string('q10_14')->nullable();
            $table->string('q10_15')->nullable();
            $table->string('q10_16')->nullable();
            $table->string('q10_17')->nullable();
            $table->string('q10_18')->nullable();
            $table->string('q10_19')->nullable();
            $table->string('q10_20')->nullable();
            $table->string('q10_21')->nullable();
            $table->string('q10_22')->nullable();
            $table->string('q10_23')->nullable();
            $table->string('q10_24')->nullable();
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
        Schema::dropIfExists('assessment_item_needs');
    }
}
