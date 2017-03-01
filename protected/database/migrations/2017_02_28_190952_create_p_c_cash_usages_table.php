<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePCCashUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_c_cash_usages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('q6_1')->nullable();
            $table->string('q6_2')->nullable();
            $table->string('q6_3')->nullable();
            $table->string('q6_4')->nullable();
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
        Schema::dropIfExists('p_c_cash_usages');
    }
}
