<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashProvisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_provisions', function (Blueprint $table) {
            $table->increments('id');
            $table->date('provision_date');
            $table->string('provided_by')->nullable();
            $table->text('comments')->nullable();
            $table->integer('camp_id')->nullable()->unsigned();
            $table->integer('activity_id')->unsigned();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->string('auth_status')->nullable()->default('pending');
            $table->string('auth_by')->nullable();
            $table->dateTime('auth_date')->nullable();

            $table->foreign('camp_id')->references('id')->on('camps')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('budget_activities')
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
        Schema::dropIfExists('cash_provisions');
    }
}
