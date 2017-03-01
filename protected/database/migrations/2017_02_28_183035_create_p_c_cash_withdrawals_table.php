<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePCCashWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_c_cash_withdrawals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('q3_1')->nullable();
            $table->string('q3_2')->nullable();
            $table->string('q3_3')->nullable();
            $table->string('q3_4')->nullable();
            $table->string('q3_5')->nullable();
            $table->string('q3_6')->nullable();
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
        Schema::dropIfExists('p_c_cash_withdrawals');
    }
}
