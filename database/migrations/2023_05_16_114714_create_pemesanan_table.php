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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id'); // Penulisan Harus (Nama Tabel)_(id)
            $table->foreignId('mobil_id'); // Penulisan Harus (Mobil)_(id)
            $table->string('nama_penerima', 50);
            $table->string('nomor_penerima', 14);
            $table->string('alamat_penerima', 120);
            $table->integer('jumlah');
            $table->bigInteger('harga_total');
            $table->string('status', 30)->default('Menunggu Pembayaran');
            $table->string('alasan_gagal', 255)->nullable();
            $table->string('gambar', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
