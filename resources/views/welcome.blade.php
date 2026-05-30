<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eramet Beyond Scholarship | E-Report Book</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .hero-section {
            background: linear-gradient(135deg, #0d2451 0%, #1a4b8c 100%);
            color: white;
            padding: 100px 0 80px 0;
            border-bottom: 8px solid #198754;
        }
        .quote-section {
            background-color: white;
            padding: 60px 0;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-top: -40px;
            position: relative;
        }
        .quote-icon {
            color: #198754;
            opacity: 0.2;
            font-size: 4rem;
            position: absolute;
            top: 20px;
            left: 30px;
        }
        .step-card {
            background: white;
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }
        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .step-icon {
            font-size: 2.5rem;
            color: #0d2451;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark position-absolute w-100" style="z-index: 10;">
        <div class="container mt-3">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-mortarboard-fill me-2" style="color: #198754;"></i> ERAMET SCHOLARSHIP
            </a>
            <div class="d-flex">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-light fw-bold px-4 rounded-pill">Ke Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-success fw-bold px-4 rounded-pill me-2">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-light fw-bold px-4 rounded-pill">Daftar</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Sistem E-Report Book</h1>
            <p class="lead mb-5" style="color: #cbd5e1; max-width: 700px; margin: 0 auto;">
                Platform pelaporan dan pengajuan klaim dana buku bagi mahasiswa penerima manfaat program Eramet Beyond Scholarship.
            </p>
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg px-5 py-3 fw-bold rounded-pill shadow">
                    Buka Dashboard <i class="bi bi-arrow-right ms-2"></i>
                </a>
            @else
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('login') }}" class="btn btn-success btn-lg px-5 py-3 fw-bold rounded-pill shadow">
                        Masuk ke Sistem <i class="bi bi-box-arrow-in-right ms-2"></i>
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold rounded-pill shadow">
                            Daftar Akun
                        </a>
                    @endif
                </div>
            @endauth
        </div>
    </section>

    <!-- Quote Section -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="quote-section text-center px-4 px-md-5">
                    <i class="bi bi-quote quote-icon"></i>
                    <p class="fs-4 fst-italic text-dark mb-4" style="line-height: 1.6;">
                        "Pendidikan adalah investasi jangka panjang yang memberi manfaat bagi individu, keluarga, komunitas, dan bangsa. Kami ingin memberi generasi muda di Indonesia Timur kesempatan yang setara untuk meraih impian mereka dan menjadi agen perubahan."
                    </p>
                    <h6 class="fw-bold text-uppercase mb-0" style="color: #0d2451;">Nancy Pasaribu</h6>
                    <span class="text-muted small">Head of Communications, Eramet Indonesia</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Steps Section -->
    <section class="py-5 mt-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="fw-bold text-dark">Alur Pengajuan Laporan Buku</h3>
                <p class="text-muted">Proses klaim dana pendidikan yang transparan dan mudah dipantau.</p>
            </div>
            
            <div class="row g-4 text-center">
                <!-- Step 1 -->
                <div class="col-md-4">
                    <div class="card step-card h-100 p-4 shadow-sm">
                        <div class="step-icon"><i class="bi bi-book"></i></div>
                        <h5 class="fw-bold">1. Input Laporan</h5>
                        <p class="text-muted small mb-0">Mahasiswa memasukkan detail buku yang dibeli dan mengunggah foto nota bukti pembelian.</p>
                    </div>
                </div>
                <!-- Step 2 -->
                <div class="col-md-4">
                    <div class="card step-card h-100 p-4 shadow-sm">
                        <div class="step-icon"><i class="bi bi-shield-check"></i></div>
                        <h5 class="fw-bold">2. Verifikasi Admin</h5>
                        <p class="text-muted small mb-0">Tim verifikator Eramet akan memeriksa kesesuaian nota dan memvalidasi batas anggaran.</p>
                    </div>
                </div>
                <!-- Step 3 -->
                <div class="col-md-4">
                    <div class="card step-card h-100 p-4 shadow-sm">
                        <div class="step-icon"><i class="bi bi-play-circle"></i></div>
                        <h5 class="fw-bold">3. Unggah Review</h5>
                        <p class="text-muted small mb-0">Setelah disetujui, mahasiswa mengunggah tautan video review buku ke media sosial.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-4 text-muted small">
        <div class="container">
            &copy; 2026 Eramet Beyond Scholarship | Sistem Pelaporan Dana Pendidikan
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>