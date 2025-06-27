@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Daftar Riwayat Pasien</h3>
        <div class="card">
            <div class="card-header bg-primary text-white">Daftar Riwayat Pasien</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Alamat</th>
                            <th>No. KTP</th>
                            <th>No. Telepon</th>
                            <th>No. RM</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pasiens as $i => $pasien)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $pasien->name }}</td>
                                <td>{{ $pasien->alamat }}</td>
                                <td>{{ $pasien->no_ktp }}</td>
                                <td>{{ $pasien->no_hp }}</td>
                                <td>{{ $pasien->no_rm }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm"
                                        onclick="showRiwayat({{ $pasien->id }}, '{{ $pasien->name }}')">
                                        <i class="fas fa-eye"></i> Detail Riwayat
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="riwayatModal" tabindex="-1" aria-labelledby="riwayatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Riwayat Periksa - <span id="namaPasien"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="tableRiwayat">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Periksa</th>
                                <th>Nama Pasien</th>
                                <th>Nama Dokter</th>
                                <th>Keluhan</th>
                                <th>Catatan</th>
                                <th>Obat</th>
                                <th>Biaya Periksa</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showRiwayat(id, nama) {
            fetch(`/dokter/riwayat-pasien/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('namaPasien').textContent = nama;
                    let tbody = '';
                    data.riwayats.forEach((r, i) => {
                        let obatList = r.detail_periksa.map(d => d.obat?.nama_obat ?? '-').join(', ');
                        tbody += `
                    <tr>
                        <td>${i + 1}</td>
                        <td>${r.tgl_periksa ?? '-'}</td>
                        <td>${r.daftar_poli?.pasien?.name ?? '-'}</td>
                        <td>${r.daftar_poli?.jadwal_periksa?.dokter?.name ?? '-'}</td>
                        <td>${r.daftar_poli?.keluhan ?? '-'}</td>
                        <td>${r.catatan ?? '-'}</td>
                        <td>${obatList}</td>
                        <td>Rp${(r.biaya_periksa ?? 0).toLocaleString()}</td>
                    </tr>
                `;
                    });
                    document.querySelector('#tableRiwayat tbody').innerHTML = tbody;
                    $('#riwayatModal').modal('show');

                });
        }
    </script>
@endpush
