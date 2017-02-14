<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpcPartARomLowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpc_part_a_rom_lowers', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('incl_assessment_id')->unsigned();
          $table->timestamps();
          $table->foreign('incl_assessment_id')->references('id')->on('inclusion_assessments')
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
        Schema::dropIfExists('mpc_part_a_rom_lowers');
    }
}
