<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsDisbursementItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_disbursement_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('quantity')->default(0);
            $table->integer('distribution_id')->unsigned();

            $table->foreign('client_id')->references('id')->on('clients')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('item_id')->references('id')->on('items_inventories')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('distribution_id')->references('id')->on('items_disbursements')
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
        Schema::dropIfExists('items_disbursement_items');
    }
}
