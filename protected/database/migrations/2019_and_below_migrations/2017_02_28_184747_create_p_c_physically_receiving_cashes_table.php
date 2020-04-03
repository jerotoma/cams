<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePCPhysicallyReceivingCashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_c_physically_receiving_cashes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('q4_1')->nullable();
            $table->string('q4_2')->nullable();
            $table->string('q4_3')->nullable();
            $table->string('q4_4')->nullable();
            $table->string('q4_5')->nullable();
            $table->string('q4_6')->nullable();
            $table->string('q4_7')->nullable();
            $table->string('q4_8')->nullable();
            $table->string('q4_9')->nullable();
            $table->string('q4_10')->nullable();
            $table->string('q4_10_1')->nullable();
            $table->string('q4_11')->nullable();
            $table->string('q4_12')->nullable();
            $table->string('q4_13')->nullable();
            $table->string('q4_14')->nullable();
            $table->string('q4_15')->nullable();
            $table->string('q4_16')->nullable();
            $table->string('q4_17')->nullable();
            $table->string('q4_18')->nullable();
            $table->string('q4_19')->nullable();
            $table->string('q4_20')->nullable();
            $table->string('q4_21')->nullable();
            $table->string('q4_22')->nullable();
            $table->timestamps();

            $table->foreign('assessment_id')->references('id')->on('post_cash_assessments')
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
        Schema::dropIfExists('p_c_physically_receiving_cashes');
    }
}
