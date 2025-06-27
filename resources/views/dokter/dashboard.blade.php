@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Dashboard Dokter</h3>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5>Total Pasien</h5>
                        <h3>{{ $totalPasien }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Sudah Diperiksa</h5>
                        <h3>{{ $sudahDiperiksa }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-dark">
                    <div class="card-body">
                        <h5>Belum Diperiksa</h5>
                        <h3>{{ $belumDiperiksa }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
