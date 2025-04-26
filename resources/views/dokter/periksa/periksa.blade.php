@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Pemeriksaan Pasien</h4>

        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('periksa.update', $periksa->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Nama Pasien</label>
                        <input type="text" class="form-control" value="{{ $periksa->pasien->name }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Periksa</label>
                        <input type="datetime-local" name="tgl_periksa" class="form-control"
                            value="{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('Y-m-d\TH:i') }}">
                    </div>

                    <div class="mb-3">
                        <label>Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3">{{ $periksa->catatan }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>Biaya Periksa (Rp)</label>
                        <input type="number" name="biaya_periksa" class="form-control"
                            value="{{ $periksa->biaya_periksa }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Pemeriksaan</button>
                </form>
            </div>
        </div>

        <div class="card">
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
            </div>
        </div>
    </div>
@endsection
