<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUitgeleendToUitleengeschiedenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uitleengeschiedenis', function (Blueprint $table) {
            $table->tinyInteger('Uitgeleend')->default(0)->after('Uitleendatum'); // Replace 'existing_column' with the actual column name after which you want to add 'Uitgeleend'
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
            $table->dropColumn('Uitgeleend');
        });
    }
}
