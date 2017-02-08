<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTakeMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('take_measurements', function (Blueprint $table) {
               $table->increments('id');
			   $table->integer('p_assessment_id')->unsigned();
               $table->timestamps();
			   $table->foreign('p_assessment_id')->references('id')->on('physical_assessments')
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
        Schema::table('take_measurements', function (Blueprint $table) {
            //
        });
    }
}
