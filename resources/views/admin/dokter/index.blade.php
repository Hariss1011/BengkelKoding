@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Dokter</h3>
        <a href="{{ route('dokter.create') }}" class="btn btn-primary mb-3">+ Tambah Dokter</a>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Poli</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokters as $dokter)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dokter->name }}</td>
                                <td>{{ $dokter->email }}</td>
                                <td>{{ $dokter->no_hp }}</td>
                                <td>{{ $dokter->poli->nama_poli ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Hapus dokter ini?')"
                                            class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
