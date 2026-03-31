<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Custom Style agar Dashboard terlihat Premium */
        .card { border-radius: 15px !important; border: none !important; transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); }
        .bg-gradient-custom { background: linear-gradient(45deg, #4e73df, #224abe); }
        .progress { border-radius: 10px; background-color: #f1f3f9; }
        .table thead th { background-color: #f8f9fc; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; color: #6c757d; }
        .badge-status { font-size: 10px; font-weight: 800; padding: 5px 12px; }
    </style>

    <div class="container py-5">
        
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="card shadow-sm bg-gradient-custom text-white h-100">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="fw-normal mb-1 opacity-75 text-white">Mahasiswa Aktif</h5>
                            <h2 class="fw-bold mb-2 text-white">{{ Auth::user()->name }}</h2>
                            <p class="mb-0 font-monospace small">NIM: {{ Auth::user()->nim }} | {{ Auth::user()->jurusan }}</p>
                        </div>
                        <div class="d-none d-md-block">
                            <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-bold shadow-sm">
                                {{ Auth::user()->kampus }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm h-100 border-start border-warning border-5">
                    <div class="card-body p-4">
                        <h6 class="text-muted small fw-bold uppercase mb-3">Sisa Saldo Beasiswa</h6>
                        <h2 class="fw-bold text-dark">
                            Rp {{ number_format(1500000 - $reports->sum('harga'), 0, ',', '.') }}
                        </h2>
                        <div class="progress mt-3" style="height: 10px;">
                            <div class="progress-bar bg-warning" role="progressbar" 
                                 style="width: {{ ((1500000 - $reports->sum('harga')) / 1500000) * 100 }}%"></div>
                        </div>
                        <p class="small text-muted mt-2 mb-0 italic">Jatah: Rp 1.500.000 / Semester</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card shadow-sm border-start border-success border-5">
                    <div class="card-body py-4">
                        <h6 class="text-muted small fw-bold uppercase">Total Dana Terpakai</h6>
                        <h3 class="fw-bold text-success">Rp {{ number_format($reports->sum('harga'), 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm bg-light">
                    <div class="card-body py-4 d-flex align-items-center justify-content-center">
                        <a href="{{ url('/upload') }}" class="btn btn-primary fw-bold px-5 py-2 rounded-pill shadow-sm">
                            + Tambah Laporan Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm overflow-hidden">
            <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">Riwayat Laporan Pembelian</h5>
                <span class="badge bg-light text-dark border">Semester Aktif</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr class="text-center">
                                <th class="py-3 px-4">Tanggal</th>
                                <th class="py-3">Smtr</th>
                                <th class="py-3">Kategori</th>
                                <th class="py-3 text-start">Nama Barang</th>
                                <th class="py-3">Harga</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reports as $report)
                            <tr class="text-center">
                                <td class="text-muted px-4 small">{{ $report->created_at->format('d M Y') }}</td>
                                <td class="fw-bold text-primary">{{ $report->semester }}</td>
                                <td>
                                    <span class="badge {{ $report->jenis_laporan == 'buku' ? 'bg-success-subtle text-success' : 'bg-info-subtle text-info' }} rounded-pill px-3">
                                        {{ strtoupper($report->jenis_laporan) }}
                                    </span>
                                </td>
                                <td class="text-start fw-medium text-dark">{{ $report->nama_item }}</td>
                                <td class="fw-bold text-dark">Rp{{ number_format($report->harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge badge-status {{ $report->status == 'disetujui' ? 'bg-success' : ($report->status == 'ditolak' ? 'bg-danger' : 'bg-secondary text-white') }} rounded-pill">
                                        {{ strtoupper($report->status ?? 'PENDING') }}
                                    </span>
                                </td>
                                <td>
                                    @if($report->status !== 'disetujui')
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('mahasiswa.edit', $report->id) }}" class="btn btn-sm btn-outline-primary border-0" title="Edit">✏️</a>
                                        <form action="{{ route('mahasiswa.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0">🗑️</button>
                                        </form>
                                    </div>
                                    @else
                                        <span class="text-muted small italic">Terkunci</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-5 text-center text-muted italic">
                                    Belum ada data laporan. Klik tombol "Tambah Laporan Baru" untuk memulai.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</x-app-layout>