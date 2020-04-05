<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDumpItemsDisbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dump_items_disbursements', function (Blueprint $table) {
            $table->increments('id');
			$table->string('names')->nullable();
            $table->string('sex')->nullable();
            $table->string('age')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('m')->nullable();
            $table->string('f')->nullable();
            $table->string('t')->nullable();
            $table->string('origin')->nullable();
            $table->string('date_of_arrival')->nullable();
            $table->string('vul_1')->nullable();
            $table->string('quantity')->nullable();
            $table->string('error_descriptions')->nullable();
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
        Schema::dropIfExists('dump_items_disbursements');
    }
}
