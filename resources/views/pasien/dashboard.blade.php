@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Dashboard Pasien</h3>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="info-box bg-primary">
                    <span class="info-box-icon"><i class="fas fa-clipboard-list"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pendaftaran</span>
                        <span class="info-box-number">{{ $jumlahPendaftaran }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jadwal Tersedia</span>
                        <span class="info-box-number">{{ $jumlahJadwal }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-clinic-medical"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Poli</span>
                        <span class="info-box-number">{{ $jumlahPoli }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
