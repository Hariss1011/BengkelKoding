@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Pasien</h3>
            <a href="{{ route('pasien.create') }}" class="btn btn-primary">Tambah Pasien</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>No. KTP</th>
                    <th>No. HP</th>
                    <th>No. RM</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pasiens as $pasien)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pasien->name }}</td>
                        <td>{{ $pasien->email }}</td>
                        <td>{{ $pasien->alamat }}</td>
                        <td>{{ $pasien->no_ktp }}</td>
                        <td>{{ $pasien->no_hp }}</td>
                        <td>{{ $pasien->no_rm }}</td>

                        <td>
                            <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-success btn-sm">Ubah</a>
                            <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
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
