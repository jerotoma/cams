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
            $table->string('daily_activities')->nullable();
            $table->string('bathing')->nullable();
            $table->string('using_toilets')->nullable();
            $table->string('dressing')->nullable();
            $table->string('eating')->nullable();
            $table->string('cooking')->nullable();
            $table->string('cleaning')->nullable();
            $table->string('community_activities')->nullable();
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
        Schema::dropIfExists('assessment_independence_participations');
    }
}
