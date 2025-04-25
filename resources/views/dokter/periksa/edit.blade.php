@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Edit Pemeriksaan</h3>
        <form action="{{ route('periksa.update', $periksa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Pasien</label>
                <input type="text" value="{{ $periksa->pasien->name }}" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label>Tanggal Periksa</label>
                <input type="datetime-local" name="tgl_periksa" value="{{ old('tgl_periksa', $periksa->tgl_periksa) }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control">{{ old('catatan', $periksa->catatan) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Biaya Periksa</label>
                <input type="number" name="biaya_periksa" value="{{ old('biaya_periksa', $periksa->biaya_periksa) }}"
                    class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('periksa.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
