<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIAMotorSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_a_motor_skills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inclusion_id')->unsigned();
            $table->text('gross_motor_skills')->nullable();
            $table->text('rom')->nullable();
            $table->text('muscle_strength')->nullable();
            $table->text('tone')->nullable();
            $table->text('endurance')->nullable();
            $table->text('balance')->nullable();
            $table->text('lying_sitting')->nullable();
            $table->text('sitting')->nullable();
            $table->text('squatting')->nullable();
            $table->text('standing')->nullable();
            $table->text('posture')->nullable();
            $table->text('head_control')->nullable();
            $table->text('trunk_control')->nullable();
            $table->text('spinal_deformities')->nullable();
            $table->text('symmetry')->nullable();
            $table->text('subluxation')->nullable();
            $table->text('hand_function')->nullable();
            $table->text('coordination')->nullable();
            $table->text('eye_hand_coordination')->nullable();
            $table->text('tripod_grasp')->nullable();
            $table->text('power_grasp')->nullable();
            $table->text('cylindrical_grasp')->nullable();
            $table->text('release')->nullable();
            $table->text('bilateral_use_hands')->nullable();
            $table->text('hand_dominance')->nullable();
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
        Schema::dropIfExists('i_a_motor_skills');
    }
}
