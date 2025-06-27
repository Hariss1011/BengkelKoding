@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Tambah Jadwal Periksa</h4>
        <form action="{{ route('jadwal.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="hari">Hari</label>
                <select name="hari" class="form-control" required>
                    <option value="">-- Pilih Hari --</option>
                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                        <option value="{{ $hari }}">{{ $hari }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" required>
            </div>



            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
