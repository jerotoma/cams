<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_name')->nullable();
            $table->string('description')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('remarks')->nullable();
            $table->string('unit')->nullable();
            $table->string('status')->nullable();
            $table->integer('redistribution_limit')->default(0)->nullable();
            $table->integer('category_id')->nullable()->unsigned();

            $table->string('auth_status')->nullable()->default('pending');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->foreign('category_id')->references('id')->on('items_categories')
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
        Schema::drop('items_inventories');
    }
}
