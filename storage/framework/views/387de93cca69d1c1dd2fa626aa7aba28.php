<!DOCTYPE html>
<html>
<head>
    <title>Laporan Beasiswa Eratme</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .logo { width: 80px; height: auto; }
        .title { font-size: 18px; font-weight: bold; margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .text-right { text-align: right; }
        .total-row { font-weight: bold; background-color: #eee; }
        .footer { margin-top: 30px; text-align: right; font-style: italic; }
    </style>
</head>
<body>

    <div class="header">
    <?php
        // 1. Cek folder public/images/ apakah namanya logo-eratme.png atau logo-eramet.png
        // Sesuaikan nama file di bawah ini dengan yang ada di folder kamu
        $namaFile = 'logo-eratme.png'; 
        $path = public_path('images/' . $namaFile);
        
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        } else {
            $base64 = null;
        }
    ?>
    
    <?php if($base64): ?>
        <img src="<?php echo e($base64); ?>" class="logo">
    <?php else: ?>
        <div style="color: red; font-size: 10px;">
            Logo tidak ditemukan di: <?php echo e($path); ?>

        </div>
    <?php endif; ?>

    <div class="title">LAPORAN PENGGUNAAN DANA BEASISWA ERATME</div>
    <p>Yogyakarta, <?php echo e(date('d F Y')); ?></p>
</div>
    <?php $__currentLoopData = $grouped_reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userId => $userReports): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $user = $userReports->first()->user; ?>
        <h3>Mahasiswa: <?php echo e(strtoupper($user->name)); ?> (<?php echo e($user->nim); ?>)</h3>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Item</th>
                    <th>Ringkasan</th>
                    <th class="text-right">Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $userReports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($report->nama_item); ?></td>
                    <td><?php echo e($report->ringkasan_buku ?? $report->keterangan); ?></td>
                    <td class="text-right">Rp <?php echo e(number_format($report->harga, 0, ',', '.')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="3" class="text-right">Sub-Total</td>
                    <td class="text-right">Rp <?php echo e(number_format($userReports->sum('harga'), 0, ',', '.')); ?></td>
                </tr>
            </tfoot>
        </table>
        <hr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="footer">
        <p>Dicetak secara sistem oleh Admin Eratme</p>
    </div>

</body>
</html><?php /**PATH C:\Users\Dell\reportbook\resources\views/admin/cetak_pdf.blade.php ENDPATH**/ ?>