@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Poli</h3>
        <div class="card">
            <div class="card-header bg-primary text-white">
                Daftar Poli
                <a href="{{ route('poli.create') }}" class="btn btn-success btn-sm float-end">+ Tambah Poli</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Poli</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($polis as $key => $poli)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $poli->nama_poli }}</td>
                                <td>{{ $poli->keterangan }}</td>
                                <td>
                                    <a href="{{ route('poli.edit', $poli->id) }}" class="btn btn-success btn-sm">Ubah</a>
                                    <form action="{{ route('poli.destroy', $poli->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
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
