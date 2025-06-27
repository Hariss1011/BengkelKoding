<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Periksa;
use Illuminate\Support\Facades\Auth;

class DashboardDokterController extends Controller
{
    public function index()
    {
        $dokterId = Auth::id();

        // Total pasien periksa milik dokter
        $totalPasien = Periksa::where('id_dokter', $dokterId)->count();

        // Pasien yang benar-benar sudah diperiksa
        $sudahDiperiksa = Periksa::where('id_dokter', $dokterId)
            ->whereNotNull('catatan')
            ->whereHas('detailPeriksa') // harus punya obat
            ->count();

        // Sisanya berarti belum diperiksa
        $belumDiperiksa = $totalPasien - $sudahDiperiksa;

        return view('dokter.dashboard', compact('totalPasien', 'sudahDiperiksa', 'belumDiperiksa'));
    }
}
