<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPeriksa::where('id_dokter', Auth::id())->get();
        return view('dokter.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        return view('dokter.jadwal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        JadwalPeriksa::create([
            'id_dokter' => Auth::id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => 'Tidak Aktif',
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
        return view('dokter.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        // Jika akan diubah menjadi Aktif, maka nonaktifkan semua jadwal lain milik dokter ini
        if ($request->status === 'Aktif') {
            JadwalPeriksa::where('id_dokter', $jadwal->id_dokter)
                ->where('id', '!=', $jadwal->id)
                ->update(['status' => 'Tidak Aktif']);
        }

        // Update jadwal yang dipilih
        $jadwal->update([
            'status' => $request->status,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Status jadwal diperbarui.');
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
