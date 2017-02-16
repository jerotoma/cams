<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpcPartAMovingPatternsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

       Schema::create('mpc_part_a_moving_patterns', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('mpc_part_a_id')->unsigned();
			       $table->text('mpc_qn_a_42_remark')->nullable();
             $table->string('mpc_qn_a_42')->nullable();
             $table->string('mpc_qn_a_43')->nullable();
             $table->string('mpc_qn_a_44')->nullable();
             $table->string('mpc_qn_a_45')->nullable();
             $table->string('mpc_qn_a_46')->nullable();
             $table->string('mpc_qn_a_47')->nullable();
             $table->string('mpc_qn_a_48')->nullable();
             $table->string('mpc_qn_a_49')->nullable();
             $table->string('mpc_qn_a_50')->nullable();
             $table->string('mpc_qn_a_51')->nullable();
             $table->string('mpc_qn_a_52')->nullable();
             $table->string('mpc_qn_a_53')->nullable();
             $table->timestamps();
             $table->foreign('mpc_part_a_id')->references('id')->on('mpc_part_as')
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
          Schema::dropIfExists('mpc_part_a_moving_patterns');
    }
}
