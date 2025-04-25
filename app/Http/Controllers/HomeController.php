<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\User;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // fungsi fallback jika pakai /home
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'dokter') {
            return redirect('/dokter');
        } elseif ($user->role == 'pasien') {
            return redirect('/pasien');
        }

        return view('home'); // fallback
    }

    // === DASHBOARD DOKTER ===
    public function dokter()
    {
        $user = Auth::user();

        $totalPeriksa = Periksa::where('id_dokter', $user->id)->count();
        $totalPasien = Periksa::where('id_dokter', $user->id)->distinct('id_pasien')->count();
        $totalObat = Obat::count();

        return view('dokter.index', compact('totalPeriksa', 'totalPasien', 'totalObat'));
    }

    // === DASHBOARD PASIEN ===
    public function pasien()
    {
        $totalPeriksa = Periksa::where('id_pasien', Auth::id())->count();
        $totalDokter = User::where('role', 'dokter')->count();

        return view('pasien.index', compact('totalPeriksa', 'totalDokter'));
    }
}
