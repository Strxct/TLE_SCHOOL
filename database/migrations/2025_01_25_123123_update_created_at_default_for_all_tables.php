<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateCreatedAtDefaultForAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = ['kinderen', 'mentoren', 'voorwerpen', 'reserveringen', 'categories', 'uitleengeschiedenis'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (Schema::hasColumn($tableName, 'created_at')) {
                    DB::statement("ALTER TABLE $tableName MODIFY COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
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
        $tables = ['kinderen', 'mentoren', 'voorwerpen', 'reserveringen', 'categories', 'uitleengeschiedenis'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (Schema::hasColumn($tableName, 'created_at')) {
                    DB::statement("ALTER TABLE $tableName MODIFY COLUMN created_at TIMESTAMP NULL DEFAULT NULL");
                }
            });
        }
    }
}