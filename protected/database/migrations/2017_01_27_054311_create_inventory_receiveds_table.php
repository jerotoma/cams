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
            $table->string('reference_number')->nullable();
            $table->date('date_received')->nullable();
            $table->string('donor_ref')->nullable();
            $table->string('received_from')->nullable();
            $table->string('receiving_officer')->nullable();
            $table->string('project')->nullable();
            $table->string('onward_delivery')->nullable();
            $table->string('comments')->nullable();
            $table->string('checked_by')->nullable();
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
