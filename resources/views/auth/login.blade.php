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
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-bold small text-muted">Email atau NIM</label>
            <input type="text" name="email" class="form-control rounded-pill bg-light" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small text-muted">Password</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control rounded-start-pill bg-light border-end-0" required>
                <button class="btn btn-light border border-start-0 rounded-end-pill px-3 text-muted" type="button" id="togglePassword">
                    <i class="bi bi-eye-slash" id="eyeIcon"></i>
                </button>
            </div>
        </div>

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary rounded-pill fw-bold py-2 shadow-sm">Masuk Sekarang</button>
        </div>
    </form>
</div>
            </div>
            <p class="text-center text-muted mt-4 small">&copy; 2026 Eratme Scholarship | Created by Fitria</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Fitria, ini script untuk mengaktifkan fitur intip password
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const eyeIcon = document.querySelector('#eyeIcon');

    togglePassword.addEventListener('click', function () {
        // 1. Cek tipe input sekarang, lalu balikkan (password jadi text, text jadi password)
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // 2. Ubah ikon mata (coret jadi biasa, biasa jadi coret)
        eyeIcon.classList.toggle('bi-eye');
        eyeIcon.classList.toggle('bi-eye-slash');
        
        // 3. Efek klik (opsional: agar tombol terasa ditekan)
        this.classList.toggle('btn-primary');
        this.classList.toggle('text-white');
    });
</script>