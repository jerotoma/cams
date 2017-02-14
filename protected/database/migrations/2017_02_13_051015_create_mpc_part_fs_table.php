<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpcPartFsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpc_part_fs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('incl_assessment_id')->unsigned();
            $table->text('mpc_qn_f_1')->nullable();
            $table->text('mpc_qn_f_2_remark')->nullable();
            $table->text('mpc_qn_f_3')->nullable();
            $table->text('mpc_qn_f_4_remark')->nullable();
            $table->text('mpc_qn_f_5')->nullable();
            $table->text('mpc_qn_f_6')->nullable();
            $table->text('mpc_qn_f_7_remark')->nullable();
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
          Schema::dropIfExists('mpc_part_fs');
    }
}
