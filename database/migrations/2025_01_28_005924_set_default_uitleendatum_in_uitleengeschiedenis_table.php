<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SetDefaultUitleendatumInUitleengeschiedenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uitleengeschiedenis', function (Blueprint $table) {
            $table->timestamp('Uitleendatum')->default(DB::raw('CURRENT_TIMESTAMP'))->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uitleengeschiedenis', function (Blueprint $table) {
            $table->date('Uitleendatum')->default(null)->change();
        });
    }
}