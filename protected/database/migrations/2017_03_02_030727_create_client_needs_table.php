<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientNeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_needs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('need_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('assessment_id')->unsigned();
            $table->string('status')->nullable()->default('No');
            $table->timestamps();

            $table->foreign('need_id')->references('id')->on('needs')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('assessment_id')->references('id')->on('vulnerability_assessments')
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
        Schema::dropIfExists('client_needs');
    }
}
