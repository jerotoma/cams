<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpcPartAsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpc_part_as', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('incl_assessment_id')->unsigned();
             $table->string('mpc_qn_a_1')->nullable();
             $table->text('mpc_qn_a_1_remark')->nullable();
             $table->string('mpc_qn_a_2')->nullable();
             $table->text('mpc_qn_a_2_remark')->nullable();
             $table->string('mpc_qn_a_3')->nullable();
             $table->string('mpc_qn_a_4')->nullable();
             $table->string('mpc_qn_a_5')->nullable();
             $table->string('mpc_qn_a_6')->nullable();
             $table->string('mpc_qn_a_7')->nullable();
             $table->string('mpc_qn_a_8')->nullable();
             $table->text('mpc_qn_a_8_remark')->nullable();
             $table->string('mpc_qn_a_9')->nullable();
             $table->string('mpc_qn_a_10')->nullable();
             $table->text('mpc_qn_a_10_remark')->nullable();
             $table->string('mpc_qn_a_11')->nullable();
             $table->string('mpc_qn_a_12')->nullable();
             $table->string('mpc_qn_a_13')->nullable();
             $table->string('mpc_qn_a_14')->nullable();
             $table->string('mpc_qn_a_15')->nullable();
             $table->string('mpc_qn_a_16')->nullable();
             $table->text('mpc_qn_a_16_remark')->nullable();
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
        Schema::dropIfExists('mpc_part_as');
    }
}
