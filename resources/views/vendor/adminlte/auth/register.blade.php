@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@section('auth_body')
    <div class="row">
        <div class="col-md-6 bg-light d-flex align-items-center justify-content-center">
            <div class="text-center p-4">
                <h3>Daftar Akun Pasien</h3>
                <p class="text-muted">Isi data berikut untuk mendaftar</p>
            </div>
        </div>

        <div class="col-md-6">
            <form action="{{ route('register') }}" method="post">
                @csrf

                {{-- Name --}}
                <div class="mb-3">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Masukkan nama" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Masukkan email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan password" required>
                    @error('password')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password"
                        required>
                </div>

                <button type="submit" class="btn btn-success btn-block">
                    <i class="fas fa-user-plus mr-1"></i> Daftar
                </button>
            </form>

            <div class="mt-3 text-center">
                <a href="{{ route('login') }}">Sudah punya akun? Login di sini</a>
            </div>
        </div>
    </div>
@endsection
