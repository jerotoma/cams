<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousholdProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houshold_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->string('household_number')->nullable();
            $table->string('household_head_name')->nullable();
            $table->integer('household_head_age')->nullable();
            $table->string('spouse_name')->nullable();
            $table->integer('males_total')->nullable();
            $table->integer('females_total')->nullable();
            $table->integer('child_under_5')->nullable();
            $table->integer('child_between_6_18')->nullable();
            $table->integer('number_women')->nullable();
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')
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
        Schema::dropIfExists('houshold_profiles');
    }
}
