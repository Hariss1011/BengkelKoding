@extends('layouts.app') <!-- ganti sesuai layout kamu -->

@section('content')
    <div class="container">
        <h3>Memeriksa</h3>
        <div class="card">
            <form action="{{ route('periksa.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama pasien..."
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>
            <div class="card-header bg-primary text-white">
                Daftar Periksa Pasien
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($periksas as $periksa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $periksa->pasien->name }}</td>
                                <td>
                                    <a href="{{ route('periksa.edit', $periksa->id) }}" class="btn btn-sm btn-secondary">
                                        ✏️ Edit
                                    </a>
                                    <a href="{{ route('detail-periksa.index', $periksa->id) }}"
                                        class="btn btn-info btn-sm">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
