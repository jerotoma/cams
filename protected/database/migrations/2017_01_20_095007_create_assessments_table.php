<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->string('assessors_names')->nullable();
            $table->string('code')->nullable();
            $table->date('interview_date')->nullable();
            $table->integer('camp_id')->unsigned()->nullable();
            $table->integer('district_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('camp_id')->references('id')->on('camps')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')
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
        Schema::dropIfExists('assessments');
    }
}
