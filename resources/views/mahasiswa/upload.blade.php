<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .card { border-radius: 20px !important; border: none !important; }
        .form-control, .form-select { border-radius: 10px; border: 1px solid #dee2e6; padding: 12px; }
        .form-control:focus, .form-select:focus { border-color: #4e73df; box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.1); }
        .btn-upload { border-radius: 12px; padding: 12px; font-weight: bold; transition: 0.3s; }
        .upload-icon { font-size: 2rem; color: #4e73df; margin-bottom: 10px; }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-link text-decoration-none text-muted mb-3 p-0">
                    ⬅️ Kembali ke Dashboard
                </a>

                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="upload-icon">📝</div>
                            <h3 class="fw-black text-dark">Tambah Laporan Baru</h3>
                            <p class="text-muted small">Pastikan data nota dan barang sesuai untuk mempermudah verifikasi admin.</p>
                        </div>

                        <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data" x-data="{ jenis: 'barang_penunjang' }">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">Kategori Laporan</label>
                                    <select name="jenis_laporan" x-model="jenis" class="form-select shadow-sm" required>
                                        <option value="barang_penunjang">📦 Barang Penunjang (ATK)</option>
                                        <option value="buku">📖 Buku Koleksi</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">Semester</label>
                                    <select name="semester" class="form-select shadow-sm" required>
                                        @for ($i = 4; $i <= 8; $i++)
                                            <option value="{{ $i }}">Semester {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label small fw-bold text-muted">
                                        <span x-show="jenis == 'buku'">Judul Buku</span>
                                        <span x-show="jenis == 'barang_penunjang'">Nama Barang ATK</span>
                                    </label>
                                    <input type="text" name="nama_item" class="form-control" placeholder="Contoh: Kalkulus Purcell / Kertas A4" required>
                                </div>

                                <div class="col-12" x-show="jenis == 'buku'" x-transition>
                                    <div class="bg-success-subtle p-3 rounded-3 border border-success-subtle">
                                        <label class="form-label small fw-bold text-success">Ringkasan / Sinopsis Buku</label>
                                        <textarea name="ringkasan_buku" class="form-control" rows="3" placeholder="Jelaskan sedikit tentang isi buku ini..."></textarea>
                                    </div>
                                </div>

                                <div class="col-12" x-show="jenis == 'barang_penunjang'" x-transition>
                                    <div class="bg-warning-subtle p-3 rounded-3 border border-warning-subtle">
                                        <label class="form-label small fw-bold text-warning">Keterangan Penggunaan ATK</label>
                                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Digunakan untuk keperluan cetak tugas akhir..."></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label small fw-bold text-muted">Harga (Rp)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted">Rp</span>
                                        <input type="number" name="harga" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">Foto Nota</label>
                                    <input type="file" name="foto_nota" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">Foto Barang</label>
                                    <input type="file" name="foto_barang" class="form-control" required>
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary w-100 fw-bold py-3 shadow-sm rounded-pill">
                                        🚀 Kirim Laporan Sekarang
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>