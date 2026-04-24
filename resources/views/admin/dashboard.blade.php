<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Eramet Beyond Scholarship</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f4f7fe; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        
        .sidebar { width: 280px; height: 100vh; background: #1a1a1a; position: fixed; transition: 0.3s; z-index: 1050; color: white; left: 0; }
        .main-content { margin-left: 280px; padding: 40px; min-height: 100vh; transition: 0.3s; width: calc(100% - 280px); }

        .nav-link-admin { padding: 12px 25px; color: rgba(255,255,255,0.7); font-weight: 500; display: flex; align-items: center; text-decoration: none; transition: 0.3s; margin: 5px 15px; border-radius: 10px; }
        .nav-link-admin:hover, .nav-link-admin.active { background: #4e73df; color: white !important; }
        
        @media (max-width: 992px) {
            .sidebar { left: -280px; }
            .sidebar.active { left: 0; }
            .main-content { margin-left: 0; padding: 20px; width: 100%; }
            .main-content.shifted { filter: blur(2px); pointer-events: none; }
            .desktop-table { display: none !important; }
            .mobile-cards { display: block !important; }
        }

        .card-stats { border: none; border-radius: 20px; transition: 0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.05); color: white !important; }
        .bg-navy-custom { background-color: #0d2451 !important; }
        
        .table-container { background: white; border-radius: 25px; overflow: hidden; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }

        .mobile-cards { display: none; }
        .admin-card-mobile { 
            background: #0d2451; 
            border-radius: 25px; 
            padding: 20px; 
            margin-bottom: 20px; 
            color: white;
            border-bottom: 6px solid #198754; 
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .btn-periksa-hijau { background-color: #198754 !important; border: none; color: white; font-weight: bold; border-radius: 12px; }

        /* Mencegah layar transparan/hitam saat modal buka */
        .modal { z-index: 9999 !important; }
        .modal-backdrop { z-index: 9998 !important; }

        @media print {
            .sidebar, .no-print, .btn, .navbar-mobile { display: none !important; }
            .main-content { margin-left: 0 !important; padding: 0 !important; width: 100% !important; }
            body { background-color: white !important; }
        }
    </style>
</head>
<body>

    <nav class="navbar-mobile d-lg-none bg-dark text-white p-3 no-print d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">ERAMET ADMIN</h5>
        <button class="btn btn-primary btn-sm" id="toggleSidebar">
            <i class="bi bi-list fs-4"></i>
        </button>
    </nav>

    <div class="sidebar no-print shadow" id="sidebar">
        <div class="p-4 text-center border-bottom border-secondary">
            <div class="bg-primary rounded-3 d-inline-block p-2 mb-2 shadow">
                <i class="bi bi-shield-lock-fill text-white fs-3"></i>
            </div>
            <h5 class="fw-bold mb-0"> Eramet Beyond Scholarship <span class="text-primary">ADMIN</span></h5>
            <small class="text-muted" style="font-size: 10px;">Kitong Bisa Foundation</small>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="nav-link-admin active"><i class="bi bi-speedometer2 me-3"></i> Dashboard</a>
            <a href="#" class="nav-link-admin"><i class="bi bi-people me-3"></i> Daftar Mahasiswa</a>
            <hr class="mx-4 border-secondary opacity-25">
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <a href="#" class="nav-link-admin text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-power me-3"></i> Logout</a>
            </form>
                
        </div>
    </div>

    <div class="main-content" id="mainContent">
        {{-- Notifikasi Sukses --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 no-print gap-3">
            <div>
                <h3 class="fw-bold mb-0 text-dark">Pusat Kendali Beasiswa</h3>
                <p class="text-muted small mb-0">Monitor penggunaan dana Eramet Scholarship</p>
            </div>
            <a href="{{ route('admin.cetak_pdf') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm fw-bold bg-white w-auto">
                <i class="bi bi-file-earmark-pdf me-2"></i> Download PDF
            </a>
        </div>

        <div class="row g-4 mb-5 no-print">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card card-stats p-4 bg-navy-custom h-100 text-center text-md-start">
                    <small class="fw-bold text-uppercase" style="color: #a5b4fc;">Total Mahasiswa</small>
                    <h2 class="fw-bold mb-0 text-white">{{ $allReports->unique('user_id')->count() }} Orang</h2>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card card-stats p-4 bg-navy-custom h-100 text-center text-md-start">
                    <small class="fw-bold text-uppercase" style="color: #a5b4fc;">Item Dilaporkan</small>
                    <h2 class="fw-bold mb-0 text-white">{{ $allReports->count() }} Item</h2>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-stats p-4 bg-navy-custom h-100 text-center text-md-start shadow-lg" style="background: linear-gradient(45deg, #0d2451, #1e3a8a) !important;">
                    <small class="fw-bold text-uppercase" style="color: #a5b4fc;">Dana Terpakai</small>
                    <h2 class="fw-bold mb-0 text-white">Rp {{ number_format($allReports->sum('harga'), 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>

        <div class="table-container shadow-sm border-0 desktop-table">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width: 800px;">
                    <thead class="bg-navy-custom text-white">
                        <tr>
                            <th class="ps-4 py-3">Item & Ringkasan</th>
                            <th>Kategori</th>
                            <th class="text-end pe-4">Harga</th>
                            <th class="text-center no-print">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allReports->groupBy('user_id') as $userId => $userReports)
                            @php $user = $userReports->first()->user; @endphp
                            <tr class="table-secondary">
                                <td colspan="4" class="ps-4 py-3">
                                    <i class="bi bi-person-fill me-2 text-primary"></i>
                                    <strong>{{ strtoupper($user->name) }}</strong>
                                    <small class="ms-2 opacity-75">({{ $user->nim }})</small>
                                </td>
                            </tr>
                            @foreach($userReports as $report)
                            <tr>
                                <td class="ps-5 py-3">
                                    <div class="fw-bold text-dark">{{ $report->nama_item }}</div>
                                    <div class="bg-light p-2 rounded mt-1 shadow-sm border-start border-primary border-3">
                                        <small class="text-muted italic">{{ $report->ringkasan_buku ?? $report->keterangan }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ strtoupper(str_replace('_', ' ', $report->jenis_laporan)) }}</span>
                                </td>
                                <td class="fw-bold text-end pe-4">Rp {{ number_format($report->harga, 0, ',', '.') }}</td>
                                <td class="text-center no-print">
                                    @if($report->status == 'disetujui')
                                        <span class="text-success fw-bold small"><i class="bi bi-check-circle-fill"></i> TERVERIFIKASI</span>
                                    @elseif($report->status == 'ditolak')
                                        <span class="text-danger fw-bold small"><i class="bi bi-x-circle-fill"></i> DITOLAK</span>
                                    @else
                                        <button class="btn btn-periksa-hijau btn-sm px-4 shadow-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modal-{{ $report->id }}">
                                            Periksa
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @empty
                            <tr><td colspan="4" class="text-center py-5">Belum ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mobile-cards no-print">
            @foreach($allReports as $report)
            <div class="admin-card-mobile">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <span class="badge bg-success shadow-sm">{{ strtoupper($report->jenis_laporan) }}</span>
                    <div class="text-end">
                        <small class="d-block opacity-75">Nominal</small>
                        <strong class="fs-5 text-white">Rp {{ number_format($report->harga, 0, ',', '.') }}</strong>
                    </div>
                </div>
                <h5 class="fw-bold mb-1">{{ strtoupper($report->user->name) }}</h5>
                <p class="small mb-3" style="color: #cbd5e1;">{{ $report->nama_item }}</p>
                <button class="btn btn-periksa-hijau w-100 py-3 shadow-lg" data-bs-toggle="modal" data-bs-target="#modal-{{ $report->id }}">
                    {{ $report->status == 'disetujui' ? 'LIHAT DATA' : 'PERIKSA DATA' }}
                </button>
            </div>
            @endforeach
        </div>
    </div>

    {{-- AREA MODAL - DI LUAR MAIN CONTENT AGAR TIDAK BLUR/TRANSPARAN --}}
{{-- AREA MODAL --}}
@foreach($allReports as $report)
<div class="modal fade" id="modal-{{ $report->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 25px;">
            <div class="modal-header bg-navy-custom text-white border-0 py-3 px-4">
                <h5 class="modal-title fw-bold">Verifikasi Laporan: {{ $report->nama_item }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body p-4">
                {{-- SINKRONISASI GAMBAR --}}
                <div class="row text-center mb-4">
                    {{-- Kolom Nota --}}
                    <div class="col-6">
                        <label class="fw-bold text-muted small d-block mb-2">Nota</label>
                        <img src="{{ asset('storage/' . $report->foto_nota) }}" 
                             class="img-fluid rounded-4 shadow-sm border bukti-thumbnail" 
                             style="max-height: 200px; width: 100%; object-fit: contain; cursor: pointer;">
                    </div>

                    {{-- Kolom Barang --}}
                    <div class="col-6">
                        <label class="fw-bold text-muted small d-block mb-2">Barang</label>
                        <img src="{{ asset('storage/' . $report->foto_barang) }}" 
                             class="img-fluid rounded-4 shadow-sm border bukti-thumbnail" 
                             style="max-height: 200px; width: 100%; object-fit: contain; cursor: pointer;">
                    </div>
                </div>
                <p class="text-center text-muted small mt-2">Klik gambar untuk memperbesar</p>

                {{-- SINKRONISASI DATA --}}
                <div class="bg-light rounded-4 p-3 mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Mahasiswa</span>
                        <span class="fw-bold">{{ $report->user->name ?? 'N/A' }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Item</span>
                        <span class="fw-bold">{{ $report->nama_item }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Harga</span>
                        <span class="fw-bold text-success">Rp {{ number_format($report->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="mt-2 text-muted small">
                        <i>Keterangan: {{ $report->ringkasan_buku ?? $report->keterangan }}</i>
                    </div>
                </div>

                {{-- FORM ACTION --}}
                <div class="row g-2">
                    <div class="col-6">
                        <form action="{{ route('admin.report.status', $report->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="ditolak">
                            <button type="submit" class="btn btn-outline-danger w-100 py-2 fw-bold rounded-3">Tolak</button>
                        </form>
                    </div>
                    <div class="col-6">
                        <form action="{{ route('admin.report.status', $report->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="disetujui">
                            <button type="submit" class="btn btn-success w-100 py-2 fw-bold rounded-3 shadow-sm">Setujui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('shifted');
        });

        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 992) {
                if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                    mainContent.classList.remove('shifted');
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>