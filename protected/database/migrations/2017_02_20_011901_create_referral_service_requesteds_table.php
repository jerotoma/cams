<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralServiceRequestedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_service_requesteds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('referral_id')->unsigned();
            $table->string('service_request')->nullable();
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('referral_service_requesteds');
    }
}
