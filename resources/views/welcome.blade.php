<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-light">

<div class="container-fluid py-4 min-vh-100">
    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <h3 class="fw-bold text-primary">E-Report Book</h3>
                <p class="text-muted small">Pusat Pelaporan Beasiswa Eratme</p>
            </div>
            <div class="col-md-6 text-md-end text-center mt-3 mt-md-0">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary shadow-sm px-4">Buka Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary shadow-sm">Daftar Akun</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <hr class="mb-5">

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 border-start border-primary border-5">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-journal-text text-primary fs-3"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1 small text-uppercase">Total Laporan</h6>
                            <h4 class="mb-0 fw-bold">0 Laporan</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 border-start border-success border-5">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-check-circle text-success fs-3"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1 small text-uppercase">Terverifikasi</h6>
                            <h4 class="mb-0 fw-bold">0 Laporan</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 border-start border-warning border-5">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-clock-history text-warning fs-3"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1 small text-uppercase">Menunggu</h6>
                            <h4 class="mb-0 fw-bold">0 Laporan</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white py-3 border-0 mt-2">
                        <h5 class="mb-0 fw-bold px-2">Informasi Terbaru</h5>
                    </div>
                    <div class="card-body text-center py-5">
                        <img src="https://illustrations.popsy.co/white/reading-a-book.svg" alt="Empty" style="width: 200px;" class="mb-4">
                        <h5 class="fw-bold">Selamat Datang di E-Report!</h5>
                        <p class="text-muted px-lg-5">Silakan login untuk mulai melaporkan pembelian buku atau kebutuhan pendidikan lainnya selama masa beasiswa.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card border-0 shadow-sm bg-primary text-white p-4 rounded-4 h-100">
                    <h5 class="fw-bold mb-3">Panduan Singkat</h5>
                    <p class="small opacity-75">1. Daftar akun menggunakan email aktif.<br>2. Login ke sistem dashboard.<br>3. Unggah foto struk belanja buku.<br>4. Tunggu verifikasi admin.</p>
                    <hr class="border-light opacity-50">
                    <div class="small">
                        <p class="mb-2"><i class="bi bi-info-circle me-2"></i> Periode: 2026</p>
                        <p class="mb-0"><i class="bi bi-geo-alt me-2"></i> Jayapura / Yogyakarta</p>
                    </div>
                </div>
            </div>
        </div>
        
        <footer class="mt-5 text-center py-4 text-muted">
            <small>&copy; 2026 Eratme Scholarship. Develop by Fitria Yosefina R.W.</small>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>