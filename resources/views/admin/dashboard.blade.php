@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Dashboard Admin</h3>
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Dokter</h5>
                        <p class="card-text">{{ $jumlahDokter }} orang</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pasien</h5>
                        <p class="card-text">{{ $jumlahPasien }} orang</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Poli</h5>
                        <p class="card-text">{{ $jumlahPoli }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Obat</h5>
                        <p class="card-text">{{ $jumlahObat }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
