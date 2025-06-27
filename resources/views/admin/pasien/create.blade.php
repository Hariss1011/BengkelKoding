@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Tambah Pasien</h3>
        <form action="{{ route('pasien.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama</label>
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
                <label>No. KTP</label>
                <input type="text" name="no_ktp" class="form-control">
            </div>

            <div class="mb-3">
                <label>No. HP</label>
                <input type="text" name="no_hp" class="form-control">
            </div>

            <div class="mb-3">
                <label>No. RM (Akan diisi otomatis)</label>
                <input type="text" class="form-control" value="Otomatis" readonly>
            </div>


            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
