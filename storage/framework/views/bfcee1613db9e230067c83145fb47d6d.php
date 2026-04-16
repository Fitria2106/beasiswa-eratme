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
    <style>
        /* 1. SEMBUNYIKAN NAVBAR BAWAAN LARAVEL (AGAR TIDAK DOUBLE/TUMPUK) */
        nav.bg-white, nav.border-b, .bg-gray-800, nav[x-data], .navbar-dark { 
            display: none !important; 
        }

        /* 2. PENYESUAIAN BODY */
        body { background-color: #f4f7fe; font-family: 'Inter', sans-serif; }
        
        /* 3. SIDEBAR (NAVIGASI SAMPING MAHASISWA) */
        .sidebar { 
            width: 260px; height: 100vh; background: white; position: fixed; 
            border-right: 1px solid #e3e6f0; transition: 0.3s; z-index: 1000; 
        }
        .nav-link-custom { 
            padding: 15px 25px; color: #4e73df; font-weight: 600; display: flex; 
            align-items: center; text-decoration: none; border-radius: 12px; 
            margin: 8px 15px; transition: 0.3s; 
        }
        .nav-link-custom:hover, .nav-link-custom.active { 
            background: linear-gradient(45deg, #4e73df, #224abe); color: white !important; 
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.2);
        }
        
        /* 4. KONTEN UTAMA (DIBERI MARGIN KIRI AGAR TIDAK TERTUTUP SIDEBAR) */
        .main-content { margin-left: 260px; padding: 40px; transition: 0.3s; min-height: 100vh; }

        /* 5. CARD STYLING */
        .glass-card { 
            background: white; border-radius: 25px; border: none; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.03); 
        }

        @media (max-width: 768px) {
            .sidebar { margin-left: -260px; }
            .main-content { margin-left: 0; padding: 20px; }
        }
    </style>

    <div class="sidebar no-print">
        <div class="p-4 border-bottom text-center">
            <i class="bi bi-mortarboard-fill text-primary display-6"></i>
            <div class="mt-2">
                <h6 class="fw-bold mb-0 text-dark" style="letter-spacing: 1px;">ERATME</h6>
                <small class="text-primary fw-bold" style="font-size: 10px;">SCHOLARSHIP</small>
            </div>
        </div>
        <div class="mt-4">
            <a href="#" class="nav-link-custom active"><i class="bi bi-grid-1x2-fill me-3"></i> Dashboard Utama</a>
            <a href="<?php echo e(url('/upload')); ?>" class="nav-link-custom"><i class="bi bi-file-earmark-arrow-up-fill me-3"></i> Upload Laporan</a>
            <a href="<?php echo e(route('profile.edit')); ?>" class="nav-link-custom"><i class="bi bi-person-bounding-box me-3"></i> Profil Saya</a>
            <hr class="mx-4 opacity-25">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="nav-link-custom text-danger border-0 bg-transparent w-100 text-start">
                    <i class="bi bi-box-arrow-right me-3"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
    
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold text-dark mb-0">Dashboard Utama</h2>
            <p class="text-muted small">E-Report Beasiswa Eratme • KBF Indonesia</p>
        </div>
        <div class="d-flex align-items-center bg-white p-2 rounded-4 shadow-sm px-3 border">
            <div class="text-end me-3">
                <p class="mb-0 fw-bold small text-dark"><?php echo e(Auth::user()->name); ?></p>
                <p class="mb-0 text-muted small" style="font-size: 10px;">NIM: <?php echo e(Auth::user()->nim); ?></p>
            </div>
            <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px; font-weight: bold;">
                <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-lg-6">
            <div class="card glass-card p-4 h-100 border-0 shadow-sm text-white" style="background: linear-gradient(135deg, #4e73df, #224abe);">
                <h3 class="fw-bold">Selamat Datang! ✨</h3>
                <p class="opacity-75 mb-0">Mahasiswa Aktif Semester 7</p>
                <div class="mt-4 pt-2 border-top border-white border-opacity-25">
                    <small>Akun: <strong><?php echo e(Auth::user()->email); ?></strong></small>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card glass-card p-4 h-100 border-0 shadow-sm bg-white border-start border-primary border-5">
                <small class="text-muted fw-bold">SISA SALDO BEASISWA SAYA</small>
                
               <h3 class="fw-bold text-dark mt-2">
                    Rp <?php echo e(number_format(1500000 - $reports->sum('harga'), 0, ',', '.')); ?>

                </h3>
                <div class="mt-3">
                    <div class="progress" style="height: 10px; border-radius: 10px;">
                        <?php
                            $terpakai = $reports->where('status', 'disetujui')->sum('harga');
                            $persen = ($terpakai / 1500000) * 100;
                        ?>
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo e($persen); ?>%"></div>
                    </div>
                    <small class="text-muted mt-2 d-block" style="font-size: 11px;">
                        Terpakai: Rp <?php echo e(number_format($terpakai, 0, ',', '.')); ?> dari Rp 1.500.000
                    </small>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card glass-card p-4 border-0 shadow-sm bg-white border-start border-success border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-bold">TOTAL BUKU DIBELI</small>
                        <h4 class="fw-bold text-success mt-1"><?php echo e($reports->where('jenis_laporan', 'buku')->count()); ?> Item</h4>
                    </div>
                    <i class="bi bi-book fs-2 text-success opacity-25"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card glass-card p-4 border-0 shadow-sm bg-white border-start border-warning border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-bold">TOTAL ITEM ATK</small>
                        <h4 class="fw-bold text-warning mt-1"><?php echo e($reports->where('jenis_laporan', 'barang_penunjang')->count()); ?> Item</h4>
                    </div>
                    <i class="bi bi-pencil-fill fs-2 text-warning opacity-25"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card glass-card overflow-hidden">
        <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center border-0">
            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-clock-history me-2 text-primary"></i>Riwayat Pengajuan Laporan</h5>
            <a href="<?php echo e(url('/upload')); ?>" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold">
                <i class="bi bi-plus-lg me-2"></i>Tambah Baru
            </a>
        </div>
        <div class="table-responsive px-4 pb-4">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="py-3 px-3">Tanggal</th>
                        <th>Item & Jenis</th>
                        <th>Nominal</th>
                        <th class="text-center">Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="small px-3 text-muted"><?php echo e($report->created_at->format('d M Y')); ?></td>
                        <td>
                            <div class="fw-bold text-dark"><?php echo e($report->nama_item); ?></div>
                            <span class="badge bg-light text-primary border border-primary-subtle" style="font-size: 10px;"><?php echo e(strtoupper($report->jenis_laporan)); ?></span>
                        </td>
                        <td class="fw-bold text-dark">Rp <?php echo e(number_format($report->harga, 0, ',', '.')); ?></td>
                        <td class="text-center">
                            <?php if($report->status == 'disetujui'): ?>
                                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">DISETUJUI</span>
                            <?php elseif($report->status == 'ditolak'): ?>
                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">DITOLAK</span>
                            <?php else: ?>
                                <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">PENDING</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end">
                            <?php if($report->status != 'disetujui'): ?>
                                <a href="<?php echo e(route('mahasiswa.edit', $report->id)); ?>" class="btn btn-sm btn-light border rounded-circle shadow-sm">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </a>
                            <?php else: ?>
                                <span class="badge bg-light text-muted border px-2 py-2"><i class="bi bi-lock-fill"></i></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Belum ada laporan pengajuan.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

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
<?php endif; ?><?php /**PATH C:\Users\Dell\reportbook\resources\views/mahasiswa/dashboard.blade.php ENDPATH**/ ?>