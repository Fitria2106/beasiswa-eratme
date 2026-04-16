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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* Sembunyikan navbar bawaan agar tidak double */
        nav.bg-white, nav.border-b, .bg-gray-800, nav[x-data] { display: none !important; }

        body { background-color: #f4f7fe; font-family: 'Inter', sans-serif; }
        
        .card-edit { border-radius: 25px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }

        /* TOMBOL SIMPAN DENGAN EFEK KLIK KUAT */
        .btn-update {
            background: linear-gradient(45deg, #4e73df, #224abe);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-update:hover {
            background: linear-gradient(45deg, #224abe, #1a3b99);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
            color: white;
        }

        /* Efek saat diklik (Active State) */
        .btn-update:active {
            background: #1a3b99 !important;
            transform: translateY(2px) !important; /* Terlihat tertekan ke bawah */
            box-shadow: inset 0 3px 5px rgba(0,0,0,0.2) !important; /* Bayangan di dalam */
            transition: 0.05s;
        }

        .btn-cancel {
            background-color: #f8f9fc;
            color: #858796;
            border: 1px solid #e3e6f0;
            border-radius: 12px;
            padding: 12px 25px;
            font-weight: 600;
            text-decoration: none;
        }

        .input-custom { border-radius: 12px; border: 1px solid #e3e6f0; padding: 12px; }
        .input-custom:focus { border-color: #4e73df; box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.1); }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <a href="<?php echo e(route('mahasiswa.dashboard')); ?>" class="text-decoration-none text-muted mb-4 d-inline-block fw-bold">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
                </a>

                <div class="card card-edit shadow-lg bg-white">
                    <div class="card-body p-4 p-md-5">
                        
                        <div class="text-center mb-5">
                            <div class="display-6 text-primary mb-2"><i class="bi bi-pencil-square"></i></div>
                            <h3 class="fw-bold text-dark">Perbaiki Laporan</h3>
                            <p class="text-muted small">Update data laporan beasiswa Anda dengan benar.</p>
                        </div>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                                <ul class="mb-0 small">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><i class="bi bi-exclamation-circle me-2"></i><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('mahasiswa.update', $report->id)); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="row g-4">
                                <div class="col-md-7">
                                    <label class="form-label small fw-bold">Nama Barang / Judul Buku</label>
                                    <input type="text" name="nama_item" class="form-control input-custom" value="<?php echo e(old('nama_item', $report->nama_item)); ?>" required>
                                </div>

                                <div class="col-md-5">
                                    <label class="form-label small fw-bold">Harga (Rp)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light fw-bold">Rp</span>
                                        <input type="number" name="harga" class="form-control input-custom" value="<?php echo e(old('harga', $report->harga)); ?>" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="p-3 rounded-4 border bg-light">
                                        <label class="form-label small fw-bold d-block mb-3">Foto Nota Pembelian</label>
                                        <div class="d-flex align-items-center gap-4">
                                            <img src="<?php echo e(asset('storage/' . $report->foto_nota)); ?>" class="rounded-3 shadow-sm border" style="width: 100px; height: 100px; object-fit: cover;">
                                            <div>
                                                <input type="file" name="foto_nota" class="form-control form-control-sm">
                                                <small class="text-muted d-block mt-2 italic">Kosongkan jika tidak ingin mengganti nota.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="p-3 rounded-4 border bg-light">
                                        <label class="form-label small fw-bold d-block mb-3">Foto Barang Fisik</label>
                                        <div class="d-flex align-items-center gap-4">
                                            <img src="<?php echo e(asset('storage/' . $report->foto_barang)); ?>" class="rounded-3 shadow-sm border" style="width: 100px; height: 100px; object-fit: cover;">
                                            <div>
                                                <input type="file" name="foto_barang" class="form-control form-control-sm">
                                                <small class="text-muted d-block mt-2 italic">Kosongkan jika tidak ingin mengganti foto barang.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-5 d-flex justify-content-end gap-2">
                                    <a href="<?php echo e(route('mahasiswa.dashboard')); ?>" class="btn btn-cancel">
                                        BATAL
                                    </a>
                                    <button type="submit" class="btn btn-update px-5 shadow-sm">
                                        <i class="bi bi-check-circle-fill me-2"></i>SIMPAN PERUBAHAN
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
<?php endif; ?><?php /**PATH C:\Users\Dell\reportbook\resources\views/mahasiswa/edit.blade.php ENDPATH**/ ?>