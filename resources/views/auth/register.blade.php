<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Mahasiswa | E-Report Beasiswa Eratme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-wrapper {
            width: 100%;
            max-width: 900px;
            padding: 20px;
        }

        .card-register {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }

        .form-control-lg {
            padding: 1rem 1.25rem;
            font-size: 1.05rem;
            border-radius: 12px;
        }

        .section-title {
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>

    <div class="register-wrapper">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">Pendaftaran Mahasiswa</h2>
            <p class="text-muted mb-0">Lengkapi data di bawah ini untuk akses E-Report Beasiswa</p>
        </div>

        <div class="card card-register">
            <div class="card-body p-4 p-md-5">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-4">
                        <h6 class="text-primary fw-bold mb-3 border-bottom pb-2 text-uppercase section-title">
                            <i class="bi bi-person-fill me-2"></i>Identitas Personal
                        </h6>
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold small">Nama Lengkap</label>
                            <input id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap Anda">
                            <x-input-error :messages="$errors->get('name')" class="mt-1 text-danger small" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold small">Alamat Email Aktif</label>
                            <input id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required placeholder="contoh: fitria@student.ac.id">
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger small" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-primary fw-bold mb-3 border-bottom pb-2 text-uppercase section-title">
                            <i class="bi bi-mortarboard-fill me-2"></i>Informasi Kampus
                        </h6>
                        <div class="mb-3">
                            <label for="nim" class="form-label fw-semibold small">NIM (Nomor Induk Mahasiswa)</label>
                            <input id="nim" class="form-control form-control-lg @error('nim') is-invalid @enderror" type="text" name="nim" value="{{ old('nim') }}" required placeholder="Masukkan NIM resmi Anda">
                            <x-input-error :messages="$errors->get('nim')" class="mt-1 text-danger small" />
                        </div>
                        <div class="mb-3">
                            <label for="kampus" class="form-label fw-semibold small">Nama Perguruan Tinggi</label>
                            <input id="kampus" class="form-control form-control-lg" type="text" name="kampus" value="{{ old('kampus') }}" required placeholder="Contoh: Universitas Technology Digital Indonesia">
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label fw-semibold small">Program Studi / Jurusan</label>
                            <input id="jurusan" class="form-control form-control-lg" type="text" name="jurusan" value="{{ old('jurusan') }}" required placeholder="Contoh: S1 Informatika">
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-primary fw-bold mb-3 border-bottom pb-2 text-uppercase section-title">
                            <i class="bi bi-shield-lock-fill me-2"></i>Keamanan Akun
                        </h6>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold small">Password Baru</label>
                            <input id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password" placeholder="Buat password yang kuat">
                            <div class="form-text mt-2 text-muted" style="font-size: 0.75rem;">
                                <i class="bi bi-info-circle me-1"></i>
                                Petunjuk: Minimal <strong>8 karakter</strong>, gunakan kombinasi <strong>huruf besar, huruf kecil, angka,</strong> dan <strong>simbol</strong>.
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger small" />
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold small">Konfirmasi Password</label>
                            <input id="password_confirmation" class="form-control form-control-lg" type="password" name="password_confirmation" required placeholder="Ulangi password untuk verifikasi">
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3 shadow-sm py-3 fw-bold text-uppercase" style="letter-spacing: 1px;">
                            Daftar Akun Sekarang
                        </button>
                        <div class="text-center mt-3">
                            <span class="text-muted small">Sudah punya akun?</span>
                            <a class="text-decoration-none small fw-bold text-primary ms-1" href="{{ route('login') }}">Masuk di sini</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <p class="text-center mt-4 text-muted small">&copy; 2026 E-Report Eramet Beyond Scholarship | </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
