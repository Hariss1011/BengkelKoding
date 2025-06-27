@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Tambah Dokter</h3>
        <form action="{{ route('dokter.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Dokter</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control">
            </div>
            <div class="mb-3">
                <label>No. HP</label>
                <input type="text" name="no_hp" class="form-control">
            </div>
            <div class="mb-3">
                <label>Poli</label>
                <select name="id_poli" class="form-control" required>
                    <option value="">Pilih Poli</option>
                    @foreach ($polis as $poli)
                        <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
