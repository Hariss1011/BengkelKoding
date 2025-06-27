<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\User;
use Illuminate\Http\Request;

class RiwayatPasienController extends Controller
{
    public function index()
    {
        $pasiens = User::where('role', 'pasien')->get();
        return view('dokter.riwayat.index', compact('pasiens'));
    }

    public function show($id)
    {
        $riwayats = Periksa::with(['daftarPoli.pasien', 'daftarPoli.jadwalPeriksa.dokter', 'detailPeriksa.obat'])
            ->whereHas('daftarPoli', function ($q) use ($id) {
                $q->where('id_pasien', $id);
            })
            ->get();

        return response()->json(['riwayats' => $riwayats]);
    }

    public function detail($id)
    {
        $periksa = Periksa::with(['daftarPoli.pasien', 'daftarPoli.jadwalPeriksa.dokter', 'detailPeriksa.obat'])
            ->findOrFail($id);
        return response()->json(['periksa' => $periksa]);
    }
}
