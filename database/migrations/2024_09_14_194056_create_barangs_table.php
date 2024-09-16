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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('kode_barang_lama')->nullable();
            $table->foreignId('category_id')->constrained();
            $table->string('merek')->nullable();
            $table->string('tipe')->nullable();
            $table->foreignId('lokasi_id')->constrained();
            $table->string('user')->nullable();
            $table->string('mainboard')->nullable();
            $table->string('prosesor')->nullable();
            $table->string('memori')->nullable();
            $table->string('vga')->nullable();
            $table->string('sound')->nullable();
            $table->string('network')->nullable();
            $table->boolean('keyboard')->nullable();
            $table->boolean('mouse')->nullable();
            $table->string('os')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
