<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodeStatusttoCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('p_s_n_code_categories', function(Blueprint $table)
        {
            $table->string('for_reporting')->nullable();
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
        Schema::table('p_s_n_code_categories', function(Blueprint $table)
        {
            $table->dropColumn('for_reporting');
        });
    }
}
