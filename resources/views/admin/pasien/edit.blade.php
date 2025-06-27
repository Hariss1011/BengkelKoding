@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Edit Pasien</h3>
        <form action="{{ route('pasien.update', $pasien->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $pasien->name }}" required>
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ $pasien->alamat }}">
            </div>

            <div class="mb-3">
                <label>No. KTP</label>
                <input type="text" name="no_ktp" class="form-control" value="{{ $pasien->no_ktp }}">
            </div>

            <div class="mb-3">
                <label>No. HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ $pasien->no_hp }}">
            </div>

            <div class="mb-3">
                <label>No. RM</label>
                <input type="text" class="form-control" value="{{ $pasien->no_rm }}" readonly>
            </div>


            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $pasien->email }}" required>
            </div>

            <div class="mb-3">
                <label>Password (kosongkan jika tidak ingin mengganti)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
