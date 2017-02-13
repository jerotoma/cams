<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnsItemsDistributions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('items_disbursements', function(Blueprint $table)
        {
            $table->dropColumn('client_id');
            $table->dropColumn('item_id');
            $table->dropColumn('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('items_disbursements', function(Blueprint $table)
        {
            $table->integer('client_id');
            $table->integer('item_id');
            $table->integer('quantity');
        });
    }
}
