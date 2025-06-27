<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poli;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = User::where('role', 'dokter')->get();
        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        $polis = Poli::all();
        return view('admin.dokter.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'id_poli' => 'required|exists:polis,id',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'id_poli' => $request->id_poli,
            'role' => 'dokter',
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dokter = User::findOrFail($id);
        $polis = Poli::all();
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    public function update(Request $request, $id)
    {
        $dokter = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'id_poli' => 'required|exists:polis,id',
            'password' => 'nullable|string|min:6',
        ]);

        $data = $request->only(['name', 'email', 'alamat', 'no_hp', 'id_poli']);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $dokter->update($data);

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $dokter = User::findOrFail($id);
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil dihapus.');
    }
}
