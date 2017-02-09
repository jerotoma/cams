<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaediatricAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paediatric_assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->string('full_name')->nullable();
            $table->string('rational_number')->nullable();
            $table->string('unique_number')->unique();
            $table->string('home_name')->nullable();
            $table->string('sex')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_job')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('father_age')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_job')->nullable();
            $table->string('mother_phone')->nullable();
            $table->string('mother_age')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('school_status')->nullable();
            $table->string('school_reasons')->nullable();
            $table->integer('nationality')->unsigned();
            $table->string('domicile')->nullable();
            $table->string('communication')->nullable();
            $table->integer('total_children')->nullable();
            $table->integer('total_children_alive')->nullable();
            $table->integer('total_children_dead')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('paediatric_assessments');
    }
}
