<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdTOPSNCODE extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('p_s_n_codes', function(Blueprint $table)
        {
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('p_s_n_code_categories')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('p_s_n_codes', function(Blueprint $table)
        {
            $table->dropColumn('category_id');
        });
    }
}
