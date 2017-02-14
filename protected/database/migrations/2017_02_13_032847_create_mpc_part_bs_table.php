<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpcPartBsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('mpc_part_bs', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('incl_assessment_id')->unsigned();
             $table->text('mpc_qn_b_1')->nullable();
             $table->text('mpc_qn_b_1_remark')->nullable();
             $table->text('mpc_qn_b_2')->nullable();
             $table->text('mpc_qn_b_2_remark')->nullable();
             $table->text('mpc_qn_b_3_remark')->nullable();
             $table->text('mpc_qn_b_4')->nullable();
             $table->text('mpc_qn_b_27_remak')->nullable();
             $table->text('mpc_qn_b_28')->nullable();
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
          Schema::dropIfExists('mpc_part_bs');
    }
}
