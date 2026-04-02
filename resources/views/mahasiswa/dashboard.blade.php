<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <div class="container py-5">
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 bg-primary text-white p-4" style="border-radius: 20px;">
                    <h6 class="opacity-75">Total Pengeluaran</h6>
                    <h2 class="fw-bold">Rp {{ number_format($reports->sum('harga'), 0, ',', '.') }}</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 bg-warning text-dark p-4" style="border-radius: 20px;">
                    <h6 class="opacity-75">Sisa Saldo (Dari Rp 1.5jt)</h6>
                    <h2 class="fw-bold">Rp {{ number_format(1500000 - $reports->sum('harga'), 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0" style="border-radius: 20px;">
            <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Daftar Laporan Saya</h5>
                <a href="{{ url('/upload') }}" class="btn btn-primary btn-sm rounded-pill px-3">+ Tambah</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>Tanggal</th>
                                <th>Item</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reports as $report)
                            <tr class="text-center">
                                <td>{{ $report->created_at->format('d/m/Y') }}</td>
                                <td class="text-start">{{ $report->nama_item }}</td>
                                <td class="fw-bold">Rp{{ number_format($report->harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge rounded-pill {{ $report->status == 'disetujui' ? 'bg-success' : ($report->status == 'ditolak' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                        {{ strtoupper($report->status ?? 'PENDING') }}
                                    </span>
                                </td>
                                <td>
                                    @if($report->status != 'disetujui')
                                    <div class="btn-group">
                                        <a href="{{ route('mahasiswa.edit', $report->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                        <form action="{{ route('mahasiswa.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                    @else
                                        <span class="text-muted small">Locked</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted italic">Belum ada data laporan yang diinput.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>