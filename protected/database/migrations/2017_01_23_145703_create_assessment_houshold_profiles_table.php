<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentHousholdProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_houshold_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('full_name')->nullable();
            $table->string('r_head_household')->nullable();
            $table->string('sex')->nullable();
            $table->string('age')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('nationality')->nullable();
            $table->date('date_arrival')->nullable();
            $table->string('present_address')->nullable();
            $table->string('IDP_register')->nullable();
            $table->string('household_head_name')->nullable();
            $table->integer('household_head_age')->nullable();
            $table->integer('children_girls_under5')->nullable();
            $table->integer('children_boys_under5')->nullable();
            $table->integer('children_girls_above5')->nullable();
            $table->integer('children_boys_above5')->nullable();
            $table->integer('women_number')->nullable();
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
        Schema::dropIfExists('assessment_houshold_profiles');
    }
}
