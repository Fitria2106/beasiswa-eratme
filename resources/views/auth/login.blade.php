<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Eramet Beyond Scholarship</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* Menggunakan skema warna Navy & Navy Light dari Dashboard */
        body { background-color: #f4f7fe; font-family: 'Inter', sans-serif; }
        
        /* Navbar Biru Navy sesuai Dashboard */
        .navbar { background: #0d2451; } 
        
        /* Card Login Navy dengan Border Bawah Hijau */
        .card { 
            border-radius: 30px; 
            background: #0d2451; 
            color: white; 
            border-bottom: 8px solid #198754; /* Aksen Hijau Emerald */
        }
        
        .card-header { background: transparent !important; border: none; }
        .text-dark-custom { color: #ffffff !important; } /* Tulisan jadi Putih di atas Navy */
        
        /* Input Field yang Modern */
        .form-control { 
            background-color: rgba(255, 255, 255, 0.1) !important; 
            border: 1px solid rgba(255, 255, 255, 0.2) !important; 
            color: white !important; 
        }
        
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.15) !important;
            border-color: #198754 !important;
            box-shadow: none;
        }

        .form-control::placeholder { color: rgba(255, 255, 255, 0.5); }
        
        /* Tombol Hijau Emerald sesuai Dashboard */
        .btn-primary { 
            border-radius: 15px; 
            background: #198754; 
            border: none; 
            padding: 12px;
            transition: 0.3s;
        }
        .btn-primary:hover { background: #146c43; transform: translateY(-2px); }

        /* Tombol Intip Password */
        #togglePassword {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">
            <i class="bi bi-mortarboard-fill me-2"></i> ERATME SCHOLARSHIP
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active fw-bold" href="{{ route('login') }}">Masuk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0">
                <div class="card-header text-center py-4">
                    <div class="display-4 mb-2" style="color: #198754;"><i class="bi bi-person-circle"></i></div>
                    <h4 class="fw-bold text-dark-custom">Login E-Report Book</h4>
                    <p class="small" style="color: #a5b4fc;">Silakan masuk untuk mengelola laporan Anda</p>
                </div>
                <div class="card-body px-4 pb-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold small" style="color: #cbd5e1;">Email atau NIM</label>
                            <input type="text" name="email" class="form-control rounded-pill" placeholder="Masukkan Email/NIM" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small" style="color: #cbd5e1;">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control rounded-start-pill border-end-0" placeholder="••••••••" required>
                                <button class="btn border border-start-0 rounded-end-pill px-3" type="button" id="togglePassword">
                                    <i class="bi bi-eye-slash" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary rounded-pill fw-bold py-2 shadow-sm text-white">Masuk Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
            <p class="text-center text-muted mt-4 small">&copy; 2026 Eramet Scholarship | Created by KBF</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Script asli Fitria tetap bekerja 100%
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const eyeIcon = document.querySelector('#eyeIcon');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        eyeIcon.classList.toggle('bi-eye');
        eyeIcon.classList.toggle('bi-eye-slash');
        
        // Efek warna saat ditekan
        this.classList.toggle('btn-success'); 
        this.classList.toggle('text-white');
    });
</script>
</body>
</html>