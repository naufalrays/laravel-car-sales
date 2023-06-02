<?php

use App\Http\Controllers\MobilController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenjualanController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::resource('mobil', MobilController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('pemesanan', PemesananController::class);
    Route::post('pemesanan/{id}/konfirmasi', [PemesananController::class, 'informasi']);
    Route::get('pemesanan/{id}/konfirmasiPembayaran', [PemesananController::class, 'konfirmasiPembayaran'])->name('pemesanan.konfirmasiPembayaran');
    Route::get('pemesanan/{id}/konfirmasiPembayaran/{bool}', [PemesananController::class, 'updateKonfirmasiPembayaran'])->name('pemesanan.updateKonfirmasiPembayaran');
    Route::get('pemesanan/cetak/{id}', [PemesananController::class, 'cetakInvoice'])->name('pemesanan.cetakInvoice');
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
    Route::post('penjualan/cetakLaporan', [PenjualanController::class, 'cetakLaporan'])->name('penjualan.cetakLaporan');
});

require __DIR__ . '/auth.php';
