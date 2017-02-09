<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddcentreNametopaediatric extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('paediatric_child_inspection_results', function(Blueprint $table)
        {
            $table->string('centre_name')->nullable();
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
        Schema::table('paediatric_child_inspection_results', function(Blueprint $table)
        {
            $table->dropColumn('centre_name');
        });
    }
}
