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
        Schema::create('pembelian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_akun');
            $table->foreignId('id_mobil');
            $table->string('nama_penerima');
            $table->string('nomor_penerima');
            $table->string('alamat_penerima');
            $table->integer('jumlah');
            $table->bigInteger('harga_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian');
    }
};
