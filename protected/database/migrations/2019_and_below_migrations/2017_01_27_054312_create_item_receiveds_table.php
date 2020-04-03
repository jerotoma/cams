<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemReceivedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_receiveds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('received_id')->nullable()->unsigned();
            $table->integer('item_id')->nullable()->unsigned();
            $table->integer('quantity')->nullable();
            $table->string('description')->nullable();
            $table->string('auth_status')->nullable()->default('pending');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('auth_by')->nullable();

            $table->foreign('received_id')->references('id')->on('inventory_receiveds')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items_inventories')
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('item_receiveds');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
