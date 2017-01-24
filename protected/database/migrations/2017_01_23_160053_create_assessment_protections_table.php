<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentProtectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_protections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('q9_1')->nullable();
            $table->string('q9_2')->nullable();
            $table->string('q9_3')->nullable();
            $table->string('q9_4')->nullable();
            $table->string('q9_5')->nullable();
            $table->string('q9_6')->nullable();
            $table->string('q9_7')->nullable();
            $table->string('q9_8')->nullable();
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
        Schema::dropIfExists('assessment_protections');
    }
}
