<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilDokterController extends Controller
{
    public function edit()
    {
        $dokter = Auth::user();
        return view('dokter.profil.edit', compact('dokter'));
    }

    public function update(Request $request)
    {
        $dokter = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $dokter->id,
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'password' => 'nullable|string|min:6',
        ]);

        $dokter->name = $request->name;
        $dokter->email = $request->email;
        $dokter->alamat = $request->alamat;
        $dokter->no_hp = $request->no_hp;

        if ($request->filled('password')) {
            $dokter->password = Hash::make($request->password);
        }

        $dokter->save();

        return redirect()->route('profil.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
