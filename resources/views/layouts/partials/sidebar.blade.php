<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Eramet <sup>App</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if(Auth::user() && Auth::user()->role === 'superadmin')
        <!-- MENU SUPER ADMIN -->
        <div class="sidebar-heading">Super Admin</div>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-user-shield"></i>
                <span>Manajemen Admin</span>
            </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        
        <div class="sidebar-heading">Admin Panel</div>
        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard Admin</span>
            </a>
        </li>
        
    @elseif(Auth::user() && Auth::user()->role === 'admin')
        <!-- MENU ADMIN -->
        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard Admin</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-users"></i>
                <span>Daftar Mahasiswa</span>
            </a>
        </li>
    @else
        <!-- MENU MAHASISWA -->
        <li class="nav-item {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">
                <i class="fas fa-fw fa-home"></i>
                <span>Dashboard Utama</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('mahasiswa.upload') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('mahasiswa.upload') }}">
                <i class="fas fa-fw fa-file-upload"></i>
                <span>Upload Laporan</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('mahasiswa.upload_review_form') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('mahasiswa.upload_review_form') }}">
                <i class="fas fa-fw fa-video"></i>
                <span>Upload Video Review</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('profile.edit') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Profil Saya</span>
            </a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
