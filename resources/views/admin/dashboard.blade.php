<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Eratme Scholarship</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f4f7fe; font-family: 'Inter', sans-serif; }
        .sidebar { width: 280px; height: 100vh; background: #1a1a1a; position: fixed; transition: 0.3s; z-index: 1000; color: white; }
        .nav-link-admin { padding: 12px 25px; color: rgba(255,255,255,0.7); font-weight: 500; display: flex; align-items: center; text-decoration: none; transition: 0.3s; margin: 5px 15px; border-radius: 10px; }
        .nav-link-admin:hover, .nav-link-admin.active { background: #4e73df; color: white !important; }
        .main-content { margin-left: 280px; padding: 40px; min-height: 100vh; transition: 0.3s; }
        .card-stats { border: none; border-radius: 20px; transition: 0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .table-container { background: white; border-radius: 25px; overflow: hidden; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }

        @media (max-width: 992px) { .sidebar { margin-left: -280px; } .main-content { margin-left: 0; padding: 20px; } }
        @media print {
            .sidebar, .no-print, .btn { display: none !important; }
            .main-content { margin-left: 0 !important; padding: 0 !important; }
            .print-only { display: block !important; }
            body { background-color: white !important; }
            .table { border: 1px solid #dee2e6 !important; width: 100% !important; }
        }
        .print-only { display: none; }
    </style>
</head>
<body>

    <div class="sidebar no-print shadow">
        <div class="p-4 text-center border-bottom border-secondary">
            <div class="bg-primary rounded-3 d-inline-block p-2 mb-2 shadow">
                <i class="bi bi-shield-lock-fill text-white fs-3"></i>
            </div>
            <h5 class="fw-bold mb-0">ERATME <span class="text-primary">ADMIN</span></h5>
            <small class="text-muted" style="font-size: 10px;">Kitong Bisa Foundation</small>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="nav-link-admin active"><i class="bi bi-speedometer2 me-3"></i> Dashboard</a>
            <a href="#" class="nav-link-admin"><i class="bi bi-people me-3"></i> Daftar Mahasiswa</a>
            <hr class="mx-4 border-secondary opacity-25">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link-admin text-danger bg-transparent border-0 w-100 text-start">
                    <i class="bi bi-power me-3"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-5 no-print">
            <div>
                <h3 class="fw-bold mb-0 text-dark">Pusat Kendali Beasiswa</h3>
                <p class="text-muted small mb-0">Monitor penggunaan dana Eratme Scholarship</p>
            </div>
            <a href="{{ route('admin.cetak_pdf') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm fw-bold bg-white">
                <i class="bi bi-file-earmark-pdf me-2"></i> Download PDF
            </a>
        </div>

        <div class="container-fluid p-0">
            <div class="row g-4 mb-5 no-print">
                <div class="col-md-4">
                    <div class="card card-stats p-4 bg-white border-start border-primary border-5 h-100">
                        <small class="text-muted fw-bold text-uppercase">Total Mahasiswa</small>
                        <h2 class="fw-bold mb-0">{{ $allReports->unique('user_id')->count() }} Orang</h2>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card card-stats p-4 bg-white border-start border-success border-5 h-100">
                        <small class="text-muted fw-bold text-uppercase">Item Dilaporkan</small>
                        <h2 class="fw-bold mb-0">{{ $allReports->count() }} Item</h2>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card card-stats p-4 bg-white border-start border-warning border-5 h-100">
                        <small class="text-muted fw-bold text-uppercase">Dana Terpakai</small>
                        <h2 class="fw-bold mb-0 text-primary">Rp {{ number_format($allReports->sum('harga'), 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>
            <div class="table-container shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-primary">
                            <tr>
                                <th class="ps-4" style="width: 45%;">Item & Ringkasan</th>
                                <th style="width: 15%;">Kategori</th>
                                <th style="width: 20%;" class="text-end pe-4">Harga</th>
                                <th class="text-center no-print" style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allReports->groupBy('user_id') as $userId => $userReports)
                                @php 
                                    $user = $userReports->first()->user; 
                                    $totalMhs = $userReports->sum('harga');
                                @endphp
                                
                                <tr class="table-secondary">
                                    <td colspan="4" class="ps-4 py-3">
                                        <i class="bi bi-person-fill me-2 text-primary"></i>
                                        <strong class="fs-5">{{ strtoupper($user->name) }}</strong>
                                        <small class="ms-2">({{ $user->nim }} | KBF Indonesia)</small>
                                    </td>
                                </tr>

                                @foreach($userReports as $report)
                                <tr>
                                    <td class="ps-5 py-3">
                                        <div class="fw-bold text-dark">{{ $report->nama_item }}</div>
                                        <small class="text-muted italic">{{ $report->ringkasan_buku ?? $report->keterangan }}</small>
                                    </td>
                                    <td>
                                        <span class="badge {{ $report->jenis_laporan == 'buku' ? 'bg-success-subtle text-success' : 'bg-info-subtle text-info' }}">
                                            {{ strtoupper(str_replace('_', ' ', $report->jenis_laporan)) }}
                                        </span>
                                    </td>
                                    <td class="fw-bold text-end pe-4">Rp {{ number_format($report->harga, 0, ',', '.') }}</td>
                                    
                                    <td class="text-center no-print">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modal-{{ $report->id }}">
                                                Periksa
                                            </button>
                                            <form action="{{ route('admin.report.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle shadow-sm">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                <tr class="bg-light">
                                    <td colspan="2" class="text-end py-3 text-muted fw-bold">SUB-TOTAL {{ explode(' ', $user->name)[0] }}:</td>
                                    <td class="text-end pe-4 py-3 text-dark fw-bold">Rp {{ number_format($totalMhs, 0, ',', '.') }}</td>
                                    <td class="no-print"></td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center py-5">Belum ada data transaksi.</td></tr>
                            @endforelse
                        </tbody>
                        <tfoot class="table-dark">
                            <tr>
                                <td colspan="2" class="text-end py-4 fw-bold">TOTAL KESELURUHAN DANA :</td>
                                <td class="text-end pe-4 py-4 fs-5 text-warning">Rp {{ number_format($allReports->sum('harga'), 0, ',', '.') }}</td>
                                <td class="no-print"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($allReports as $report)
    <div class="modal fade no-print" id="modal-{{ $report->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 bg-light">
                    <h5 class="fw-bold mb-0 text-primary">Verifikasi Bukti</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                        <small class="text-muted d-block mb-1">Nota</small>
                        <img src="{{ $report->foto_nota ? asset('storage/'.$report->foto_nota) : 'https://placehold.co/400x300?text=No+Image' }}" 
                             class="img-fluid rounded border shadow-sm" 
                             style="height: 150px; width: 100%; object-fit: cover;">
                    </div>
                        <div class="col-6"><small class="text-muted d-block mb-1">Barang</small><img src="{{ asset('storage/'.$report->foto_barang) }}" class="img-fluid rounded border"></div>
                    </div>
                    <h5 class="fw-bold text-dark">{{ $report->nama_item }}</h5>
                </div>
                <div class="modal-footer border-0 justify-content-center pb-4">
                    <form action="{{ route('admin.report.status', $report->id) }}" method="POST"> 
                        @csrf 
                        @method('PATCH')
                        <input type="hidden" name="status" value="disetujui"> 
                        <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold">SETUJUI</button>
                    </form>
                    <form action="/admin/reject/{{ $report->id }}" method="POST"> @csrf @method('PATCH')
                        <button class="btn btn-danger rounded-pill px-4 fw-bold">TOLAK</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>