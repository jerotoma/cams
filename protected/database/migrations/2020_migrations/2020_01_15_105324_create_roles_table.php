<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('roles.connection');
        $rolesTable = config('roles.rolesTable');
        $tableCheck = Schema::connection($connection)->hasTable($rolesTable );

        if (!$tableCheck) {
            Schema::connection($connection)->create($rolesTable , function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('description')->nullable();
                $table->integer('level')->default(1);
                $table->timestamps();
                $table->softDeletes();
            });
        } else {
            Schema::table($rolesTable , function (Blueprint $table) {
                $rolesTable = config('roles.rolesTable');
                if (Schema::hasColumn($rolesTable, 'name')) {
                    $table->renameColumn('name', 'slug');
                }
                if (Schema::hasColumn($rolesTable, 'display_name')) {
                    $table->renameColumn('display_name', 'name');
                }
                if (!Schema::hasColumn($rolesTable, 'level')) {
                    $table->integer('level')->default(1);
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
        $rolesTable = config('roles.rolesTable');
        Schema::connection($connection)->dropIfExists($rolesTable);
    }
}
