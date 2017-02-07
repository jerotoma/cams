<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTakemeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('takemeasurements', function (Blueprint $table) {
               $table->increments('id');
			   $table->integer('p_assessment_id')->unsigned();
               $table->timestamps();
			   $table->foreign('p_assessment_id')->references('id')->on('physicalassessments')
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
        Schema::table('takemeasurements', function (Blueprint $table) {
            //
        });
    }
}
