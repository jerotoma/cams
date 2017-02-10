<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressiveNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progressive_notices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_number')->nullable();
            $table->date('open_date')->nullable();
            $table->text('subjective_information')->nullable();
            $table->text('objective_information')->nullable();
            $table->text('analysis')->nullable();
            $table->text('planning')->nullable();
            $table->string('case_worker_name')->nullable();
            $table->string('status')->nullable()->default('Open Notice');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('reviewed_by')->unsigned()->nullable();
            $table->integer('client_id')->unsigned();
            $table->integer('camp_id')->unsigned()->nullable();
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
        Schema::dropIfExists('progressive_notices');
    }
}
