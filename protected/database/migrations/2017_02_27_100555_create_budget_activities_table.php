<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('activity_name')->nullable();
            $table->string('description')->nullable();
            $table->double('amount')->nullable()->default(0.0);
            $table->string('currency')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('provision_limit')->nullable()->default(0);
            $table->string('status')->nullable()->default('Available');

            $table->string('auth_status')->nullable()->default('pending');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

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
        Schema::dropIfExists('budget_activities');
    }
}
