<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePSNCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_s_n_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('description')->nullable();
            $table->text('definition')->nullable();
            $table->integer('category_id')->nullable()->unsigned();
            $table->string('for_reporting')->nullable()->default('No');
            $table->string('auth_status')->nullable()->default('pending');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('auth_by')->nullable();
            $table->foreign('category_id')->references('id')->on('p_s_n_code_categories')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('p_s_n_codes');
    }
}
