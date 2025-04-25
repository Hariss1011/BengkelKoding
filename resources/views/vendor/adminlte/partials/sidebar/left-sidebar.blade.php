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

                @if ($role === 'dokter')
                    {{-- Menu untuk Dokter --}}
                    <li class="nav-item">
                        <a href="{{ route('periksa.index') }}"
                            class="nav-link {{ request()->is('dokter/periksa*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-notes-medical"></i>
                            <p>Data Periksa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('obat.index') }}"
                            class="nav-link {{ request()->is('dokter/obat*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-pills"></i>
                            <p>Data Obat</p>
                        </a>
                    </li>
                @elseif($role === 'pasien')
                    {{-- Menu untuk Pasien --}}
                    <li class="nav-item">
                        <a href="{{ route('pasien.periksa.index') }}"
                            class="nav-link {{ request()->is('pasien/periksa*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-stethoscope"></i>
                            <p>Periksa & Riwayat</p>
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
