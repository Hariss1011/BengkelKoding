@csrf
<div class="mb-3">
    <label for="nama_poli" class="form-label">Nama Poli</label>
    <input type="text" class="form-control" name="nama_poli" value="{{ old('nama_poli', $poli->nama_poli ?? '') }}"
        required>
</div>
<div class="mb-3">
    <label for="keterangan" class="form-label">Keterangan</label>
    <textarea class="form-control" name="keterangan">{{ old('keterangan', $poli->keterangan ?? '') }}</textarea>
</div>
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('poli.index') }}" class="btn btn-secondary">Kembali</a>
