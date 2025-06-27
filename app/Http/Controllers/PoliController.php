<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poli;

class PoliController extends Controller
{
    public function index()
    {
        $polis = Poli::all();
        return view('admin.poli.index', compact('polis'));
    }

    public function create()
    {
        return view('admin.poli.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        Poli::create($request->all());

        return redirect()->route('poli.index')->with('success', 'Data poli berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        return view('admin.poli.edit', compact('poli'));
    }

    public function update(Request $request, $id)
    {
        $poli = Poli::findOrFail($id);

        $request->validate([
            'nama_poli' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $poli->update($request->all());

        return redirect()->route('poli.index')->with('success', 'Data poli berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $poli = Poli::findOrFail($id);
        $poli->delete();

        return redirect()->route('poli.index')->with('success', 'Data poli berhasil dihapus.');
    }
}
