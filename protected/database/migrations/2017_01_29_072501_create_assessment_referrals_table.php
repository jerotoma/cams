<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('q11_1')->nullable();
            $table->string('q11_2')->nullable();
            $table->string('q11_3')->nullable();
            $table->string('q11_4')->nullable();
            $table->string('q11_5')->nullable();
            $table->string('q11_6')->nullable();
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
        Schema::dropIfExists('assessment_referrals');
    }
}
