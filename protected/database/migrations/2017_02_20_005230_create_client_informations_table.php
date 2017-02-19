<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('referral_id')->unsigned();
            $table->string('cl_name')->nullable();
            $table->string('cl_address')->nullable();
            $table->string('cl_phone')->nullable();
            $table->string('cl_age')->nullable();
            $table->string('cl_sex')->nullable();
            $table->string('cl_nationality')->nullable();
            $table->string('cl_language')->nullable();
            $table->string('cl_id_number')->nullable();
            $table->string('cl_care_giver')->nullable();
            $table->string('cl_care_giver_relationship')->nullable();
            $table->string('cl_care_giver_contact')->nullable();
            $table->string('cl_child_separated')->nullable();
            $table->string('cl_care_giver_informed')->nullable();
            $table->timestamps();
            $table->foreign('referral_id')->references('id')->on('client_referrals')
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
        Schema::dropIfExists('client_informations');
    }
}
