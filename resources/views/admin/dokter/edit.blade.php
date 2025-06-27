@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Edit Dokter</h3>
        <form action="{{ route('dokter.update', $dokter->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Nama Dokter</label>
                <input type="text" name="name" class="form-control" value="{{ $dokter->name }}" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $dokter->email }}" required>
            </div>
            <div class="mb-3">
                <label>Password (Kosongkan jika tidak diubah)</label>
                <input type="password" name="password" class="form-control">
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
                <label>Poli</label>
                <select name="id_poli" class="form-control" required>
                    @foreach ($polis as $poli)
                        <option value="{{ $poli->id }}" {{ $dokter->id_poli == $poli->id ? 'selected' : '' }}>
                            {{ $poli->nama_poli }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
