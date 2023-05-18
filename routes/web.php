<?php

use App\Http\Controllers\MobilController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::resource('mobil', MobilController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('pembelian', PembelianController::class);
    Route::post('pembelian/{id}/konfirmasi', [PembelianController::class, 'informasi']);
    // Route::post('pembelian', [PembelianController::class, 'simpan']);
    Route::resource('users', UserController::class);
    Route::resource('payments', PaymentController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['role:sales']], function () {
    Route::resource('users', UserController::class);
});

require __DIR__ . '/auth.php';
