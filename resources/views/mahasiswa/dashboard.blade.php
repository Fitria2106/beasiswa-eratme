<x-app-layout>
    <style>
        /* 1. SEMBUNYIKAN NAVBAR BAWAAN LARAVEL */
        nav.bg-white, nav.border-b, .bg-gray-800, nav[x-data], .navbar-dark { 
            display: none !important; 
        }

        /* 2. PENYESUAIAN BODY */
        body { background-color: #f4f7fe; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        
        /* 3. SIDEBAR */
        .sidebar { 
            width: 260px; height: 100vh; background: #0d2451; position: fixed; 
            border-right: none; transition: 0.3s; z-index: 1100; color: white;
        }
        .nav-link-custom { 
            padding: 15px 25px; color: rgba(255,255,255,0.7); font-weight: 600; display: flex; 
            align-items: center; text-decoration: none; border-radius: 12px; 
            margin: 8px 15px; transition: 0.3s; 
        }
        .nav-link-custom:hover, .nav-link-custom.active { 
            background: #198754; color: white !important; 
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
        }
        
        /* 4. KONTEN UTAMA */
        .main-content { margin-left: 260px; padding: 40px; transition: 0.3s; min-height: 100vh; }

        /* 5. CARD & BUTTON STYLING */
        .glass-card { 
            background: white; border-radius: 25px; border: none; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.03); 
        }
        .text-navy { color: #0d2451 !important; }
        .bg-navy { background-color: #0d2451 !important; }
        .btn-primary { background-color: #198754 !important; border: none !important; }

        /* Burger & Mobile Styling */
        .btn-burger {
            display: none; background: #0d2451; color: white; border-radius: 10px;
            padding: 8px 12px; border: none; transition: 0.3s;
        }

        .admin-card-mobile {
            background: #0d2451; border-radius: 20px; padding: 20px;
            margin-bottom: 15px; color: white; border-left: 5px solid #198754;
        }

        @media (max-width: 768px) {
            .sidebar { margin-left: -260px; }
            .sidebar.active { margin-left: 0; }
            .main-content { margin-left: 0; padding: 20px; }
            .btn-burger { display: block; }
        }
    </style>

    <div class="sidebar no-print" id="sidebar">
        <div class="p-4 border-bottom border-secondary text-center">
            <i class="bi bi-mortarboard-fill text-white display-6"></i>
            <div class="mt-2">
                <h6 class="fw-bold mb-0 text-white" style="letter-spacing: 1px;">ERATME</h6>
                <small class="fw-bold" style="font-size: 10px; color: #198754;">SCHOLARSHIP</small>
            </div>
        </div>
        <div class="mt-4">
            <a href="#" class="nav-link-custom active"><i class="bi bi-grid-1x2-fill me-3"></i> Dashboard Utama</a>
            <a href="{{ url('/upload') }}" class="nav-link-custom"><i class="bi bi-file-earmark-arrow-up-fill me-3"></i> Upload Laporan</a>
            <a href="{{ route('profile.edit') }}" class="nav-link-custom"><i class="bi bi-person-bounding-box me-3"></i> Profil Saya</a>
            <hr class="mx-4 opacity-25 border-white">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link-custom text-danger border-0 bg-transparent w-100 text-start">
                    <i class="bi bi-box-arrow-right me-3"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="d-flex align-items-center">
                <button class="btn-burger me-3 d-lg-none" id="sidebarCollapse">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <div>
                    <h2 class="fw-bold text-navy mb-0">Dashboard Utama</h2>
                    <p class="text-muted small d-none d-md-block">E-Report Beasiswa Eratme • KBF Indonesia</p>
                </div>
            </div>
            <div class="d-flex align-items-center bg-white p-2 rounded-4 shadow-sm px-3 border">
                <div class="text-end me-3 d-none d-sm-block">
                    <p class="mb-0 fw-bold small text-navy">{{ Auth::user()->name }}</p>
                    <p class="mb-0 text-muted small" style="font-size: 10px;">NIM: {{ Auth::user()->nim }}</p>
                </div>
                <div class="bg-navy text-white rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px; font-weight: bold;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-6">
                <div class="card glass-card p-4 h-100 border-0 shadow-sm text-white bg-navy">
                    <h3 class="fw-bold">Selamat Datang! ✨</h3>
                    <p class="opacity-75 mb-0">Mahasiswa Aktif Semester 7</p>
                    <div class="mt-4 pt-2 border-top border-white border-opacity-25">
                        <small>Akun: <strong>{{ Auth::user()->email }}</strong></small>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card glass-card p-4 h-100 border-0 shadow-sm bg-white border-start border-success border-5">
                    <small class="text-muted fw-bold">SISA SALDO BEASISWA SAYA</small>
                    <h3 class="fw-bold text-navy mt-2">
                        Rp {{ number_format(1500000 - $reports->sum('harga'), 0, ',', '.') }}
                    </h3>
                    <div class="mt-3">
                        <div class="progress" style="height: 10px; border-radius: 10px;">
                            @php
                                $terpakai = $reports->where('status', 'disetujui')->sum('harga');
                                $persen = ($terpakai / 1500000) * 100;
                            @endphp
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $persen }}%"></div>
                        </div>
                        <small class="text-muted mt-2 d-block" style="font-size: 11px;">
                            Terpakai: Rp {{ number_format($terpakai, 0, ',', '.') }} dari Rp 1.500.000
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card glass-card overflow-hidden">
            <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center border-0">
                <h5 class="fw-bold mb-0 text-navy"><i class="bi bi-clock-history me-2"></i>Riwayat Pengajuan</h5>
                <a href="{{ url('/upload') }}" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Baru
                </a>
            </div>

            <div class="table-responsive px-4 pb-4 d-none d-lg-block">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-navy">
                        <tr>
                            <th class="py-3 px-3">Tanggal</th>
                            <th>Item & Jenis</th>
                            <th>Nominal</th>
                            <th class="text-center">Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                        <tr>
                            <td class="small px-3 text-muted">{{ $report->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="fw-bold text-navy">{{ $report->nama_item }}</div>
                                <span class="badge bg-navy text-white" style="font-size: 10px;">{{ strtoupper($report->jenis_laporan) }}</span>
                            </td>
                            <td class="fw-bold text-navy">Rp {{ number_format($report->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @if($report->status == 'disetujui')
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">DISETUJUI</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2 text-uppercase">{{ $report->status }}</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('mahasiswa.edit', $report->id) }}" class="btn btn-sm btn-light border rounded-circle shadow-sm">
                                    <i class="bi bi-pencil-square text-success"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-5">Belum ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-lg-none px-3 pb-4">
                @foreach($reports as $report)
                <div class="admin-card-mobile">
                    <div class="d-flex justify-content-between mb-3">
                        <small class="opacity-75">{{ $report->created_at->format('d M Y') }}</small>
                        <div class="fw-bold">Rp {{ number_format($report->harga, 0, ',', '.') }}</div>
                    </div>
                    <h5 class="fw-bold mb-1">{{ $report->nama_item }}</h5>
                    <span class="badge bg-white text-dark mb-3" style="font-size: 10px;">{{ strtoupper($report->jenis_laporan) }}</span>
                    <div class="d-flex justify-content-between align-items-center bg-white bg-opacity-10 p-2 rounded-3">
                        <small>Status: {{ strtoupper($report->status) }}</small>
                        <a href="{{ route('mahasiswa.edit', $report->id) }}" class="btn btn-sm btn-success rounded-pill px-3">Edit</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Logic Burger Menu
        const btnBurger = document.getElementById('sidebarCollapse');
        const sidebar = document.getElementById('sidebar');

        btnBurger.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            const icon = this.querySelector('i');
            icon.classList.toggle('bi-list');
            icon.classList.toggle('bi-x-lg');
        });
    </script>
</x-app-layout>