@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Tambah Poli</h3>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('poli.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_poli">Nama Poli</label>
                        <input type="text" name="nama_poli" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('poli.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
