<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInclusionAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inclusion_assessments', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('client_id')->unsigned();
             $table->integer('assessor_id')->unsigned();
             $table->timestamps();
             $table->foreign('client_id')->references('id')->on('clients')
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
        Schema::create('inclusion_assessments', function (Blueprint $table) {
            //
        });
    }
}
