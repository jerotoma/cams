<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_reasons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('referral_id')->unsigned();
            $table->string('client_referral_info')->nullable();
            $table->string('client_referral_status')->nullable();
            $table->string('client_referral_info_text')->nullable();
            $table->string('client_referral_status_text')->nullable();
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
        Schema::dropIfExists('referral_reasons');
    }
}
