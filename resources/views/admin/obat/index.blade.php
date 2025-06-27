@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Data Obat</h3>
        <a href="{{ route('obat.create') }}" class="btn btn-primary mb-3">+ Tambah Obat</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Kemasan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($obats as $index => $obat)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $obat->nama_obat }}</td>
                        <td>{{ $obat->kemasan }}</td>
                        <td>Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
