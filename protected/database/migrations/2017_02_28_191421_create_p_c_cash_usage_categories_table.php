<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePCCashUsageCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_c_cash_usage_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usage_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->double('currency')->nullable();
            $table->timestamps();

            $table->foreign('usage_id')->references('id')->on('p_c_cash_usages')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('p_c_categories')
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
        Schema::dropIfExists('p_c_cash_usage_categories');
    }
}
