@extends('layouts.app')

@section('title', 'Daftar Poli')
@section('content_header_title', 'Daftar Poli')

@section('content_body')
    <div class="row">
        <!-- Form Daftar Poli -->
        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">Daftar Poli</div>
                <div class="card-body">
                    <form action="{{ route('pasien.poli.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nomor Rekam Medis</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->no_rm }}" readonly>
                        </div>
                        <div class="form-group mt-2">
                            <label>Pilih Poli</label>
                            <select name="id_poli" class="form-control" required>
                                <option value="">-- Pilih Poli --</option>
                                @foreach ($polis as $poli)
                                    <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label>Pilih Jadwal</label>
                            <select name="id_jadwal" id="jadwalSelect" class="form-control" required>
                                <option value="">-- Pilih Jadwal --</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label>Keluhan</label>
                            <textarea name="keluhan" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Daftar</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Riwayat Daftar Poli -->
        <div class="col-md-8">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">Riwayat daftar poli</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Poli</th>
                                <th>Dokter</th>
                                <th>Hari</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Antrian</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayats as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $item->jadwal->dokter->poli->nama_poli ?? '-' }}</td>
                                    <td>{{ $item->jadwal->dokter->name ?? '-' }}</td>
                                    <td>{{ $item->jadwal->hari }}</td>
                                    <td>{{ $item->jadwal->jam_mulai }}</td>
                                    <td>{{ $item->jadwal->jam_selesai }}</td>
                                    <td>{{ $item->no_antrian }}</td>
                                    <td>
                                        @php
                                            $sudah =
                                                $item->periksa &&
                                                ($item->periksa->catatan || $item->periksa->detailPeriksa->count());
                                        @endphp
                                        <span class="badge {{ $sudah ? 'bg-success' : 'bg-warning text-dark' }}">
                                            {{ $sudah ? 'Sudah' : 'Belum' }}
                                        </span>
                                    </td>

                                    <td>
                                        @if ($item->periksa)
                                            <button class="btn btn-info btn-sm"
                                                onclick="showDetailRiwayat({{ $item->periksa->id }})">
                                                <i class="fas fa-eye"></i> Detail Riwayat
                                            </button>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="detailRiwayatModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Detail Riwayat Periksa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody id="riwayatDetailBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <!--pilih poli -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const poliSelect = document.querySelector('select[name="id_poli"]');
            const jadwalSelect = document.querySelector('select[name="id_jadwal"]');

            poliSelect.addEventListener('change', function() {
                const idPoli = this.value;

                jadwalSelect.innerHTML = '<option value="">Memuat jadwal...</option>';

                if (idPoli) {
                    fetch(`/jadwal-periksa/poli/${idPoli}`)
                        .then(res => res.json())
                        .then(data => {
                            let options = '<option value="">-- Pilih Jadwal --</option>';
                            data.forEach(j => {
                                const dokterName = j.dokter?.name ?? 'Tidak diketahui';
                                options +=
                                    `<option value="${j.id}">${dokterName} - ${j.hari} (${j.jam_mulai} - ${j.jam_selesai})</option>`;
                            });
                            jadwalSelect.innerHTML = options;
                        })
                        .catch(() => {
                            jadwalSelect.innerHTML = '<option value="">Gagal memuat jadwal</option>';
                        });
                } else {
                    jadwalSelect.innerHTML = '<option value="">-- Pilih Jadwal --</option>';
                }
            });
        });
    </script>


    <!-- detail riwayat -->
    <script>
        function showDetailRiwayat(id) {
            fetch(`/riwayat/detail/${id}`)
                .then(res => res.json())
                .then(data => {
                    const p = data.periksa;
                    const obats = p.detail_periksa.map(o => o.obat?.nama_obat ?? '-').join(', ');
                    const html = `
                    <tr><th>Tanggal Periksa</th><td>${p.tgl_periksa}</td></tr>
                    <tr><th>Nama Pasien</th><td>${p.daftar_poli.pasien.name}</td></tr>
                    <tr><th>Nama Dokter</th><td>${p.daftar_poli.jadwal_periksa.dokter.name}</td></tr>
                    <tr><th>Keluhan</th><td>${p.daftar_poli.keluhan}</td></tr>
                    <tr><th>Catatan</th><td>${p.catatan}</td></tr>
                    <tr><th>Obat</th><td>${obats}</td></tr>
                    <tr><th>Biaya</th><td>Rp${parseInt(p.biaya_periksa).toLocaleString()}</td></tr>
                `;
                    document.getElementById('riwayatDetailBody').innerHTML = html;
                    new bootstrap.Modal(document.getElementById('detailRiwayatModal')).show();
                });
        }
    </script>
@endpush
