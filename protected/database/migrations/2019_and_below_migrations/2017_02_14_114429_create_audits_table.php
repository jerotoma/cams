<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->nullable();
            $table->string('module')->nullable();
            $table->string('activity')->nullable();
            $table->string('page')->nullable();
            $table->text('data')->nullable();
            $table->string('ip_address')->nullable();
            $table->date('activity_date')->nullable();
            $table->dateTime('log_time')->nullable();
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
        Schema::dropIfExists('audits');
    }
}
