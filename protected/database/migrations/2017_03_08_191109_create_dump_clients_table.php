<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDumpClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dump_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id')->nullable();
            $table->string('names')->nullable();
            $table->string('sex')->nullable();
            $table->string('age')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('name_of_parents')->nullable();
            $table->string('name_of_spouse')->nullable();
            $table->string('m')->nullable();
            $table->string('f')->nullable();
            $table->string('t')->nullable();
            $table->string('origin')->nullable();
            $table->string('date_of_arrival')->nullable();
            $table->string('present_address')->nullable();
            $table->string('ration_card_number')->nullable();
            $table->string('vul_1')->nullable();
            $table->string('vul_2')->nullable();
            $table->string('vul_3')->nullable();
            $table->string('vul_4')->nullable();
            $table->string('vul_5')->nullable();
            $table->string('error_descriptions')->nullable();
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
        Schema::dropIfExists('dump_clients');
    }
}
