<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FingerPrintLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finger_print_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fid');
            $table->string('clid')->nullable();
            $table->string('HAI')->nullable();
            $table->text('p1')->nullable();
            $table->text('p2')->nullable();
            $table->string('registradon')->nullable();
            $table->string('regby')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('finger_print_logs');
    }
}
