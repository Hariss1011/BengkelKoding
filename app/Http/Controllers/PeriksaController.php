<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokterId = Auth::id();
        $query = Periksa::with(['pasien', 'dokter'])
            ->where('id_dokter', $dokterId);

        if (request()->has('search') && request('search') !== '') {
            $query->whereHas('pasien', function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%');
            });
        }

        $periksas = $query->get();
        return view('dokter.periksa.index', compact('periksas'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create() {}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required',
            'id_dokter' => 'required',
            'tgl_periksa' => 'required',
            'catatan' => 'nullable',
            'biaya_periksa' => 'nullable|integer',
        ]);

        Periksa::create($request->all());

        return redirect()->route('periksa.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Periksa $periksa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periksa $periksa)
    {
        return view('dokter.periksa.edit', compact('periksa'));
    }


    public function update(Request $request, Periksa $periksa)
    {
        $request->validate([
            'tgl_periksa' => 'required',
            'catatan' => 'nullable',
            'biaya_periksa' => 'nullable|integer',
        ]);

        $periksa->update($request->only(['tgl_periksa', 'catatan', 'biaya_periksa']));

        return redirect()->route('periksa.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periksa $periksa)
    {
        $periksa->delete();
        return redirect()->route('periksa.index');
    }
}
