<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaediatricChildGrowthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paediatric_child_growths', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->text('sitting')->nullable();
            $table->text('crowing')->nullable();
            $table->text('standing')->nullable();
            $table->text('walking')->nullable();
            $table->text('talking')->nullable();
            $table->text('child_self_expression')->nullable();
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
        Schema::dropIfExists('paediatric_child_growths');
    }
}
