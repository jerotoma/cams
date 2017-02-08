<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaediatricChildInspectionResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paediatric_child_inspection_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->text('child_ability')->nullable();
            $table->text('child_special_need')->nullable();
            $table->text('activities')->nullable();
            $table->text('long_term_plan')->nullable();
            $table->text('short_term_plan')->nullable();
            $table->text('consultation')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('provider_designation')->nullable();
            $table->date('provider_date')->nullable();
            $table->string('source_name')->nullable();
            $table->string('source_designation')->nullable();
            $table->date('source_date')->nullable();
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
        Schema::dropIfExists('paediatric_child_inspection_results');
    }
}
