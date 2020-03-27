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
          $table->text('lower_limb_row_1')->nullable();
          $table->text('lower_limb_row_2')->nullable();
          $table->text('lower_limb_row_3')->nullable();
          $table->text('lower_limb_row_4')->nullable();
          $table->text('lower_limb_row_5')->nullable();
          $table->text('lower_limb_row_6')->nullable();
          $table->text('lower_limb_row_7')->nullable();
          $table->text('lower_limb_row_8')->nullable();
          $table->text('lower_limb_row_9')->nullable();
          $table->text('lower_limb_row_10')->nullable();
          $table->text('lower_limb_row_11')->nullable();
          $table->text('lower_limb_row_12')->nullable();
          $table->text('lower_limb_row_13')->nullable();
          $table->text('lower_limb_row_14')->nullable();
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
