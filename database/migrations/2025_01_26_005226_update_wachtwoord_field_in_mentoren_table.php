<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWachtwoordFieldInMentorenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mentoren', function (Blueprint $table) {
            $table->string('Wachtwoord', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mentoren', function (Blueprint $table) {
            // Change the column back to its previous state if necessary
            // Assuming the previous state was VARCHAR(100)
            $table->string('Wachtwoord', 100)->change();
        });
    }
}