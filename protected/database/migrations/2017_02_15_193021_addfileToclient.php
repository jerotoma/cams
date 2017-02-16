<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddfileToclient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function(Blueprint $table)
        {
            $table->string('share_info')->nullable();
            $table->string('hh_relation')->nullable();
            $table->renameColumn('civil_status','marital_status');
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
        Schema::table('clients', function(Blueprint $table)
        {
            $table->dropColumn('share_info');
            $table->dropColumn('auth_status');
            $table->renameColumn('marital_status','civil_status');
        });
    }
}
