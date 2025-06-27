<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use App\Models\Periksa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DaftarPoliController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $no_rm = $user->no_rm;
        $polis = Poli::all();
        $jadwals = JadwalPeriksa::with('dokter')->get();

        $riwayats = DaftarPoli::with(['jadwal.dokter.poli'])
            ->where('id_pasien', $user->id)
            ->latest()
            ->get();

        return view('pasien.poli.index', compact('no_rm', 'polis', 'jadwals', 'riwayats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'nullable|string|max:255',
        ]);

        $id_pasien = Auth::id();
        $no_antrian = DaftarPoli::where('id_jadwal', $request->id_jadwal)->count() + 1;

        $daftar = DaftarPoli::create([
            'id_pasien' => $id_pasien,
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $no_antrian,
        ]);

        // Buat entri ke tabel periksas
        Periksa::create([
            'id_daftar_poli' => $daftar->id,
            'id_pasien' => Auth::id(),
            'id_dokter' => $daftar->jadwal->id_dokter, // gunakan relasi 'jadwal' dari DaftarPoli
            'tgl_periksa' => Carbon::now()->format('Y-m-d'),
            'catatan' => '',
            'biaya_periksa' => 0,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil.');
    }


    public function destroy($id)
    {
        $daftar = DaftarPoli::findOrFail($id);

        if ($daftar->id_pasien == Auth::id()) {
            $daftar->delete();
            return redirect()->back()->with('success', 'Pendaftaran berhasil dibatalkan.');
        }

        return redirect()->back()->with('error', 'Gagal membatalkan pendaftaran.');
    }

    public function getJadwalByPoli($id)
    {
        $jadwals = \App\Models\JadwalPeriksa::with('dokter')
            ->whereHas('dokter', function ($q) use ($id) {
                $q->where('id_poli', $id);
            })->get();

        return response()->json($jadwals);
    }
}
