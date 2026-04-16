<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        .bg-gradient-custom { background: linear-gradient(45deg, #4e73df, #224abe); }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">

    
    <?php if(auth()->guard()->check()): ?>
        <?php if(Auth::user()->role == 'admin'): ?>
            
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3 mb-4">
                <div class="container">
                    <a class="navbar-brand fw-bold d-flex align-items-center" href="<?php echo e(route('admin.dashboard')); ?>">
                        <div class="bg-primary rounded-circle p-2 me-2 d-inline-flex">
                            <i class="bi bi-shield-lock-fill text-white fs-5"></i>
                        </div>
                        <span>Admin Eratme</span>
                    </a>
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="adminNav">
                        <ul class="navbar-nav me-auto ms-lg-4">
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active fw-bold text-primary' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/laporan')); ?>">Verifikasi Laporan</a>
                            </li>
                        </ul>
                        <div class="d-flex align-items-center gap-3">
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-4">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        <?php else: ?>
            
            <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-custom shadow-sm py-3 mb-4 no-print">
                <div class="container">
                    <a class="navbar-brand fw-bold" href="<?php echo e(route('mahasiswa.dashboard')); ?>">
                        <i class="bi bi-mortarboard-fill me-2"></i> Eratme Scholarship
                    </a>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto align-items-center">
                            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('mahasiswa.dashboard')); ?>">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo e(url('/upload')); ?>">Input Laporan</a></li>
                            <li class="nav-item ms-lg-3">
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-light btn-sm rounded-pill px-4 text-primary fw-bold">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php endif; ?>
    <?php endif; ?>

    
    <main>
        <?php echo e($slot); ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\Dell\reportbook\resources\views/layouts/app.blade.php ENDPATH**/ ?>