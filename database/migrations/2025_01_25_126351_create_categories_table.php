<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert the specified categories
        DB::table('categories')->insert([
            ['UUID' => (string) Str::uuid(), 'Naam' => 'Taal'],
            ['UUID' => (string) Str::uuid(), 'Naam' => 'Rekenen'],
            ['UUID' => (string) Str::uuid(), 'Naam' => 'Socialemotioneel'],
            ['UUID' => (string) Str::uuid(), 'Naam' => 'Motoriek'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}