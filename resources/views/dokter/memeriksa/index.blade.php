@extends('layouts.app')

@section('title', 'Daftar Periksa Pasien')
@section('content_header_title', 'Daftar Periksa Pasien')

@section('content_body')
    <div class="card">
        <div class="card-header bg-primary text-white">
            Daftar Periksa Pasien
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>No Urut</th>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($periksas as $periksa)
                        <tr>
                            <td>{{ $periksa->daftarPoli->no_antrian ?? '-' }}</td>
                            <td>{{ $periksa->daftarPoli->pasien->name ?? '-' }}</td>
                            <td>{{ $periksa->daftarPoli->keluhan ?? '-' }}</td>
                            <td>
                                @if ($periksa->catatan || $periksa->detailPeriksa->isNotEmpty())
                                    <a href="{{ route('memeriksa.edit', $periksa->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                @else
                                    <a href="{{ route('memeriksa.show', $periksa->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-stethoscope"></i> Periksa
                                    </a>
                                @endif

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data periksa</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
