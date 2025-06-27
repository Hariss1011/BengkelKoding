    <style>
        .main-sidebar {
            background-color: #0600b7 !important;
        }
    </style>

    <aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

        {{-- Sidebar brand logo --}}
        @if (config('adminlte.logo_img_xl'))
            @include('adminlte::partials.common.brand-logo-xl')
        @else
            @include('adminlte::partials.common.brand-logo-xs')
        @endif

        {{-- Sidebar menu --}}
        <div class="sidebar">
            <nav class="pt-2">
                <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                    data-widget="treeview" role="menu"
                    @if (config('adminlte.sidebar_nav_animation_speed') != 300) data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}" @endif
                    @if (!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>

                    @php $role = Auth::check() ? Auth::user()->role : null; @endphp

                    @if ($role === 'admin')
                        {{-- Menu untuk Admin --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('poli.index') }}"
                                class="nav-link {{ request()->is('poli*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-clinic-medical"></i>
                                <p>Data Poli</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dokter.index') }}"
                                class="nav-link {{ request()->is('dokter*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-md"></i>
                                <p>Data Dokter</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('pasien.index') }}"
                                class="nav-link {{ request()->is('pasien*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-injured"></i>
                                <p>Data Pasien</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('obat.index') }}"
                                class="nav-link {{ request()->is('obat*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-pills"></i>
                                <p>Data Obat</p>
                            </a>
                        </li>
                    @endif


                    @if ($role === 'dokter')
                        <li class="nav-item">
                            <a href="{{ route('dokter.dashboard') }}"
                                class="nav-link {{ request()->is('dokter') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard <span class="badge badge-danger">Dokter</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jadwal.index') }}"
                                class="nav-link {{ request()->is('dokter/jadwal*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>Jadwal Periksa <span class="badge badge-danger">Dokter</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('memeriksa.index') }}"
                                class="nav-link {{ request()->is('dokter/periksa*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-md"></i>
                                <p>Memeriksa Pasien <span class="badge badge-danger">Dokter</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('riwayat.index') }}"
                                class="nav-link {{ request()->is('dokter/riwayat*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-notes-medical"></i>
                                <p>Riwayat Pasien <span class="badge badge-danger">Dokter</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profil.edit') }}"
                                class="nav-link {{ request()->is('dokter/profil') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Profil <span class="badge badge-danger">Dokter</span></p>
                            </a>
                        </li>
                    @endif

                    @if ($role === 'pasien')
                        <li class="nav-item">
                            <a href="{{ route('pasien.dashboard') }}"
                                class="nav-link {{ request()->is('pasien') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard <span class="badge badge-warning">Pasien</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pasien.poli.index') }}"
                                class="nav-link {{ request()->is('pasien/poli*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-clinic-medical"></i>
                                <p>Poli <span class="badge badge-warning">Pasien</span></p>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </div>

    </aside>
