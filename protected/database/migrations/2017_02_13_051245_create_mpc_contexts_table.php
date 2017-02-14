<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpcContextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpc_contexts', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('incl_assessment_id')->unsigned();
             $table->text('mpc_context_1')->nullable();
             $table->text('mpc_context_2')->nullable();
             $table->text('mpc_context_3_remark')->nullable();
             $table->text('mpc_context_4')->nullable();
             $table->string('mpc_context_5')->nullable();
             $table->text('mpc_context_5_remark')->nullable();
             $table->string('mpc_context_6')->nullable();
             $table->text('mpc_context_6_remark')->nullable();
             $table->string('mpc_context_7')->nullable();
             $table->string('mpc_context_8')->nullable();
             $table->string('mpc_context_9_remark')->nullable();
             $table->string('mpc_context_10')->nullable();
             $table->string('mpc_context_11')->nullable();
             $table->string('mpc_context_12')->nullable();
             $table->string('mpc_context_13')->nullable();
             $table->string('mpc_context_14')->nullable();
             $table->text('mpc_context_15_remark')->nullable();
             $table->string('mpc_context_16')->nullable();
             $table->text('mpc_context_16_remark')->nullable();
             $table->timestamps();
             $table->foreign('incl_assessment_id')->references('id')->on('inclusion_assessments')
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
          Schema::dropIfExists('mpc_contexts');
    }
}
