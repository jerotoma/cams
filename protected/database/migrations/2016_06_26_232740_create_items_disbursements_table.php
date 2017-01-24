<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsDisbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_disbursements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('item_id');
            $table->integer('quantity');
            $table->date('disbursements_date');
            $table->string('disbursements_by');
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
        Schema::drop('items_disbursements');
    }
}
