<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('department_id')->nullable();
            $table->string('camp_id')->nullable();
            $table->string('designation')->nullable();
            $table->string('level')->default('Normal');
            $table->string('status')->nullable()->default('Active');
            $table->integer('locked')->default(0);
            $table->string('username')->unique();
            $table->string('password', 100);
            $table->dateTime('last_login')->nullable();
            $table->dateTime('last_logout')->nullable();
            $table->dateTime('last_success_login')->nullable();
            $table->string('profile_image')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
