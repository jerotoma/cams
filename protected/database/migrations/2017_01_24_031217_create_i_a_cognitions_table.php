<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIACognitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_a_cognitions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inclusion_id')->unsigned();
            $table->string('attention')->nullable();
            $table->string('concentration')->nullable();
            $table->string('problem_solving')->nullable();
            $table->string('orientation')->nullable();
            $table->string('sequencing')->nullable();
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
        Schema::dropIfExists('i_a_cognitions');
    }
}
