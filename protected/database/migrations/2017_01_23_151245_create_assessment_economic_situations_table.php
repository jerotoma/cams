<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentEconomicSituationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_economic_situations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->string('past_activity')->nullable();
            $table->string('present_activity')->nullable();
            $table->string('income_source')->nullable();
            $table->string('assistance_received')->nullable();
            $table->integer('family_members')->nullable();
            $table->string('share_expenses')->nullable();
            $table->string('share_expenses_percentage')->nullable();
            $table->double('spend_per_week')->nullable();
            $table->string('buy_food_frequency')->nullable();
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
        Schema::dropIfExists('assessment_economic_situations');
    }
}
