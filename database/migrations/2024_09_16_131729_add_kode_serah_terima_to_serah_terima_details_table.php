<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('serah_terima_details', function (Blueprint $table) {
            $table->string('kode_serah_terima')->nullable()->after('serah_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('serah_terima_details', function (Blueprint $table) {
            $table->dropColumn('kode_serah_terima');
        });
    }
};
