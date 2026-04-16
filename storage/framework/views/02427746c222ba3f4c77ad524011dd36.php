<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* 1. MENGHAPUS BAR HITAM ADMIN: Agar tampilan mahasiswa bersih */
        nav.bg-white, nav.border-b, .bg-gray-800, nav[x-data], .navbar-dark { 
            display: none !important; 
        }

        /* 2. STYLE BODY DAN KARTU */
        body { background-color: #f4f7fe; font-family: 'Inter', sans-serif; }
        .card { border-radius: 25px !important; border: none !important; box-shadow: 0 10px 30px rgba(0,0,0,0.05) !important; }
        .form-control, .form-select { border-radius: 12px; border: 1px solid #e3e6f0; padding: 12px 15px; }
        
        /* 3. SEMBUNYIKAN INPUT BUKU SECARA DEFAULT (Akan muncul jika dipilih) */
        #input_buku { display: none; }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <a href="<?php echo e(route('mahasiswa.dashboard')); ?>" class="btn btn-link text-decoration-none text-muted mb-4 p-0 fw-bold">
                    ⬅️ Kembali ke Dashboard
                </a>

                <div class="card shadow-lg">
                    <div class="card-body p-4 p-md-5">
                        
                        <div class="text-center mb-5">
                            <div style="font-size: 3rem;">📝</div>
                            <h3 class="fw-bold text-dark">Tambah Laporan Baru</h3>
                            <p class="text-muted small">Pilih kategori untuk menyesuaikan jenis laporan.</p>
                        </div>

                        <form action="<?php echo e(route('mahasiswa.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?> 

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Kategori Laporan</label>
                                    <select name="jenis_laporan" id="jenis_laporan" class="form-select shadow-sm" onchange="gantiInput()" required>
                                        <option value="barang_penunjang">📦 Barang Penunjang (ATK)</option>
                                        <option value="buku">📖 Buku Koleksi</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Semester Berjalan</label>
                                    <select name="semester" class="form-select shadow-sm" required>
                                        <?php for($i = 4; $i <= 8; $i++): ?>
                                            <option value="<?php echo e($i); ?>">Semester <?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label id="label_item" class="form-label small fw-bold text-primary">Nama Barang / ATK</label>
                                    <input type="text" name="nama_item" class="form-control" placeholder="Masukkan nama barang..." required>
                                </div>

                                <div class="col-12">
                                    <div id="input_atk" class="p-3 rounded-3" style="background-color: #fffbeb; border: 1px solid #fef3c7;">
                                        <label class="form-label small fw-bold text-warning">Keterangan Penggunaan ATK</label>
                                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Untuk print tugas akhir..."></textarea>
                                    </div>

                                    <div id="input_buku" class="p-3 rounded-3" style="background-color: #eef2ff; border: 1px solid #c7d2fe;">
                                        <label class="form-label small fw-bold text-primary">Ringkasan / Sinopsis Buku</label>
                                        <textarea name="ringkasan_buku" class="form-control" rows="3" placeholder="Jelaskan singkat isi buku..."></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label small fw-bold">Nominal Harga (Rp)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light fw-bold">Rp</span>
                                        <input type="number" name="harga" class="form-control" placeholder="0" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Foto Nota</label>
                                    <input type="file" name="foto_nota" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Foto Barang</label>
                                    <input type="file" name="foto_barang" class="form-control" required>
                                </div>

                                <div class="col-12 mt-5">
                                    <button type="submit" class="btn btn-primary w-100 fw-bold py-3 shadow-sm rounded-pill">
                                        🚀 KIRIM LAPORAN SEKARANG
                                    </button>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
                <p class="text-center mt-4 text-muted small">&copy; 2026 Eratme Scholarship | Fitria Yosefina</p>
            </div>
        </div>
    </div>

    <script>
        function gantiInput() {
            // Mengambil nilai dari dropdown kategori
            var kategori = document.getElementById("jenis_laporan").value;
            
            // Mengambil elemen-elemen form
            var divAtk = document.getElementById("input_atk");
            var divBuku = document.getElementById("input_buku");
            var labelItem = document.getElementById("label_item");

            // Jika pilih BUKU
            if (kategori === "buku") {
                divAtk.style.display = "none"; // Sembunyikan ATK
                divBuku.style.display = "block"; // Tampilkan BUKU
                labelItem.innerText = "Judul Buku Lengkap"; // Ganti Label
            } 
            // Jika pilih ATK
            else {
                divAtk.style.display = "block"; // Tampilkan ATK
                divBuku.style.display = "none"; // Sembunyikan BUKU
                labelItem.innerText = "Nama Barang / ATK"; // Ganti Label
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\Dell\reportbook\resources\views/mahasiswa/upload.blade.php ENDPATH**/ ?>