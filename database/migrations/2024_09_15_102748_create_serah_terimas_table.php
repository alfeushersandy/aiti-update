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
        Schema::create('serah_terimas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_input');
            $table->string('kode_serah');
            $table->string('user');
            $table->foreignId('lokasi_id')->constrained();
            $table->integer('jumlah_barang');
            $table->date('tanggal_serah');
            $table->date('tanggal_kembali')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serah_terimas');
    }
};
