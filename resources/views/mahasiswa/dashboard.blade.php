<x-app-layout>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3 mb-4" style="background: linear-gradient(45deg, #4e73df, #224abe);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-mortarboard-fill me-2"></i> Eratme Mahasiswa</a>
            <div class="dropdown ms-auto">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                    <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold me-2" style="width: 35px; height: 35px;">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <span class="small d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2 text-primary"></i> Lihat Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger"><i class="bi bi-power me-2"></i> Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="row g-4 mb-4">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 p-4 text-white" style="background: linear-gradient(45deg, #4e73df, #224abe); border-radius: 20px;">
                    <h5 class="opacity-75 small">Selamat Datang,</h5>
                    <h2 class="fw-bold">{{ Auth::user()->name }}</h2>
                    <p class="mb-0 small opacity-75 italic">Mahasiswa Aktif Fakultas Teknologi Informasi</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 border-start border-warning border-5 p-4 h-100 bg-white" style="border-radius: 20px;">
                    <h6 class="text-muted small fw-bold uppercase">Sisa Saldo Beasiswa</h6>
                    <h2 class="fw-bold text-dark mt-2">Rp {{ number_format(1500000 - $reports->sum('harga'), 0, ',', '.') }}</h2>
                    <p class="small text-muted mb-0">Total Jatah: Rp 1.500.000</p>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden mt-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0">
                <h5 class="fw-bold mb-0 text-dark">Riwayat Laporan Saya</h5>
                <a href="{{ url('/upload') }}" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm">+ Tambah Baru</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">Tanggal</th>
                            <th class="text-start">Nama Barang</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <td class="text-muted small">{{ $report->created_at->format('d/m/Y') }}</td>
                            <td class="text-start fw-bold">{{ $report->nama_item }}</td>
                            <td class="fw-bold">Rp{{ number_format($report->harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge rounded-pill px-3 {{ $report->status == 'disetujui' ? 'bg-success' : ($report->status == 'ditolak' ? 'bg-danger' : 'bg-secondary') }}">
                                    {{ strtoupper($report->status ?? 'PENDING') }}
                                </span>
                            </td>
                            <td>
                                @if($report->status != 'disetujui')
                                    <a href="{{ route('mahasiswa.edit', $report->id) }}" class="btn btn-sm btn-outline-primary border-0"><i class="bi bi-pencil-square"></i></a>
                                @else
                                    <i class="bi bi-lock-fill text-muted"></i>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>