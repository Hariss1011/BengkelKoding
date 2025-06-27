<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\DetailPeriksa;
use Illuminate\Support\Facades\Auth;

class MemeriksaPasienController extends Controller
{
    public function index(Request $request)
    {
        $dokterId = Auth::id();

        $query = Periksa::with(['daftarPoli.pasien'])
            ->whereHas('daftarPoli', function ($q) use ($dokterId) {
                $q->whereHas('jadwalPeriksa', function ($j) use ($dokterId) {
                    $j->where('id_dokter', $dokterId);
                });
            });

        if ($request->filled('search')) {
            $query->whereHas('daftarPoli', function ($q) use ($request) {
                $q->whereHas('pasien', function ($p) use ($request) {
                    $p->where('nama', 'like', '%' . $request->search . '%');
                });
            });
        }

        $periksas = $query->get();

        return view('dokter.memeriksa.index', compact('periksas'));
    }

    public function show($id)
    {
        $periksa = Periksa::with('daftarPoli.pasien')->findOrFail($id);
        $obats = Obat::all();
        return view('dokter.memeriksa.show', compact('periksa', 'obats'));
    }

    public function edit($id)
    {
        $periksa = Periksa::with(['daftarPoli.pasien', 'detailPeriksa'])->findOrFail($id);
        $obats = Obat::all();
        $selectedObatIds = $periksa->detailPeriksa->pluck('id_obat')->toArray();
        return view('dokter.memeriksa.edit', compact('periksa', 'obats'));
    }

    public function update(Request $request, $id)
    {
        $periksa = Periksa::findOrFail($id);

        $request->validate([
            'catatan' => 'nullable|string',
            'obat' => 'nullable|array',
        ]);

        // Hapus data sebelumnya
        DetailPeriksa::where('id_periksa', $periksa->id)->delete();

        $totalObat = 0;
        if ($request->has('obat')) {
            foreach ($request->obat as $id_obat) {
                $obat = Obat::find($id_obat);
                if ($obat) {
                    DetailPeriksa::create([
                        'id_periksa' => $periksa->id,
                        'id_obat' => $id_obat
                    ]);
                    $totalObat += $obat->harga;
                }
            }
        }

        $periksa->update([
            'tgl_periksa' => now(),
            'catatan' => $request->catatan,
            'biaya_periksa' => 100000 + $totalObat
        ]);

        return redirect()->route('memeriksa.index')->with('success', 'Data periksa berhasil diperbarui.');
    }
}
