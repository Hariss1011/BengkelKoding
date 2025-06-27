<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DashboardDokterController;
use App\Http\Controllers\JadwalPeriksaController;
use App\Http\Controllers\MemeriksaPasienController;
use App\Http\Controllers\RiwayatPasienController;
use App\Http\Controllers\ProfilDokterController;
use App\Http\Controllers\DashboardPasienController;
use App\Http\Controllers\DaftarPoliController;



/* ====================
| Admin Routes
==================== */

Route::prefix('admin')->middleware(['auth',])->group(function () {
    Route::get('/', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('dokter', DokterController::class);
    Route::resource('pasien', PasienController::class);
    Route::resource('poli', PoliController::class);
    Route::resource('obat', ObatController::class);
});

/* ====================
| Dokter Routes
==================== */

Route::prefix('dokter')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardDokterController::class, 'index'])->name('dokter.dashboard');

    Route::resource('jadwal', JadwalPeriksaController::class);
    Route::resource('memeriksa', MemeriksaPasienController::class);


    Route::get('/memeriksa', [MemeriksaPasienController::class, 'index'])->name('memeriksa.index');
    Route::get('/memeriksa/{id}', [MemeriksaPasienController::class, 'show'])->name('memeriksa.show');
    Route::get('/memeriksa/{id}/edit', [MemeriksaPasienController::class, 'edit'])->name('memeriksa.edit');
    Route::put('/memeriksa/{id}', [MemeriksaPasienController::class, 'update'])->name('memeriksa.update');


    Route::get('/riwayat-pasien', [RiwayatPasienController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat-pasien/{id}', [RiwayatPasienController::class, 'show']);



    Route::get('/profil', [ProfilDokterController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilDokterController::class, 'update'])->name('dokter.profil.update');
});

/* ====================
| Pasien Routes
==================== */
Route::middleware(['auth'])->prefix('pasien')->group(function () {
    Route::get('/', [DashboardPasienController::class, 'index'])->name('pasien.dashboard');

    Route::get('/poli', [DaftarPoliController::class, 'index'])->name('pasien.poli.index');
    Route::post('/poli', [DaftarPoliController::class, 'store'])->name('pasien.poli.store');
    Route::delete('/poli/{id}', [DaftarPoliController::class, 'destroy'])->name('pasien.poli.destroy');

    Route::get('/jadwal-periksa/poli/{id}', [DaftarPoliController::class, 'getJadwalByPoli']);
});

Route::get('/jadwal-periksa/poli/{id}', [JadwalPeriksaController::class, 'getJadwalByPoli']);
Route::get('/riwayat/detail/{id}', [RiwayatPasienController::class, 'detail']);

/* ====================
| Auth & Redirect
==================== */
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// kamu bisa hapus jika tidak pakai /home lagi:
// Route::get('/home', [HomeController::class, 'index'])->name('home');
