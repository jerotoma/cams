<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferringAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referring_agencies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('referral_id')->unsigned();
            $table->string('ref_organisation')->nullable();
            $table->string('ref_phone')->nullable();
            $table->string('ref_contact')->nullable();
            $table->string('ref_email')->nullable();
            $table->string('ref_location')->nullable();
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
        Schema::dropIfExists('referring_agencies');
    }
}
