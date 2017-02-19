<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWheelChairAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wheel_chair_assessments', function (Blueprint $table) {
               $table->increments('id');
			   $table->integer('client_id')->unsigned();
			   $table->integer('assessor_id')->unsigned();

                $table->string('auth_status')->nullable()->default('pending');
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
                $table->string('auth_by')->nullable();

			   $table->timestamps();
               $table->foreign('client_id')->references('id')
                   ->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wheel_chair_assessments', function (Blueprint $table) {
            //
        });
    }
}
