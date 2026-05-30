<p class="text-muted small mb-4">
    Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. 
    Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
</p>

<button type="button" class="btn btn-danger shadow-sm" data-toggle="modal" data-target="#confirmDeleteModal">
    <i class="fas fa-trash-alt mr-2"></i>Hapus Akun
</button>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-left-danger">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Apakah Anda yakin ingin menghapus akun?</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <p class="text-muted">
                        Setelah akun Anda dihapus, semua data dan riwayat laporan Anda akan dihapus secara permanen. 
                        Silakan masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun ini secara permanen.
                    </p>
                    
                    <div class="form-group mt-3">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" id="password" name="password" placeholder="Masukkan Password Anda" required>
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary shadow-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger shadow-sm">Ya, Hapus Akun Saya</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($errors->userDeletion->isNotEmpty())
<script>
    // Buka otomatis modal jika ada error dari percobaan sebelumnya
    document.addEventListener("DOMContentLoaded", function() {
        $('#confirmDeleteModal').modal('show');
    });
</script>
@endif
