<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpcPartCsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpc_part_cs', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('incl_assessment_id')->unsigned();
             $table->string('mpc_qn_c_1')->nullable();
             $table->string('mpc_qn_c_2')->nullable();
             $table->string('mpc_qn_c_3')->nullable();
             $table->string('mpc_qn_c_4')->nullable();
             $table->string('mpc_qn_c_5')->nullable();
             $table->string('mpc_qn_c_6')->nullable();
             $table->text('mpc_qn_c_7_remark')->nullable();
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
        Schema::dropIfExists('mpc_part_cs');
    }
}
