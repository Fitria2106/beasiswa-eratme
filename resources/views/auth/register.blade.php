<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white text-center py-3">
                    <h4 class="mb-0">Daftar Akun E-Report Book</h4>
                    <small>Beasiswa Eratme Scholarship</small>
                </div>
                <div class="card-body p-4">
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input id="name" type="text" name="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" required autofocus autocomplete="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input id="email" type="email" name="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" required autocomplete="username">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" name="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input id="password_confirmation" type="password" 
                                   name="password_confirmation" class="form-control" 
                                   required autocomplete="new-password">
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-success py-2">
                                {{ __('Daftar Sekarang') }}
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <a class="text-decoration-none small text-muted" href="{{ route('login') }}">
                                Sudah punya akun? Silakan Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <p class="text-center text-muted mt-4 small">&copy; 2026 Eratme Scholarship - IT Department</p>
        </div>
    </div>
</div>