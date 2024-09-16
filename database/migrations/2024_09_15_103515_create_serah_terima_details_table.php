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
        Schema::create('serah_terima_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('serah_id');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('lokasi_awal_id');
            $table->unsignedBigInteger('lokasi_tujuan_id');
            $table->date('tanggal_serah');
            $table->date('tanggal_kembali')->nullable();
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('lokasi_awal_id')->references('id')->on('lokasis');
            $table->foreign('lokasi_tujuan_id')->references('id')->on('lokasis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serah_terima_details');
    }
};
