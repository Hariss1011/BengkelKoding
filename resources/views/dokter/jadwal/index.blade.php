@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Jadwal Periksa</h4>

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span>Daftar Jadwal Periksa</span>
                <a href="{{ route('jadwal.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Jadwal Periksa
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dokter</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwals as $index => $j)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ auth()->user()->name }}</td>
                                <td>{{ $j->hari }}</td>
                                <td>{{ $j->jam_mulai }}</td>
                                <td>{{ $j->jam_selesai }}</td>
                                <td>
                                    @if ($j->status === 'Aktif')
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('jadwal.edit', $j->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
