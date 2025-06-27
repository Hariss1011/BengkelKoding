@extends('layouts.app')

@section('title', 'Periksa Pasien')
@section('content_header_title', 'Periksa Pasien')

@section('content_body')
    <form action="{{ route('memeriksa.update', $periksa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header bg-primary text-white">Periksa Pasien</div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Pasien</label>
                    <input type="text" class="form-control" value="{{ $periksa->daftarPoli->pasien->name ?? '-' }}"
                        readonly>
                </div>

                <div class="form-group mt-2">
                    <label>Tanggal Periksa</label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}"
                        readonly>
                </div>

                <div class="form-group mt-2">
                    <label>Catatan</label>
                    <textarea name="catatan" class="form-control" rows="3">{{ $periksa->catatan }}</textarea>
                </div>

                <div class="form-group mt-2">
                    <label>Obat</label>
                    <select name="obat[]" class="form-control" multiple>
                        @foreach ($obats as $obat)
                            <option value="{{ $obat->id }}">
                                {{ $obat->nama_obat }} - Rp.{{ number_format($obat->harga) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label>Total Harga</label>
                    <input type="text" name="total" class="form-control" readonly>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>
    </form>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {
            const selectObat = $('select[name="obat[]"]');
            const totalField = $('input[name="total"]');
            const obatData = @json($obats->keyBy('id'));

            selectObat.select2({
                placeholder: "Pilih obat...",
                allowClear: true,
                width: '100%'
            });

            function hitungTotal() {
                let total = 100000;
                (selectObat.val() || []).forEach(id => {
                    if (obatData[id]) total += parseInt(obatData[id].harga);
                });
                totalField.val(total);
            }

            selectObat.on('change', hitungTotal);
        });
    </script>
@endpush
