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

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->string('auth_status')->nullable()->default('pending');
            $table->string('auth_by')->nullable();
            $table->dateTime('auth_date')->nullable();

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
