<x-app-layout>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3 mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-shield-lock-fill me-2 text-primary"></i> ADMIN DASHBOARD</a>
            <div class="dropdown ms-auto">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-2" style="width: 35px; height: 35px;">A</div>
                    <span class="small d-none d-md-inline">Administrator</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person-gear me-2"></i> Akun Admin</a></li>
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
            <div class="col-md-4 text-center">
                <div class="card shadow-sm border-0 p-4 rounded-4">
                    <h6 class="text-muted small fw-bold">TOTAL PENGAJUAN</h6>
                    <h2 class="fw-bold text-primary">{{ $allReports->count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="card shadow-sm border-0 p-4 rounded-4">
                    <h6 class="text-muted small fw-bold">MENUNGGU KONFIRMASI</h6>
                    <h2 class="fw-bold text-warning">{{ $allReports->where('status', 'pending')->count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="card shadow-sm border-0 p-4 rounded-4">
                    <h6 class="text-muted small fw-bold">DANA DISETEJUI</h6>
                    <h2 class="fw-bold text-success">Rp{{ number_format($allReports->where('status', 'disetujui')->sum('harga'), 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden mt-4">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="fw-bold mb-0"><i class="bi bi-list-task me-2 text-primary"></i>Verifikasi Laporan Mahasiswa</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="bg-light">
                        <tr class="small fw-bold">
                            <th class="py-3">MAHASISWA</th>
                            <th>BARANG</th>
                            <th>HARGA</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allReports as $report)
                        <tr>
                            <td class="text-start ps-4">
                                <div class="fw-bold">{{ $report->user->name ?? 'User Tak Dikenal' }}</div>
                                <div class="text-muted small">{{ $report->user->nim ?? '-' }}</div>
                            </td>
                            <td class="text-start">
    <div class="fw-bold text-dark">{{ $report->nama_item }}</div>
    <button type="button" class="btn btn-link p-0 shadow-none small text-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#detailModal{{ $report->id }}">
        <i class="bi bi-eye me-1"></i>Lihat Ringkasan
    </button>
</td>

<div class="modal fade" id="detailModal{{ $report->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 20px;">
            <div class="modal-header bg-light border-0 py-3" style="border-radius: 20px 20px 0 0;">
                <h5 class="modal-title fw-bold"><i class="bi bi-info-circle me-2 text-primary"></i>Ringkasan Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="text-muted small fw-bold">NAMA ITEM</label>
                    <p class="fw-bold text-dark border-bottom pb-2">{{ $report->nama_item }}</p>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="text-muted small fw-bold">KATEGORI</label>
                        <p class="text-uppercase">{{ $report->jenis_laporan }}</p>
                    </div>
                    <div class="col-6">
                        <label class="text-muted small fw-bold">HARGA</label>
                        <p class="fw-bold text-success">Rp {{ number_format($report->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold">RINGKASAN / KETERANGAN</label>
                    <p class="bg-light p-3 rounded" style="font-size: 13px;">{{ $report->ringkasan_buku ?? 'Tidak ada keterangan tambahan.' }}</p>
                </div>
                <div class="row g-2">
                    <div class="col-6 text-center">
                        <label class="text-muted small fw-bold d-block mb-2">FOTO NOTA</label>
                        <img src="{{ asset('storage/' . $report->foto_nota) }}" class="img-fluid rounded shadow-sm border" style="max-height: 150px; cursor: pointer;" onclick="window.open(this.src)">
                    </div>
                    <div class="col-6 text-center">
                        <label class="text-muted small fw-bold d-block mb-2">FOTO BARANG</label>
                        <img src="{{ asset('storage/' . $report->foto_barang) }}" class="img-fluid rounded shadow-sm border" style="max-height: 150px; cursor: pointer;" onclick="window.open(this.src)">
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pb-4">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ url('/admin/verifikasi/'.$report->id) }}" class="btn btn-primary rounded-pill px-4 fw-bold">Verifikasi Sekarang</a>
            </div>
        </div>
    </div>
</div>
                            <td>
                                <span class="badge px-3 py-2 rounded-pill {{ $report->status == 'pending' ? 'bg-warning text-dark' : ($report->status == 'disetujui' ? 'bg-success' : 'bg-danger') }}">
                                    {{ strtoupper($report->status ?? 'PENDING') }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ url('/admin/verifikasi/'.$report->id) }}" class="btn btn-sm btn-dark rounded-pill px-3 shadow-sm">Detail</a>
    
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script
</x-app-layout>