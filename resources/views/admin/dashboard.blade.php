<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Eratme Scholarship</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f0f2f5; font-family: 'Inter', sans-serif; }
        
        /* Navbar Gradient */
        .navbar-admin { background: linear-gradient(45deg, #1a1a1a, #333); border-bottom: 4px solid #4e73df; }
        
        /* Card Stats Modern */
        .card-stats { border: none; border-radius: 20px; transition: 0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .card-stats:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .icon-circle { width: 50px; height: 50px; border-radius: 15px; display: flex; align-items: center; justify-content: center; }

        /* Table Design */
        .table-container { background: white; border-radius: 25px; overflow: hidden; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .table thead th { background-color: #f8f9fc; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; color: #4e73df; padding: 15px; }
        .table td { padding: 15px; vertical-align: middle; }

        /* Print Settings */
        @media print {
            .no-print, .btn, .navbar, .modal-footer { display: none !important; }
            .container { width: 100% !important; max-width: 100% !important; margin: 0; }
            .table td, .table th { border: 1px solid #dee2e6 !important; }
            .print-only { display: block !important; }
        }
        .print-only { display: none; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-admin py-3 no-print">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <i class="bi bi-shield-check-fill me-2 text-primary fs-3"></i> 
                ERATME <span class="text-primary ms-1">ADMIN</span>
            </a>
            <div class="ms-auto d-flex align-items-center text-white">
                <small class="me-3 d-none d-md-block opacity-75">Admin: <strong>{{ Auth::user()->name }}</strong></small>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm rounded-pill px-4 fw-bold shadow-sm">
                        <i class="bi bi-power"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4 print-only">
        <div class="d-flex align-items-center border-bottom pb-3 mb-4">
            <i class="bi bi-mortarboard-fill text-primary display-4 me-3"></i>
            <div>
                <h2 class="fw-bold mb-0">BEASISWA ERATME SCHOLARSHIP</h2>
                <p class="mb-0 text-muted">Kitong Bisa Foundation Indonesia | Laporan Verifikasi Dana Mahasiswa</p>
            </div>
        </div>
        <p class="small text-muted">Dicetak pada: {{ date('d M Y, H:i') }}</p>
    </div>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5 no-print">
            <div>
                <h3 class="fw-bold text-dark mb-1">Pusat Kendali Laporan</h3>
                <p class="text-muted mb-0 small">Verifikasi bukti fisik dan nota belanja mahasiswa secara real-time.</p>
            </div>
            <button onclick="window.print()" class="btn btn-dark rounded-pill px-4 shadow">
                <i class="bi bi-printer-fill me-2"></i> Cetak Laporan PDF
            </button>
        </div>

        <div class="row g-4 mb-5 no-print">
            <div class="col-md-4">
                <div class="card card-stats p-4 bg-white">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-muted small fw-bold text-uppercase mb-1">Mahasiswa Melapor</p>
                            <h2 class="fw-bold mb-0">{{ \App\Models\Report::distinct('user_id')->count('user_id') }} <span class="fs-6 fw-normal text-muted">Orang</span></h2>
                        </div>
                        <div class="icon-circle bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-people-fill fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-stats p-4 bg-white">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-muted small fw-bold text-uppercase mb-1">Total Item Laporan</p>
                            <h2 class="fw-bold mb-0">{{ \App\Models\Report::count() }} <span class="fs-6 fw-normal text-muted">Item</span></h2>
                        </div>
                        <div class="icon-circle bg-dark bg-opacity-10 text-dark">
                            <i class="bi bi-cart-check-fill fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-stats p-4 bg-white border-start border-warning border-5">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-warning small fw-bold text-uppercase mb-1">Butuh Verifikasi</p>
                            <h2 class="fw-bold mb-0 text-warning">{{ $allReports->where('status', 'pending')->count() }}</h2>
                        </div>
                        <div class="icon-circle bg-warning text-white">
                            <i class="bi bi-hourglass-split fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-container shadow-sm">
            <div class="p-4 bg-white border-bottom no-print">
                <h5 class="fw-bold mb-0"><i class="bi bi-list-stars me-2 text-primary"></i>Daftar Pengajuan Terbaru</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Identitas Mahasiswa</th>
                            <th>Item & Kategori</th>
                            <th>Ringkasan / Keterangan</th>
                            <th>Nominal & Status</th>
                            <th class="text-center no-print">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       <div class="table-container shadow-sm border-0 mt-4">
    <div class="table-responsive">
        <table class="table table-bordered align-middle mb-0">
            <thead class="table-light text-primary">
                <tr>
                    <th class="ps-4" style="width: 40%;">Daftar Item / Buku</th>
                    <th style="width: 20%;">Kategori</th>
                    <th style="width: 20%;">Nominal Harga</th>
                    <th class="text-center no-print" style="width: 20%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- GROUPING: Kita kelompokkan laporan berdasarkan Nama Mahasiswa --}}
                @forelse($allReports->groupBy('user_id') as $userId => $userReports)
                    @php 
                        $user = $userReports->first()->user; 
                        $totalPerMahasiswa = $userReports->sum('harga');
                    @endphp

                    <tr class="table-secondary shadow-sm">
                        <td colspan="4" class="ps-4 py-3">
                            <i class="bi bi-person-badge-fill me-2"></i>
                            <span class="fw-bold fs-5 text-dark">{{ strtoupper($user->name) }}</span> 
                            <span class="text-muted ms-2">| {{ $user->nim }} | UTDI Yogyakarta</span>
                        </td>
                    </tr>

                    @foreach($userReports as $report)
                    <tr>
                        <td class="ps-5">
                            <div class="fw-bold">{{ $report->nama_item }}</div>
                            <small class="text-muted italic">{{ $report->ringkasan_buku ?? $report->keterangan }}</small>
                        </td>
                        <td>
                            <span class="badge {{ $report->jenis_laporan == 'buku' ? 'bg-success-subtle text-success' : 'bg-info-subtle text-info' }}">
                                {{ strtoupper($report->jenis_laporan) }}
                            </span>
                        </td>
                        <td class="fw-bold">Rp {{ number_format($report->harga, 0, ',', '.') }}</td>
                        <td class="text-center no-print">
                            <button class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="modal" data-bs-target="#modalReport{{ $report->id }}">
                                <i class="bi bi-search"></i> Periksa
                            </button>
                        </td>
                    </tr>
                    @endforeach

                    <tr class="bg-light">
                        <td colspan="2" class="text-end fw-bold py-2">Total Belanja {{ explode(' ', $user->name)[0] }}:</td>
                        <td colspan="2" class="fw-bold text-primary py-2">Rp {{ number_format($totalPerMahasiswa, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-5">Belum ada data pengajuan.</td></tr>
                @endforelse
            </tbody>

            <tfoot class="table-dark no-print">
                <tr>
                    <td colspan="2" class="text-end fw-bold py-3">TOTAL KESELURUHAN DANA TERPAKAI :</td>
                    <td colspan="2" class="fw-bold py-3 fs-5">
                        Rp {{ number_format($allReports->sum('harga'), 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>