<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResupplyLimittoItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('items_inventories', function(Blueprint $table)
        {
            $table->integer('redistribution_limit')->nullable();
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
        Schema::table('items_inventories', function(Blueprint $table)
        {
            $table->dropColumn('redistribution_limit');
        });
    }
}
