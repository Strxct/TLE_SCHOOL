<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateTimestampsForAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = ['kinderen', 'mentoren', 'voorwerpen', 'reserveringen', 'categories', 'uitleengeschiedenis']; // Add all your table names here

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (Schema::hasColumn($tableName, 'Aanmaakdatum')) {
                    DB::statement("ALTER TABLE $tableName CHANGE COLUMN Aanmaakdatum created_at TIMESTAMP NULL");
                }
                if (!Schema::hasColumn($tableName, 'updated_at')) {
                    $table->timestamp('updated_at')->nullable();
                }
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
        $tables = ['kinderen', 'mentoren', 'voorwerpen', 'reserveringen', 'categories', 'uitleengeschiedenis']; // Add all your table names here

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (Schema::hasColumn($tableName, 'created_at')) {
                    DB::statement("ALTER TABLE $tableName CHANGE COLUMN created_at Aanmaakdatum TIMESTAMP NULL");
                }
                if (Schema::hasColumn($tableName, 'updated_at')) {
                    $table->dropColumn('updated_at');
                }
            });
        }
    }
}