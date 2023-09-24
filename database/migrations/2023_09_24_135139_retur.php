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
        Schema::create('retur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id'); // Penulisan Harus (Nama Tabel)_(id)
            $table->foreignId('pemesanan_id'); // Penulisan Harus (Nama Tabel)_(id)
            $table->foreignId('mobil_id'); // Penulisan Harus (Mobil)_(id)
            $table->string('nomor_retur', 14);
            $table->integer('jumlah_retur');
            $table->bigInteger('harga_total_retur');
            $table->string('status', 30)->default('Menunggu Konfirmasi');
            $table->string('alasan_retur', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retur');
    }
};
