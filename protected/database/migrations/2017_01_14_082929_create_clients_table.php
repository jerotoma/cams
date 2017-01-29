<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_number')->unique();
            $table->string('full_name')->unique();
            $table->string('sex')->nullable();
            $table->integer('age')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('care_giver')->nullable();
            $table->integer('country_id')->nullable();
            $table->date('date_arrival')->nullable();
            $table->string('present_address')->nullable();
            $table->string('household_number')->nullable();
            $table->string('ration_card_number')->nullable();
            $table->string('assistance_received')->nullable();
            $table->string('problem_specification')->nullable();
            $table->integer('camp_id')->nullable();
            $table->string('status')->nullable();
            $table->string('created_by')->nullable();
            $table->string('auth_by')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
