<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeColumnsNullableInVoorwerpenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voorwerpen', function (Blueprint $table) {
            $table->text('Notities')->nullable()->change();
            $table->text('Beschrijving')->nullable()->change();
            $table->string('Foto')->nullable()->change();
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
            $table->text('Notities')->nullable(false)->change();
            $table->text('Beschrijving')->nullable(false)->change();
            $table->string('Foto')->nullable(false)->change();
        });
    }
}
