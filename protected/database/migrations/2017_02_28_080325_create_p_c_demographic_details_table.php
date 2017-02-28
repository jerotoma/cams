<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePCDemographicDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_c_demographic_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('q2_1')->nullable();
            $table->integer('q2_2')->nullable();
            $table->string('q2_3')->nullable();
            $table->string('q2_4')->nullable();
            $table->string('q2_5')->nullable();
            $table->integer('q2_6')->nullable();
            $table->integer('q2_7')->nullable();
            $table->string('q2_8')->nullable();
            $table->timestamps();

            $table->foreign('assessment_id')->references('id')->on('post_cash_assessments')
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
        Schema::dropIfExists('p_c_demographic_details');
    }
}
