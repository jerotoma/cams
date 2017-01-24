<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryReceivedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_receiveds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_name');
            $table->string('way_bill_number');
            $table->string('received_from');
            $table->string('donor');
            $table->string('population');
            $table->string('receiver');
            $table->integer('quantity');
            $table->date('received_date');
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
        Schema::drop('inventory_receiveds');
    }
}
