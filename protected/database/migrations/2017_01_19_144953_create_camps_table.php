<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reg_no')->nullable();
            $table->string('camp_name');
            $table->string('description')->nullable();
            $table->string('address')->nullable();
            $table->string('tel')->nullable();
            $table->integer('region_id')->unsigned()->nullable();
            $table->integer('district_id')->unsigned()->nullable();
            $table->string('status')->default('working');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('region_id')->references('id')->on('regions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')
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
        Schema::dropIfExists('camps');
    }
}
