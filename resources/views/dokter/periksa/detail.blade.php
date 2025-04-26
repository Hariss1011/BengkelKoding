@extends('layouts.app')

@section('content')
    <div class="card">
        <h3>Detail Pemeriksaan untuk: {{ $periksa->pasien->name }}</h3>
        <div class="card-header bg-primary text-white">
            Tambahkan Obat
        </div>
        <div class="card-body">
            <form action="{{ route('detail-periksa.store', $periksa->id) }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-8">
                    <select name="id_obat" class="form-control" required>
                        <option value="">-- Pilih Obat --</option>
                        @foreach ($obats as $obat)
                            <option value="{{ $obat->id }}">{{ $obat->name_obat }} ({{ $obat->kemasan }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-success" type="submit">Tambah Obat</button>
                </div>
            </form>

            <hr>

            <h5>Daftar Obat</h5>
            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>Nama Obat</th>
                        <th>Kemasan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($periksa->detailPeriksa as $detail)
                        <tr>
                            <td>{{ $detail->obat->name_obat }}</td>
                            <td>{{ $detail->obat->kemasan }}</td>
                            <td>
                                <form action="{{ route('detail-periksa.destroy', $detail->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus obat ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada obat</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <hr>
            <a href="{{ route('periksa.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
