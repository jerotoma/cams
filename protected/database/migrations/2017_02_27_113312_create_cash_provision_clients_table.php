<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashProvisionClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_provision_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('activity_id')->unsigned();
            $table->integer('amount')->unsigned();
            $table->integer('provision_id')->unsigned();
            $table->date('provision_date');

            $table->foreign('client_id')->references('id')->on('clients')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('provision_id')->references('id')->on('cash_provisions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('budget_activities')
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
        Schema::dropIfExists('cash_provision_clients');
    }
}
