@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Profil Dokter</h3>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('dokter.profil.update') }}">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $dokter->name }}" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $dokter->email }}" required>
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ $dokter->alamat }}">
            </div>

            <div class="mb-3">
                <label>No. HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ $dokter->no_hp }}">
            </div>

            <div class="mb-3">
                <label>Password Baru (kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <button class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
