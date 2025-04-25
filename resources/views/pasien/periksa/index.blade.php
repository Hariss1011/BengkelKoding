@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Periksa</h4>

        {{-- Form Periksa --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Form Periksa</div>
            <div class="card-body">
                <form method="POST" action="{{ route('pasien.periksa.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="dokter">Dokter</label>
                        <select name="id_dokter" class="form-control" required>
                            <option value="">Pilih Dokter</option>
                            @foreach ($dokters as $dokter)
                                <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>

        {{-- Riwayat Periksa --}}
        <div class="card">
            <div class="card-header bg-primary text-white">Riwayat Periksa</div>
            <div class="card-body">
                @if ($periksas->isEmpty())
                    <p class="text-success">Belum pernah melakukan periksa</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Dokter</th>
                                <th>Tanggal</th>
                                <th>Biaya Periksa</th>
                                <th>Status</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periksas as $key => $p)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $p->dokter->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->tgl_periksa)->format('d-m-Y') }}</td>
                                    <td>{{ $p->biaya_periksa ?? '-' }}</td>
                                    <td> {{ $p->catatan ? 'Selesai' : 'Menunggu' }}</td>
                                    <td>{{ $p->catatan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
