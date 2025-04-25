@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_body')
    <div class="row">
        <div class="col-md-6 bg-light d-flex align-items-center justify-content-center">
            <div class="text-center p-4">
                <h3>Selamat Datang di <strong>SISMENKES</strong></h3>
                <p class="text-muted">Silakan login untuk melanjutkan</p>
            </div>
        </div>

        <div class="col-md-6">
            <form action="{{ route('login') }}" method="post">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Masukkan email" value="{{ old('email') }}" required autofocus>
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

                {{-- Remember me --}}
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="btn btn-info btn-block">
                    <i class="fas fa-sign-in-alt mr-1"></i> Login
                </button>
            </form>

            <div class="mt-3 text-center">
                <a href="{{ route('password.request') }}">Lupa password?</a> |
                <a href="{{ route('register') }}">Daftar akun baru</a>
            </div>
        </div>
    </div>
@endsection
