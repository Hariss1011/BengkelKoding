<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = User::where('role', 'pasien')->get();
        return view('admin.pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('admin.pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'alamat'   => 'nullable|string',
            'no_ktp'   => 'nullable|string|max:20',
            'no_hp'    => 'nullable|string|max:15',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Format tanggal sekarang: 202506
        $kodeTanggal = now()->format('Ym'); // Tahun+Bulan

        // Hitung jumlah pasien bulan ini
        $jumlahPasienBulanIni = User::where('role', 'pasien')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count() + 1;

        // Buat kode no_rm
        $no_rm = 'RM' . $kodeTanggal . str_pad($jumlahPasienBulanIni, 4, '0', STR_PAD_LEFT);

        User::create([
            'name'     => $request->name,
            'alamat'   => $request->alamat,
            'no_ktp'   => $request->no_ktp,
            'no_hp'    => $request->no_hp,
            'no_rm'    => $no_rm,
            'email'    => $request->email,
            'role'     => 'pasien',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $pasien = User::findOrFail($id);
        return view('admin.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $pasien = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:100',
            'alamat'   => 'nullable|string',
            'no_ktp'   => 'nullable|string|max:20',
            'no_hp'    => 'nullable|string|max:15',
            'no_rm'    => 'required|string|max:20|unique:users,no_rm,' . $id,
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $data = $request->only(['name', 'alamat', 'no_ktp', 'no_hp', 'no_rm', 'email']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pasien->update($data);

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pasien = User::findOrFail($id);
        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil dihapus.');
    }
}
