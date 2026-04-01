<x-guest-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-7">
                
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-primary">Pendaftaran Mahasiswa</h2>
                    <p class="text-muted">Lengkapi data di bawah ini untuk akses E-Report Beasiswa</p>
                </div>

                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-5">
                                <h6 class="text-primary fw-bold mb-3 border-bottom pb-2 text-uppercase small">
                                    <i class="bi bi-person-fill me-2"></i>Identitas Personal
                                </h6>
                                
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold small">Nama Lengkap</label>
                                    <input id="name" class="form-control form-control-lg fs-6 @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap Anda">
                                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold small">Alamat Email Aktif</label>
                                    <input id="email" class="form-control form-control-lg fs-6 @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required placeholder="contoh: fitria@student.ac.id">
                                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                                </div>
                            </div>

                            <div class="mb-5">
                                <h6 class="text-primary fw-bold mb-3 border-bottom pb-2 text-uppercase small">
                                    <i class="bi bi-mortarboard-fill me-2"></i>Informasi Kampus
                                </h6>

                                <div class="mb-3">
                                    <label for="nim" class="form-label fw-semibold small">NIM (Nomor Induk Mahasiswa)</label>
                                    <input id="nim" class="form-control form-control-lg fs-6 @error('nim') is-invalid @enderror" type="text" name="nim" value="{{ old('nim') }}" required placeholder="Masukkan NIM resmi Anda">
                                    <x-input-error :messages="$errors->get('nim')" class="mt-1" />
                                </div>

                                <div class="mb-3">
                                    <label for="kampus" class="form-label fw-semibold small">Nama Perguruan Tinggi</label>
                                    <input id="kampus" class="form-control form-control-lg fs-6" type="text" name="kampus" value="{{ old('kampus') }}" required placeholder="Contoh: Universitas Technology Digital Indonesia">
                                </div>

                                <div class="mb-3">
                                    <label for="jurusan" class="form-label fw-semibold small">Program Studi / Jurusan</label>
                                    <input id="jurusan" class="form-control form-control-lg fs-6" type="text" name="jurusan" value="{{ old('jurusan') }}" required placeholder="Contoh: S1 Informatika">
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="text-primary fw-bold mb-3 border-bottom pb-2 text-uppercase small">
                                    <i class="bi bi-shield-lock-fill me-2"></i>Keamanan Akun
                                </h6>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold small">Password Baru</label>
                                    <input id="password" class="form-control form-control-lg fs-6 @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter">
                                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label fw-semibold small">Konfirmasi Password</label>
                                    <input id="password_confirmation" class="form-control form-control-lg fs-6" type="password" name="password_confirmation" required placeholder="Ulangi password untuk verifikasi">
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-5">
                                <button type="submit" class="btn btn-primary btn-lg rounded-3 shadow-sm py-3 fw-bold">
                                    Daftar Akun Sekarang
                                </button>
                                <div class="text-center mt-3">
                                    <span class="text-muted small">Sudah punya akun?</span>
                                    <a class="text-decoration-none small fw-bold text-primary" href="{{ route('login') }}">
                                        Masuk di sini
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <p class="text-center mt-4 text-muted small">&copy; 2026 E-Report Beasiswa Eratme</p>
            </div>
        </div>
    </div>
</x-guest-layout>