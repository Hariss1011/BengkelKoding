@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Edit Poli</h3>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('poli.update', $poli->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama_poli">Nama Poli</label>
                        <input type="text" name="nama_poli" class="form-control" value="{{ $poli->nama_poli }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3">{{ $poli->keterangan }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('poli.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
