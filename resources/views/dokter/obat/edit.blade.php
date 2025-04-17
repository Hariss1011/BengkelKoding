@extends('layouts.app')


@section('title', 'Edit Obat')
@section('content_header')
    <div class="card-header">
        <a href="{{ route('obat.create') }}" class="btn btn-primary">Tambah Obat</a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('obat.update', $obat->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama obat</label>
                    <input type="text" name="name_obat" id="nama" placeholder="Nama obat" class="form-control"
                        value="{{ $obat->name_obat }}" required>
                </div>
                {{-- ambil template optionnya di adminLTE -> components -> basic form components --}}
                <div class="form-group">
                    <label for="kemasan">Kemasan</label>
                    <x-adminlte-select name="kemasan">
                        <option value="Sachet" {{ $obat->kemasan === 'pill' ? 'selected' : '' }}>Pill</option>
                        <option value="Sachet" {{ $obat->kemasan === 'sachet' ? 'selected' : '' }}>Sachet</option>
                        <option value="Sachet" {{ $obat->kemasan === 'botol' ? 'selected' : '' }}>Botol</option>
                    </x-adminlte-select>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" placeholder="Harga obat" class="form-control"
                        value="{{ $obat->harga }}" required>
                </div>
                <div class="wrapper d-flex justify-content-end" style="gap: 10px;">
                    <button type="submit" class="btn btn-success">Ubah</button>
                    <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
