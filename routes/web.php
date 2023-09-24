<?php

use App\Http\Controllers\MobilController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ReturController;
use App\Models\LaporanPenjualan;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::resource('mobil', MobilController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('pemesanan', PemesananController::class);
    Route::resource('retur', ReturController::class);
    Route::post('pemesanan/{id}/konfirmasi', [PemesananController::class, 'informasi']);
    Route::get('pemesanan/{id}/konfirmasiPembayaran', [PemesananController::class, 'konfirmasiPembayaran'])->name('pemesanan.konfirmasiPembayaran');
    Route::post('pemesanan/{id}/konfirmasiPembayaran', [PemesananController::class, 'updateKonfirmasiPembayaran'])->name('pemesanan.updateKonfirmasiPembayaran');
    Route::get('pemesanan/{id}/konfirmasiRetur', [PemesananController::class, 'konfirmasiRetur'])->name('pemesanan.konfirmasiRetur');
    Route::post('pemesanan/{id}/konfirmasiRetur', [PemesananController::class, 'updateKonfirmasiRetur'])->name('pemesanan.updateKonfirmasiRetur');
    Route::get('pemesanan/cetak/{id}', [PemesananController::class, 'cetakInvoice'])->name('pemesanan.cetakInvoice');
    Route::get('pemesanan/batalkanRetur/{id}', [PemesananController::class, 'batalkanRetur'])->name('pemesanan.batalkanRetur');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(LaporanController::class)->group(function () {
    Route::get('/laporan', 'index')->name('laporan.index');
    Route::get('/laporan/show', 'show')->name('laporan.show');
});

Route::group(['middleware' => ['role:sales']], function () {
    Route::resource('users', UserController::class);
    Route::resource('penjualan', PenjualanController::class);
    Route::get('cetakLaporan/{id}', [LaporanController::class, 'cetakLaporanPenjualan'])->name('laporanPenjualan.cetak');
    Route::get('jurnal', [JurnalController::class, 'index'])->name('jurnal.index');
    Route::post('penjualan/cetakLaporan', [PenjualanController::class, 'cetakLaporan'])->name('penjualan.cetakLaporan');
});

require __DIR__ . '/auth.php';
