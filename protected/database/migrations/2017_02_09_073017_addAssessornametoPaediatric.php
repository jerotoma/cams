<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssessornametoPaediatric extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('paediatric_assessments', function(Blueprint $table)
        {
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('reviewed_by')->unsigned()->nullable();
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
        Schema::table('paediatric_assessments', function(Blueprint $table)
        {
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('reviewed_by');
        });
    }
}
