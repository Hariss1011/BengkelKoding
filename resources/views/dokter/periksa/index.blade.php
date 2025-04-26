@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Periksa</h3>

        <div class="card">
            {{-- Header biru --}}
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span>Daftar Pemeriksaan</span>
                <form action="{{ route('periksa.index') }}" method="GET" class="d-flex" style="width: 300px;">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama pasien..."
                        value="{{ request('search') }}">
                    <button class="btn btn-light btn-sm ms-2" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            {{-- Isi Tabel --}}
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Periksa</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Obat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($periksas as $periksa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d/m/Y') }}</td>
                                <td>{{ $periksa->pasien->name ?? '-' }}</td>
                                <td>{{ $periksa->dokter->name ?? '-' }}</td>
                                <td>
                                    @if ($periksa->detailPeriksa->isEmpty())
                                        Tidak ada
                                    @else
                                        Ada Obat
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('periksa.edit', $periksa->id) }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('detail-periksa.index', $periksa->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-info-circle"></i> Detail
                                    </a>
                                    <a href="{{ route('periksa.show', $periksa->id) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-stethoscope"></i> Periksa
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data pemeriksaan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
