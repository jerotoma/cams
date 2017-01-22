<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_families', function (Blueprint $table) {
            $table->increments('id');
            $table->string('household_head')->nullable();
            $table->integer('household_head_age')->nullable();
            $table->string('spouse_name')->nullable();
            $table->integer('males_total')->nullable();
            $table->integer('females_total')->nullable();
            $table->integer('child_under_5')->nullable();
            $table->integer('child_between_6_18')->nullable();
            $table->integer('number_women')->nullable();
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
        Schema::dropIfExists('client_families');
    }
}
