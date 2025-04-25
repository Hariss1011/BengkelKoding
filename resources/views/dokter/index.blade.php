@extends('adminlte::page')

@section('title', 'Dashboard Dokter')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <!-- Total Periksa -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalPeriksa }}</h3>
                    <p>Total Periksa</p>
                </div>
                <div class="icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <a href="{{ route('periksa.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- Jumlah Pasien -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalPasien }}</h3>
                    <p>Jumlah Pasien</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-injured"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- Jumlah Obat -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalObat }}</h3>
                    <p>Jumlah Obat</p>
                </div>
                <div class="icon">
                    <i class="fas fa-pills"></i>
                </div>
                <a href="{{ route('obat.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- Unique Visitors (opsional) -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalUnik ?? 65 }}</h3> <!-- dummy value -->
                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    {{-- Tambahkan komponen lain seperti grafik jika dibutuhkan --}}
@endsection
