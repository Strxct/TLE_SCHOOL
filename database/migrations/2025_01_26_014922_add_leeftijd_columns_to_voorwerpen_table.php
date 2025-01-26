<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeeftijdColumnsToVoorwerpenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voorwerpen', function (Blueprint $table) {
            $table->integer('leeftijd_van')->nullable();
            $table->integer('leeftijd_tot')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voorwerpen', function (Blueprint $table) {
            $table->dropColumn(['leeftijd_van', 'leeftijd_tot']);
        });
    }
}
