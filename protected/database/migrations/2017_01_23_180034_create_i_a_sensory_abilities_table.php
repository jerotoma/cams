<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIASensoryAbilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_a_sensory_abilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inclusion_id')->unsigned();
            $table->string('vision')->nullable();
            $table->string('hearing')->nullable();
            $table->string('light_touch')->nullable();
            $table->string('deep_touch')->nullable();
            $table->string('proprioception')->nullable();
            $table->string('stereognosis')->nullable();
            $table->string('temperature')->nullable();
            $table->string('pain')->nullable();
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
        Schema::dropIfExists('i_a_sensory_abilities');
    }
}
