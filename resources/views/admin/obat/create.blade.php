@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Tambah Obat</h3>
        <form action="{{ route('obat.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Obat</label>
                <input type="text" name="nama_obat" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Kemasan</label>
                <input type="text" name="kemasan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
