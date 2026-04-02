<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Custom Admin Style */
        .card { border-radius: 12px !important; border: none !important; }
        .bg-admin-gradient { background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); }
        .table thead th { 
            background-color: #f8f9fc; 
            text-transform: uppercase; 
            font-size: 10px; 
            font-weight: 800;
            letter-spacing: 0.05em;
            color: #5a5c69;
            vertical-align: middle;
        }
        .img-thumbnail-custom { width: 35px; height: 35px; object-fit: cover; border-radius: 5px; cursor: pointer; }
        .badge-status { font-size: 9px; padding: 5px 10px; border-radius: 50px; font-weight: 700; }
        .btn-verifikasi { font-size: 10px; font-weight: 700; text-transform: uppercase; }
        /* Style untuk Modal agar tidak tertutup navbar */
        .modal-backdrop { z-index: 1040 !important; }
        .modal { z-index: 1050 !important; }
        .truncate { max-width: 120px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block; }
    </style>

    <div class="container-fluid py-4 px-4">
        
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Verifikasi Laporan Beasiswa</h1>
            <a href="{{ route('admin.cetak_pdf') }}" class="btn btn-danger"> 🖨️ Cetak PDF Laporan</a>
               
            </a>
        </div>

        <div class="row g-3 mb-4 text-center">
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm h-100 border-start border-primary border-5 bg-admin-gradient text-white">
                    <div class="card-body py-4">
                        <div class="small fw-bold uppercase opacity-75 mb-1">Total Semua Pengeluaran</div>
                        <div class="h3 mb-0 fw-black">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm h-100 border-start border-success border-5">
                    <div class="card-body py-4">
                        <div class="text-success small fw-bold uppercase mb-1 text-center">Khusus Buku</div>
                        <div class="h3 mb-0 fw-bold text-gray-800">Rp {{ number_format($totalBuku, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm h-100 border-start border-warning border-5">
                    <div class="card-body py-4">
                        <div class="text-warning small fw-bold uppercase mb-1 text-center">Khusus ATK/Penunjang</div>
                        <div class="h3 mb-0 fw-bold text-gray-800">Rp {{ number_format($totalATK, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary fw-bold">Daftar Laporan Mahasiswa</h6>
                <span class="badge bg-light text-dark border small">Semester Aktif</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
    <thead class="text-center">
        <tr>
            <th class="px-3 py-3 border-end">Mahasiswa</th>
            <th class="px-3 py-3 border-end">Tanggal</th>
            <th class="px-3 py-3 border-end">Jenis</th>
            <th class="px-3 py-3 border-end text-start">Detail Barang & Bukti</th>
            <th class="px-3 py-3 border-end">Status</th>
            <th class="px-4 py-3">Verifikasi</th>
        </tr>
    </thead>
    <tbody class="text-xs">
        @forelse($all_reports as $report)
            <tr class="text-center">
                <td class="px-3 py-4 border-end fw-bold">
                    <button type="button" class="btn btn-link text-decoration-none p-0 fw-bold text-primary" data-bs-toggle="modal" data-bs-target="#userModal{{ $report->id }}">
                        {{ $report->user->name }}
                    </button>
                    </td>

                <td class="border-end text-muted">{{ $report->created_at->format('d/m/y') }}</td>
                
                <td class="border-end">
                    <span class="badge {{ $report->jenis_laporan == 'buku' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }} rounded-pill px-2">
                        {{ strtoupper($report->jenis_laporan) }}
                    </span>
                </td>

                <td class="border-end text-start">
                    <button type="button" class="btn btn-outline-secondary btn-sm border-0 text-start w-100 p-2" data-bs-toggle="modal" data-bs-target="#completeDetail{{ $report->id }}">
                        <div class="d-flex align-items-center gap-2 text-dark">
                            <span>{{ $report->jenis_laporan == 'buku' ? '📖' : '📦' }}</span>
                            <div>
                                <div class="fw-bold truncate" style="max-width: 150px;">{{ $report->nama_item }}</div>
                                <div class="text-[10px] text-indigo-600 fw-bold">Klik untuk detail & bukti</div>
                            </div>
                        </div>
                    </button>

                    <div class="modal fade" id="completeDetail{{ $report->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg">
                                <div class="modal-header border-0 {{ $report->jenis_laporan == 'buku' ? 'bg-success text-white' : 'bg-warning text-dark' }}">
                                    <h6 class="modal-title fw-bold">Laporan Lengkap #{{ $report->id }}</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="mb-4">
                                        <label class="text-muted small fw-bold uppercase d-block mb-1">Nama Barang & Harga</label>
                                        <h4 class="fw-black text-dark mb-1">{{ $report->nama_item }}</h4>
                                        <h5 class="text-indigo-600 fw-bold">Rp{{ number_format($report->harga, 0, ',', '.') }}</h5>
                                    </div>

                                    <div class="bg-light p-3 rounded mb-4 border-start border-4 border-primary">
                                        <label class="text-muted small fw-bold d-block mb-1 italic">
                                            {{ $report->jenis_laporan == 'buku' ? 'Sinopsis Buku' : 'Keterangan ATK' }}
                                        </label>
                                        <p class="mb-0 text-sm">"{{ ($report->jenis_laporan == 'buku' ? $report->ringkasan_buku : $report->keterangan) ?? 'Tidak ada catatan.' }}"</p>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6 text-center">
                                            <label class="text-muted small fw-bold d-block mb-2">Foto Barang</label>
                                            <a href="{{ asset('storage/' . $report->foto_barang) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $report->foto_barang) }}" class="img-fluid rounded border shadow-sm" style="max-height: 150px; object-fit: cover;">
                                            </a>
                                        </div>
                                        <div class="col-6 text-center">
                                            <label class="text-muted small fw-bold d-block mb-2 text-danger">Bukti Nota/Kwitansi</label>
                                            <a href="{{ asset('storage/' . $report->foto_nota) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $report->foto_nota) }}" class="img-fluid rounded border shadow-sm border-danger" style="max-height: 150px; object-fit: cover;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-light w-100 fw-bold" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>

                <td class="border-end">
                    <span class="badge badge-status {{ $report->status == 'disetujui' ? 'bg-success' : ($report->status == 'ditolak' ? 'bg-danger' : 'bg-secondary') }}">
                        {{ strtoupper($report->status ?? 'PENDING') }}
                    </span>
                </td>

                <td class="bg-light-subtle">
                    <form action="{{ route('admin.report.status', $report->id) }}" method="POST" class="px-2 d-flex flex-col gap-1">
                        @csrf
                        <select name="status" class="form-select form-select-sm" style="font-size: 10px;">
                            <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="disetujui" {{ $report->status == 'disetujui' ? 'selected' : '' }}>Setujui</option>
                            <option value="ditolak" {{ $report->status == 'ditolak' ? 'selected' : '' }}>Tolak</option>
                        </select>
                        <button type="submit" class="btn btn-dark btn-sm w-100 fw-bold" style="font-size: 9px;">Simpan</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="py-5 text-center text-muted italic">Data kosong.</td></tr>
        @endforelse
    </tbody>
</table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</x-app-layout>