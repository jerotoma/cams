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
        $permissionsTable = config('roles.permissionsTable');
        $tableCheck = Schema::connection($connection)->hasTable($permissionsTable);

        if (!$tableCheck) {
            Schema::connection($connection)->create($permissionsTable, function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('description')->nullable();
                $table->string('model')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        } else {
            Schema::table($permissionsTable , function (Blueprint $table) {
                $permissionsTable = config('roles.permissionsTable');
                if (Schema::hasColumn($permissionsTable, 'name')) {
                    $table->renameColumn('name', 'slug');
                }
                if (Schema::hasColumn($permissionsTable, 'display_name')) {
                    $table->renameColumn('display_name', 'name');
                }
                if (!Schema::hasColumn($permissionsTable, 'model')) {
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
