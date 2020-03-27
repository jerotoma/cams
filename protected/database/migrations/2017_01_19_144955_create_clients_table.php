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
            $table->string('hai_reg_number')->nullable();
            $table->string('client_number');
            $table->string('full_name');
            $table->string('sex')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('age')->nullable();
            $table->string('age_score')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('care_giver')->nullable();
            $table->string('child_care_giver')->nullable();
            $table->integer('origin_id')->nullable()->unsigned();
            $table->integer('camp_id')->nullable()->unsigned();


            $table->date('date_arrival')->nullable();
            $table->string('present_address')->nullable();
            $table->integer('females_total')->nullable();
            $table->integer('males_total')->nullable();
            $table->string('household_number')->nullable();
            $table->string('ration_card_number')->nullable();
            $table->string('assistance_received')->nullable();
            $table->string('problem_specification')->nullable();

            $table->string('status')->nullable();
            $table->string('share_info')->nullable();
            $table->string('hh_relation')->nullable();

            $table->string('auth_status')->nullable()->default('pending');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('auth_by')->nullable();
            $table->dateTime('auth_date')->nullable();

            $table->foreign('origin_id')->references('id')->on('origins')
                ->onUpdate('cascade');
            $table->foreign('camp_id')->references('id')->on('camps')
                ->onUpdate('cascade')->onDelete('cascade');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('clients');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
