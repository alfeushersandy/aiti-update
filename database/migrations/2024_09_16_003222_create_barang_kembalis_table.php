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
        Schema::create('barang_kembalis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('serah_terima_id')->constrained();
            $table->foreignId('serah_terima_detail_id')->constrained();
            $table->enum('status', ['Kembali', 'Kembali Rusak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_kembalis');
    }
};
