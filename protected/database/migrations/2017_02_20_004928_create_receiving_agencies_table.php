<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivingAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiving_agencies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('referral_id')->unsigned();
            $table->string('rec_organisation')->nullable();
            $table->string('rec_phone')->nullable();
            $table->string('rec_contact')->nullable();
            $table->string('rec_email')->nullable();
            $table->string('rec_location')->nullable();
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
        Schema::dropIfExists('receiving_agencies');
    }
}
