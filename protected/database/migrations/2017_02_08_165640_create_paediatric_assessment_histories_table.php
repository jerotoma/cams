<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaediatricAssessmentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paediatric_assessment_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('place_born')->nullable();
            $table->text('mother_pregnant_complications')->nullable();
            $table->text('mother_birth_complications')->nullable();
            $table->text('child_birth_condition')->nullable();
            $table->string('mother_labor_days')->nullable();
            $table->string('was_child_cry')->nullable();
            $table->foreign('assessment_id')->references('id')->on('paediatric_assessments')
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
        Schema::dropIfExists('paediatric_assessment_histories');
    }
}
