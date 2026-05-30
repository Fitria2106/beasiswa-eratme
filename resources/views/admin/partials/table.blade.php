<tr>
    <td>
        <strong>{{ $report->nama_item }}</strong><br>
        <span class="text-muted small">{{ $report->deskripsi ?? '-' }}</span>
    </td>
    <td>
        <span class="badge badge-info mb-1">{{ strtoupper($report->jenis_laporan) }}</span><br>
        
        @if($report->status == 'pending')
            <span class="badge badge-warning text-dark"><i class="fas fa-clock mr-1"></i> Menunggu Verifikasi</span>
        @elseif($report->status == 'disetujui')
            <span class="badge badge-success"><i class="fas fa-check-circle mr-1"></i> Disetujui</span>
        @else
            <span class="badge badge-danger"><i class="fas fa-times-circle mr-1"></i> Ditolak</span>
        @endif
        
        <br><small class="text-muted">{{ $report->created_at->format('d M Y') }}</small>
    </td>
    <td class="font-weight-bold text-gray-900">Rp {{ number_format($report->harga, 0, ',', '.') }}</td>
    <td class="text-center">
        <button class="btn btn-sm btn-info shadow-sm mr-1" data-toggle="modal" data-target="#modalPeriksa{{ $report->id }}">
            <i class="fas fa-search"></i> Periksa
        </button>
        <form action="{{ route('admin.report.destroy', $report->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger shadow-sm">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </td>
</tr>
