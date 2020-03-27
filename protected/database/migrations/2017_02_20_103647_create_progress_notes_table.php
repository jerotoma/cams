<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_number')->nullable();
            $table->date('open_date')->nullable();
            $table->text('subjective_information')->nullable();
            $table->text('objective_information')->nullable();
            $table->text('analysis')->nullable();
            $table->text('planning')->nullable();
            $table->string('case_worker_name')->nullable();
            $table->string('status')->default('Open Notice');

            $table->integer('client_id')->unsigned();
            $table->integer('camp_id')->unsigned()->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('auth_status')->nullable()->default('pending');
            $table->string('auth_by')->nullable();
            $table->dateTime('auth_date')->nullable();

            $table->foreign('client_id')->references('id')->on('clients')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('camp_id')->references('id')->on('camps')
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
        Schema::dropIfExists('progress_notes');
    }
}
