<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<style>
    body { background-color: #f4f7fe; font-family: 'Inter', sans-serif; }
    .navbar { background: linear-gradient(45deg, #4e73df, #224abe); }
    .card { border-radius: 20px; }
    .btn-primary { border-radius: 10px; background: #4e73df; border: none; }
    .btn-primary:hover { background: #224abe; }
</style>

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
                <div class="card-header bg-white text-center py-4 border-0">
                    <div class="display-4 text-primary mb-2"><i class="bi bi-person-circle"></i></div>
                    <h4 class="fw-bold text-dark">Login E-Report Book</h4>
                    <p class="text-muted small">Silakan masuk untuk mengelola laporan Anda</p>
                </div>
                <div class="card-body px-4 pb-4">
                    
                    @if (session('status'))
                        <div class="alert alert-success mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                                <input id="email" type="email" name="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label small fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                                <input id="password" type="password" name="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       required autocomplete="current-password" placeholder="••••••••">
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label class="form-check-label text-muted small" for="remember_me">Ingat saya</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none small" href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm">
                                <i class="bi bi-box-arrow-in-right me-2"></i> MASUK SEKARANG
                            </button>
                        </div>

                        <hr class="my-4 text-muted">
                        <div class="text-center">
                            <p class="small text-muted mb-0">Belum memiliki akun?</p>
                            <a href="{{ route('register') }}" class="fw-bold text-decoration-none">
                                Buat Akun Beasiswa Baru
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <p class="text-center text-muted mt-4 small">&copy; 2026 Eratme Scholarship | Created by Fitria</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>