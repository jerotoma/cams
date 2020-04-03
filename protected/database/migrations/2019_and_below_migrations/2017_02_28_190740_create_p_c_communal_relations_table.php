<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePCCommunalRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_c_communal_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('q5_1')->nullable();
            $table->string('q5_2')->nullable();
            $table->string('q5_3')->nullable();
            $table->string('q5_4')->nullable();
            $table->string('q5_5')->nullable();
            $table->string('q5_6')->nullable();
            $table->timestamps();

            $table->foreign('assessment_id')->references('id')->on('post_cash_assessments')
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
        Schema::dropIfExists('p_c_communal_relations');
    }
}
