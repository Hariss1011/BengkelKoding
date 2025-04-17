<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\ObatController;

Route::prefix('dokter')->group(function () {
    Route::resource('obat', ObatController::class);
    Route::resource('periksa', PeriksaController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dokter', [HomeController::class, 'dokter'])->name('dokter');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
