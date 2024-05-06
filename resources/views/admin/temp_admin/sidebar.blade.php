<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #3A3737">

    {{-- <!-- Sidebar - Brand -->
    <div class="sidebar-brand d-flex flex-column align-items-center justify-content-center">
        <img src="{{ asset('assets/images/logo.png') }}" alt="" width="40" height="40">
    </div> --}}
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <i class="far fa-user-circle fa-lg"></i>
        </div>
        @auth
            <div class="sidebar-brand-text mx-3">
                <span>
                    {{ auth()->user()->name }}
                </span>
            </div>
        @endauth
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/dashboard-admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-home" style="color: white"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <a class="collapse-item" href="/role-admin">Data Role</a> --}}
                <a class="collapse-item" href="/user-admin">Data User</a>
                <a class="collapse-item" href="/sopir-admin">Data Nama Sopir</a>
                <a class="collapse-item" href="/kendaraan-admin">Data Kendaraan</a>
                <a class="collapse-item" href="/blok-admin">Data Blok</a>
                <a class="collapse-item" href="/kelompok-admin">Data Kelompok</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-users" style="color: white"></i>
            <span>Data Anggota</span>
        </a>
        <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/anggota-tervalidasi">Data Anggota Tervalidasi</a>
                <a class="collapse-item" href="/data-anggota-lama">Data Anggota Lama</a>
                <a class="collapse-item" href="/verifikasi-anggota-baru">Verifikasi Anggota Baru</a>
                <a class="collapse-item" href="/data-pemetaan">Data Pemetaan</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-tractor" style="color: white"></i>
            <span>Data Panen Anggota</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/tonase-panen-harian">Tonase Panen Harian</a>
                <a class="collapse-item" href="/hasil-pks-harian">Hasil PKS Harian</a>
                <a class="collapse-item" href="/rekap-panen-bulanan">Rekap Panen Bulanan</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-newspaper" style="color: white"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/laporan-panen-anggota-kelompok">Panen Anggota Kelompok</a>
                <a class="collapse-item" href="/selisih-panen-harian">Selisih Panen Harian</a>
                <a class="collapse-item" href="/laporan-rekap-panen-bulanan">Laporan Rekap Panen Bulanan</a>
            </div>
        </div>
    </li>

    <!-- Tombol Logout -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt" style="color: white"></i>
            <span>Log Out</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
