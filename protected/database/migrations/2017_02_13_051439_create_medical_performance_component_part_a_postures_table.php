<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalPerformanceComponentPartAPosturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_performance_component_part_a_postures', function (Blueprint $table) {
               $table->increments('id');
               $table->integer('mpc_part_a_id')->unsigned();
			   $table->string('mpc_qn_a_17')->nullable();
               $table->string('mpc_qn_a_18')->nullable();
               $table->string('mpc_qn_a_19')->nullable();
               $table->string('mpc_qn_a_20')->nullable();
               $table->string('mpc_qn_a_21')->nullable();
               $table->string('mpc_qn_a_22')->nullable();
               $table->string('mpc_qn_a_23')->nullable();
               $table->string('mpc_qn_a_24')->nullable();
               $table->text('mpc_qn_a_25_remark')->nullable();
               $table->text('mpc_qn_a_26_remark')->nullable();
               $table->text('mpc_qn_a_27_remark')->nullable();
               $table->text('mpc_qn_a_28_remark')->nullable();
               $table->text('mpc_qn_a_29_remark')->nullable();
               $table->string('mpc_qn_a_30')->nullable();
               $table->string('mpc_qn_a_31_remark')->nullable();
               $table->string('mpc_qn_a_32')->nullable();
               $table->string('mpc_qn_a_33')->nullable();
               $table->string('mpc_qn_a_34')->nullable();
               $table->string('mpc_qn_a_35')->nullable();
               $table->text('mpc_qn_a_35_remark')->nullable();
               $table->string('mpc_qn_a_36')->nullable();
               $table->string('mpc_qn_a_37')->nullable();
               $table->string('mpc_qn_a_38')->nullable();
               $table->string('mpc_qn_a_39')->nullable();
               $table->string('mpc_qn_a_40')->nullable();
               $table->text('mpc_qn_a_41_remark')->nullable();
			   $table->timestamps();
               $table->foreign('mpc_part_a_id')->references('id')->on('medical_performance_component_part_a')
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
        Schema::create('medical_performance_component_part_a_postures', function (Blueprint $table) {
            //
        });
    }
}
