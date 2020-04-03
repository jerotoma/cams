<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsDisbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_disbursements', function (Blueprint $table) {
            $table->increments('id');
            $table->date('disbursements_date');
            $table->string('disbursements_by')->nullable();
            $table->text('comments')->nullable();
            $table->integer('camp_id')->nullable()->unsigned();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->string('auth_status')->nullable()->default('pending');
            $table->string('auth_by')->nullable();
            $table->dateTime('auth_date')->nullable();

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
        Schema::drop('items_disbursements');
    }
}
