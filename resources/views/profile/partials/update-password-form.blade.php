<p class="text-muted small mb-4">
    Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
</p>

<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="update_password_current_password" class="font-weight-bold">Password Saat Ini</label>
        <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="update_password_current_password" name="current_password" autocomplete="current-password">
        @error('current_password', 'updatePassword')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="update_password_password" class="font-weight-bold">Password Baru</label>
        <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="update_password_password" name="password" autocomplete="new-password">
        @error('password', 'updatePassword')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="update_password_password_confirmation" class="font-weight-bold">Konfirmasi Password Baru</label>
        <input type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
        @error('password_confirmation', 'updatePassword')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary shadow-sm"><i class="fas fa-key mr-2"></i>Ubah Password</button>

        @if (session('status') === 'password-updated')
            <span class="text-success small ml-3 font-weight-bold" id="password-status-msg">
                <i class="fas fa-check-circle"></i> Password berhasil diubah.
            </span>
            <script>
                setTimeout(() => { document.getElementById('password-status-msg').style.display = 'none'; }, 3000);
            </script>
        @endif
    </div>
</form>
