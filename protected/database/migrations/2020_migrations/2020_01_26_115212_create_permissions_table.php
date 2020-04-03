<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('roles.connection');
        $table = config('roles.permissionsTable');
        $tableCheck = Schema::connection($connection)->hasTable($table);

        if (!$tableCheck) {
            Schema::connection($connection)->create($table, function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('description')->nullable();
                $table->string('model')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        } else {
            Schema::table($table , function (Blueprint $table) {
                if (Schema::hasColumn($table, 'name')) {
                    $table->renameColumn('name', 'slug');
                }
                if (Schema::hasColumn($table, 'display_name')) {
                    $table->renameColumn('display_name', 'name');
                }
                if (Schema::hasColumn($table, 'model')) {
                    $table->string('model')->nullable();
                }
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $connection = config('roles.connection');
        $table = config('roles.permissionsTable');
        Schema::connection($connection)->dropIfExists($table);
    }
}
