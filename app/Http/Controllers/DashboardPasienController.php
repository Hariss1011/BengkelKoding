<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Poli;

class DashboardPasienController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $jumlahPendaftaran = DaftarPoli::where('id_pasien', $userId)->count();
        $jumlahJadwal = JadwalPeriksa::count();
        $jumlahPoli = Poli::count();

        return view('pasien.dashboard', compact(
            'jumlahPendaftaran',
            'jumlahJadwal',
            'jumlahPoli'
        ));
    }
}
