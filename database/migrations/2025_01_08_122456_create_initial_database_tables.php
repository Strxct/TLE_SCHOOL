<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateInitialDatabaseTables extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('UUID')->primary();
            $table->string('Naam', 50);
            $table->timestamp('Aanmaakdatum')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::create('mentoren', function (Blueprint $table) {
            $table->uuid('UUID')->primary();
            $table->string('Voornaam', 50);
            $table->string('Achternaam', 50);
            $table->string('Email', 50)->unique();
            $table->string('Wachtwoord', 255);
            $table->boolean('Admin');
            $table->timestamp('Aanmaakdatum')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::create('kinderen', function (Blueprint $table) {
            $table->uuid('UUID')->primary();
            $table->uuid('MentorUUID');
            $table->string('Voornaam', 50);
            $table->string('Achternaam', 50);
            $table->date('Geboortedatum');
            $table->string('Contact', 50);
            $table->timestamp('Aanmaakdatum')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('MentorUUID')->references('UUID')->on('mentoren')->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::create('voorwerpen', function (Blueprint $table) {
            $table->uuid('UUID')->primary();
            $table->uuid('CategorieUUID');
            $table->string('Naam', 100);
            $table->text('Beschrijving');
            $table->text('Notities');
            $table->string('QR', 255);
            $table->string('Foto', 255);
            $table->boolean('Actief');
            $table->timestamp('Aanmaakdatum')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('CategorieUUID')->references('UUID')->on('categories')->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::create('reserveringen', function (Blueprint $table) {
            $table->uuid('UUID')->primary();
            $table->uuid('MentorUUID');
            $table->uuid('VoorwerpUUID');
            $table->timestamp('Aanmaakdatum')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('MentorUUID')->references('UUID')->on('mentoren')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('VoorwerpUUID')->references('UUID')->on('voorwerpen')->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::create('uitleengeschiedenis', function (Blueprint $table) {
            $table->uuid('UUID')->primary();
            $table->uuid('VoorwerpUUID');
            $table->uuid('KindUUID');
            $table->timestamp('Uitleendatum');
            $table->timestamp('Aanmaakdatum')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('VoorwerpUUID')->references('UUID')->on('voorwerpen')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('KindUUID')->references('UUID')->on('kinderen')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('voorwerpen');
        Schema::dropIfExists('uitleengeschiedenis');
        Schema::dropIfExists('reserveringen');
        Schema::dropIfExists('mentoren');
        Schema::dropIfExists('kinderen');
        Schema::dropIfExists('categories');
    }
}
