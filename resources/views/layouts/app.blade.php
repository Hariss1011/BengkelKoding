@extends('adminlte::page')

{{-- Judul halaman --}}
@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle')
        | @yield('subtitle')
    @endif
@stop

{{-- Header konten --}}
@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted">
            @yield('content_header_title')
            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop

{{-- Isi konten --}}
@section('content')
    @yield('content_body')
@stop

{{-- Footer --}}
@section('footer')
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>
    <strong>
        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'My company') }}
        </a>
    </strong>
@stop

{{-- Tambahkan custom JS --}}
@push('js')
    <script>
        $(document).ready(function() {
            // custom script global
        });
    </script>
@endpush

{{-- Tambahkan custom CSS --}}
@push('css')
    <style type="text/css">
        /* Style global */
    </style>
@endpush

{{-- ✅ PENTING: render stack css & scripts dari child --}}
@stack('css')
@stack('scripts')
