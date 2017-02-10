<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_cases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_number')->nullable();
            $table->date('open_date')->nullable();
            $table->string('case_type')->nullable();
            $table->text('descriptions')->nullable();
            $table->text('initial_action')->nullable();
            $table->text('feedback')->nullable();
            $table->text('planning')->nullable();
            $table->string('case_worker_name')->nullable();
            $table->string('vol')->nullable();
            $table->string('status')->default('Open Case');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('reviewed_by')->unsigned()->nullable();
            $table->integer('client_id')->unsigned();
            $table->integer('camp_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('clients')
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
        Schema::dropIfExists('client_cases');
    }
}
