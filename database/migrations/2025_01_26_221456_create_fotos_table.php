<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotosTable extends Migration
{
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->uuid('UUID')->primary();
            $table->mediumText('Foto');
            $table->timestamps();
        });

        Schema::table('voorwerpen', function (Blueprint $table) {
            $table->dropColumn('Foto'); // Drop the existing Foto column
            $table->uuid('FotoUUID')->nullable()->after('QR');
            $table->foreign('FotoUUID')->references('UUID')->on('fotos')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('voorwerpen', function (Blueprint $table) {
            $table->dropForeign(['FotoUUID']);
            $table->dropColumn('FotoUUID');
            $table->string('Foto')->nullable(); // Re-add the Foto column
        });

        Schema::dropIfExists('fotos');
    }
}