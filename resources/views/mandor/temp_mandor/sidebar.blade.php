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
        <a class="nav-link" href="/dashboard-mandor">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    <!-- Tombol Laporan -->
    <li class="nav-item">
        <a class="nav-link" href="/tanggal-panen-kelompok-mandor">
            <i class="fas fa-newspaper" style="color: white"></i>
            <span>Data SPB</span>
        </a>
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
