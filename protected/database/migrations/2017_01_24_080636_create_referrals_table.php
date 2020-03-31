<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->string('progress_number')->nullable();
            $table->string('case_name')->nullable();
            $table->date('referral_date')->nullable();
            $table->string('completed_by')->nullable();
            $table->string('location')->nullable();
            $table->string('age')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('disabilities')->nullable();
            $table->string('ethnic_background')->nullable();
            $table->string('contact')->nullable();
            $table->string('phone')->nullable();
            $table->string('person_name')->nullable();
            $table->string('person_name_contact')->nullable();
            $table->string('relationship')->nullable();
            $table->string('person_name_address')->nullable();
            $table->string('consent')->nullable();
            $table->string('parental_consent')->nullable();
            $table->string('attachment')->nullable();
            $table->string('initial_action')->nullable();
            $table->string('time_frames')->nullable();
            $table->string('additional_comments')->nullable();
            $table->string('primary_concern')->nullable();
            $table->string('print_name')->nullable();
            $table->string('referred_to')->nullable();
            $table->string('referred_to_position')->nullable();
            $table->string('organization')->nullable();
            $table->string('org_phone')->nullable();
            $table->string('org_email')->nullable();
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
        Schema::dropIfExists('referrals');
    }
}
