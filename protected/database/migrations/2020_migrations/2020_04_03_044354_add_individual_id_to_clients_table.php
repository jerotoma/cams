<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndividualIdToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('clients', function (Blueprint $table) {
            if (!Schema::hasColumn($table, 'individual_id')) {
                $table->string('individual_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('clients', function (Blueprint $table) {
            if (Schema::hasColumn($table, 'individual_id')) {
                $table->dropColumn('individual_id');
            }
        });
    }
}
