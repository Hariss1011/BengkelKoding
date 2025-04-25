@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Detail Pemeriksaan untuk: {{ $periksa->pasien->name }}</h3>

        <form action="{{ route('detail-periksa.store', $periksa->id) }}" method="POST" class="mb-3">
            @csrf
            <label>Tambah Obat:</label>
            <select name="id_obat" class="form-select mb-2" required>
                <option value="">-- Pilih Obat --</option>
                @foreach ($obats as $obat)
                    <option value="{{ $obat->id }}">{{ $obat->name_obat }} - {{ $obat->kemasan }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary btn-sm">Tambah</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Obat</th>
                    <th>Kemasan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($periksa->detailPeriksa as $detail)
                    <tr>
                        <td>{{ $detail->obat->name_obat }}</td>
                        <td>{{ $detail->obat->kemasan }}</td>
                        <td>
                            <form action="{{ route('detail-periksa.destroy', $detail->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus obat ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('periksa.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
