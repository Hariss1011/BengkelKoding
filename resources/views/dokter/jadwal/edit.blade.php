@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Edit Jadwal Periksa</h4>

        <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Hari</label>
                <input type="text" class="form-control" value="{{ $jadwal->hari }}" readonly>
            </div>
            <div class="mb-3">
                <label>Jam Mulai</label>
                <input type="text" class="form-control" value="{{ $jadwal->jam_mulai }}" readonly>
            </div>
            <div class="mb-3">
                <label>Jam Selesai</label>
                <input type="text" class="form-control" value="{{ $jadwal->jam_selesai }}" readonly>
            </div>

            <div class="mb-3">
                <label>Status</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" name="status" value="Aktif" {{ $jadwal->status == 'Aktif' ? 'checked' : '' }}
                        class="form-check-input">
                    <label class="form-check-label">Aktif</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="status" value="Tidak Aktif"
                        {{ $jadwal->status == 'Tidak Aktif' ? 'checked' : '' }} class="form-check-input">
                    <label class="form-check-label">Tidak Aktif</label>
                </div>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
