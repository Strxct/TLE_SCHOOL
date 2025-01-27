<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyVoorwerpenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voorwerpen', function (Blueprint $table) {
            $table->uuid('QRUUID')->nullable()->after('QR');
            $table->dropColumn('QR');
            $table->foreign('QRUUID')->references('UUID')->on('qrs')->onDelete('cascade');
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
            $table->dropForeign(['QRUUID']);
            $table->dropColumn('QRUUID');
            $table->string('QR')->after('QRUUID');
        });
    }
}