<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PeriksaPasienController extends Controller
{
    public function index()
    {
        $dokters = User::where('role', 'dokter')->get();
        $periksas = Periksa::where('id_pasien', Auth::id())->with('dokter')->get();

        return view('pasien.periksa.index', compact('dokters', 'periksas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:users,id',
        ]);

        Periksa::create([
            'id_pasien' => Auth::id(),
            'id_dokter' => $request->id_dokter,
            'tgl_periksa' => now(),
            'catatan' => $request->catatan,
            'status' => 'Menunggu',
        ]);

        return redirect()->route('pasien.periksa.index')->with('success', 'Pemeriksaan berhasil ditambahkan');
    }
}
