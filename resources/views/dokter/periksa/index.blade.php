@extends('layouts.app') <!-- ganti sesuai layout kamu -->

@section('content')
    <div class="container">
        <h3>Memeriksa</h3>
        <div class="card">
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
                                <td>{{ $periksa->pasien->nama }}</td>
                                <td>
                                    <a href="{{ route('periksa.edit', $periksa->id) }}" class="btn btn-sm btn-secondary">
                                        ✏️ Edit
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
