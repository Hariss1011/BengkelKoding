<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\DetailPeriksaController;
use App\Http\Controllers\PeriksaPasienController;

/* ====================
| Dokter Routes
==================== */

Route::prefix('dokter')->middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'dokter'])->name('dokter');
    Route::resource('obat', ObatController::class);
    Route::resource('periksa', PeriksaController::class);
    Route::get('/dokter/periksa/{periksa}/periksa', [PeriksaController::class, 'show'])->name('periksa.show');
    Route::get('/detail-periksa/{id}', [DetailPeriksaController::class, 'index'])->name('detail-periksa.index');
    Route::post('/detail-periksa/{id}', [DetailPeriksaController::class, 'store'])->name('detail-periksa.store');
    Route::delete('/detail-periksa/{id}', [DetailPeriksaController::class, 'destroy'])->name('detail-periksa.destroy');
});

/* ====================
| Pasien Routes
==================== */
Route::middleware(['auth'])->prefix('pasien')->group(function () {
    Route::get('/', [HomeController::class, 'pasien'])->name('pasien');
    Route::get('/periksa', [PeriksaPasienController::class, 'index'])->name('pasien.periksa.index');
    Route::post('/periksa', [PeriksaPasienController::class, 'store'])->name('pasien.periksa.store');
});

/* ====================
| Auth & Redirect
==================== */
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// kamu bisa hapus jika tidak pakai /home lagi:
// Route::get('/home', [HomeController::class, 'index'])->name('home');
