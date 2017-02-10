<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressiveNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progressive_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->date('open_date')->nullable();
            $table->text('subjective_information')->nullable();
            $table->text('objective_information')->nullable();
            $table->text('analysis')->nullable();
            $table->text('planning')->nullable();
            $table->string('case_worker_name')->nullable();
            $table->integer('client_id')->unsigned();
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
        Schema::dropIfExists('progressive_notes');
    }
}
