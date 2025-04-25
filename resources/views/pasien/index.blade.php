@extends('adminlte::page')

@section('title', 'Dashboard Pasien')

@section('content_header')
    <h1>Dashboard Pasien</h1>
@stop

@section('content')
    <div class="row">
        <!-- Total Pemeriksaan -->
        <div class="col-lg-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalPeriksa }}</h3>
                    <p>Total Pemeriksaan Saya</p>
                </div>
                <div class="icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <a href="{{ route('pasien.periksa.index') }}" class="small-box-footer">Lihat Riwayat <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- Total Dokter (opsional) -->
        <div class="col-lg-6 col-12">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalDokter }}</h3>
                    <p>Total Dokter Tersedia</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <a href="{{ route('pasien.periksa.index') }}" class="small-box-footer">Periksa Sekarang <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection
