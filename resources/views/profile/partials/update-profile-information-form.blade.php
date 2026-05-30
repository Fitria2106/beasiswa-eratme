<p class="text-muted small mb-4">
    Perbarui informasi profil dan alamat email akun Anda.
</p>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div class="form-group">
        <label for="name" class="font-weight-bold">Nama Lengkap</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="email" class="font-weight-bold">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2">
                <p class="text-sm text-warning small">
                    Alamat email Anda belum diverifikasi.
                    <button form="send-verification" class="btn btn-link btn-sm p-0 m-0 align-baseline text-primary">Klik di sini untuk mengirim ulang email verifikasi.</button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="text-success small mt-2">
                        Link verifikasi baru telah dikirim ke alamat email Anda.
                    </p>
                @endif
            </div>
        @endif
    </div>

    <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary shadow-sm"><i class="fas fa-save mr-2"></i>Simpan</button>

        @if (session('status') === 'profile-updated')
            <span class="text-success small ml-3 font-weight-bold" id="profile-status-msg">
                <i class="fas fa-check-circle"></i> Berhasil disimpan.
            </span>
            <script>
                setTimeout(() => { document.getElementById('profile-status-msg').style.display = 'none'; }, 3000);
            </script>
        @endif
    </div>
</form>
