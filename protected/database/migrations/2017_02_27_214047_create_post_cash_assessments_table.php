<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCashAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_cash_assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('camp_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->date('interview_date')->nullable();
            $table->time('interview_start_time')->nullable();
            $table->time('interview_end_time')->nullable();
            $table->string('organisation')->nullable();
            $table->string('enumerator_name')->nullable();
            $table->string('respondent_name')->nullable();
            $table->text('enumerator_observations')->nullable();

            $table->string('auth_status')->nullable()->default('pending');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('auth_by')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')
                ->onUpdate('cascade');

            $table->foreign('camp_id')->references('id')->on('camps')
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
        Schema::dropIfExists('post_cash_assessments');
    }
}
