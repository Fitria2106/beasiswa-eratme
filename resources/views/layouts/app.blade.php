<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        
        {{-- HAPUS ATAU KOMENTAR BAGIAN INI AGAR NAVBAR DOUBLE HILANG --}}
        {{-- @include('layouts.navigation') --}}

        {{-- HAPUS JUGA BAGIAN HEADER INI JIKA KAMU SUDAH BUAT HEADER SENDIRI --}}
         {{-- bootstrap Navigation Dashboard Mahasiswa--}}
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-custom shadow-sm py-3">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ route('mahasiswa.dashboard') }}">
                    <i class="bi bi-mortarboard-fill me-2"></i> Eratme Scholarship
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-nav-item">
                            <a class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active fw-bold' : '' }}" href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/upload') }}">Input Laporan</a>
                        </li>
                        <li class="nav-item ms-lg-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-light btn-sm rounded-pill px-4 fw-bold text-primary">
                                    <i class="bi bi-box-arrow-right me-1"></i> Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
             </div>
        </nav>

         {{-- bootstrap Navigation Dashboard Admin --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3 mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('admin.dashboard') }}">
            <div class="bg-primary rounded-circle p-2 me-2 d-inline-flex">
                <i class="bi bi-shield-lock-fill text-white fs-5"></i>
            </div>
            <span>Admin Eratme</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active fw-bold text-primary' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/laporan') }}">
                        <i class="bi bi-file-earmark-text me-1"></i> Verifikasi Laporan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/mahasiswa') }}">
                        <i class="bi bi-people me-1"></i> Data Mahasiswa
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-3">
                <span class="text-light small d-none d-md-inline">Halo, <strong>{{ Auth::user()->name }}</strong></span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-4 fw-bold">
                        <i class="bi bi-power me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
        {{-- @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset --}}

        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
