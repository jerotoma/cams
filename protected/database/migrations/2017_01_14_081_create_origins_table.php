<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('origins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('origin_name')->unique();
            $table->string('auth_status')->nullable()->default('pending');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('auth_by')->nullable();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('origins');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
