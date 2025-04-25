<?php

namespace App\Http\Controllers;

use App\Models\DetailPeriksa;
use App\Models\Periksa;
use App\Models\Obat;
use Illuminate\Http\Request;

class DetailPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $periksa = Periksa::with('detailPeriksa.obat')->findOrFail($id);
        $obats = Obat::all();

        return view('dokter.periksa.detail', compact('periksa', 'obats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'id_obat' => 'required|exists:obats,id',
        ]);

        DetailPeriksa::create([
            'id_periksa' => $id,
            'id_obat' => $request->id_obat,
        ]);
        return redirect()->route('detail-periksa.index', $id);
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailPeriksa $detailPeriksa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailPeriksa $detailPeriksa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailPeriksa $detailPeriksa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detail = DetailPeriksa::findOrFail($id);
        $detail->delete();

        return back();
    }
}
