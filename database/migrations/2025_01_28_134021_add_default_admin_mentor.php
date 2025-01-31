<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AddDefaultAdminMentor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('mentoren')->insert([
            'UUID' => Str::uuid(),
            'email' => 'admin@gmail.com',
            'wachtwoord' => Hash::make('admin'),
            'voornaam' => 'Admin',
            'achternaam' => 'Admin',
            'admin' => 1, // Assuming you have an is_admin column to indicate admin status
            'created_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('mentoren')->where('email', 'admin@gmail.com')->delete();
    }
}