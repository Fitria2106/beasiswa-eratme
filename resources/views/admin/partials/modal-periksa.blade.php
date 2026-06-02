<div class="modal fade" id="modalPeriksa{{ $report->id }}" tabindex="-1" role="dialog" aria-labelledby="modalPeriksaLabel{{ $report->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalPeriksaLabel{{ $report->id }}">Detail Laporan: {{ $report->nama_item }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Kolom Informasi -->
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Kategori / Jenis Laporan</p>
                        <p class="font-weight-bold">{{ strtoupper($report->jenis_laporan) }}</p>

                        <p class="mb-1 text-muted small">Nominal / Harga</p>
                        <p class="font-weight-bold text-gray-900 h5">Rp {{ number_format($report->harga, 0, ',', '.') }}</p>

                        <p class="mb-1 text-muted small mt-3">Status Saat Ini</p>
                        <p>
                            @if($report->status == 'disetujui')
                                <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle"></i> DISETUJUI</span>
                            @elseif($report->status == 'ditolak')
                                <span class="badge badge-danger px-2 py-1"><i class="fas fa-times-circle"></i> DITOLAK</span>
                            @else
                                <span class="badge badge-warning px-2 py-1"><i class="fas fa-clock"></i> {{ strtoupper($report->status) }}</span>
                            @endif
                        </p>

                        @if($report->link)
                            <p class="mb-1 text-muted small mt-3">Link/URL (Sosial Media/Referensi)</p>
                            <p><a href="{{ $report->link }}" target="_blank" class="text-primary text-break"><i class="fas fa-external-link-alt"></i> Buka Link</a></p>
                        @endif
                        
                        <p class="mb-1 text-muted small mt-3">Deskripsi / Catatan Tambahan</p>
                        <p class="bg-light p-2 rounded text-dark">{{ $report->deskripsi ?? 'Tidak ada deskripsi tambahan.' }}</p>
                    </div>

                    <!-- Kolom Bukti Gambar -->
                    <!-- Kolom Kanan (Gambar) -->
<div class="col-md-6 text-center border-left">
    
    <!-- Buat Row (Baris) baru khusus untuk gambar -->
                <div class="row">
                    
                    <!-- Pembagian Kiri (Nota & Barang Fisik) -->
                    <div class="col-md-6">
                        <p class="mb-2 text-muted small font-weight-bold">Bukti Nota</p>
                        @if($report->foto_nota)
                            <img src="{{ asset('storage/' . $report->foto_nota) }}" class="img-fluid rounded bukti-thumbnail shadow-sm mb-3" alt="Foto Nota" style="max-height: 150px;">
                        @else
                            <span class="small text-muted d-block mb-3">-</span>
                        @endif

                        <p class="mb-2 text-muted small font-weight-bold">Foto Barang Fisik</p>
                        @if($report->foto_barang)
                            <img src="{{ asset('storage/' . $report->foto_barang) }}" class="img-fluid rounded bukti-thumbnail shadow-sm" alt="Foto Barang" style="max-height: 150px;">
                        @else
                            <span class="small text-muted">-</span>
                        @endif
                    </div>

                    <!-- Pembagian Kanan (Sosmed: Hashtag & Video Link) -->
                    <div class="col-md-6">
                        <p class="mb-2 text-muted small font-weight-bold">Bukti Tag Sosmed</p>
                        @if($report->hashtag_proof)
                            @if(\Illuminate\Support\Str::startsWith($report->hashtag_proof, ['http://', 'https://']))
                                <a href="{{ $report->hashtag_proof }}" target="_blank" class="btn btn-sm btn-outline-info mb-3">
                                    <i class="fas fa-external-link-alt"></i> Lihat Bukti Tag
                                </a>
                            @else
                                <img src="{{ asset('storage/' . $report->hashtag_proof) }}" class="img-fluid rounded bukti-thumbnail shadow-sm mb-3" alt="Bukti Tag" style="max-height: 150px;">
                            @endif
                        @else
                            <span class="small text-muted d-block mb-3">-</span>
                        @endif

                        <p class="mb-2 text-muted small font-weight-bold">Link Video Sosmed</p>
                        @if($report->video_link)
                            <a href="{{ $report->video_link }}" target="_blank" class="btn btn-sm btn-outline-primary mb-3">
                                <i class="fas fa-external-link-alt"></i> Tonton Video
                            </a>
                        @else
                            <span class="small text-muted">-</span>
                        @endif
                    </div>

                </div> <!-- Penutup Row Gambar -->
                
                <p class="small text-info mt-3"><i class="fas fa-search-plus"></i> Klik gambar untuk memperbesar</p>
            </div>
            </div> <!-- Penutup Row Utama -->
            </div> <!-- Penutup modal-body -->
            <div class="modal-footer bg-light">
                <!-- Form Setujui -->
                <form action="{{ route('admin.report.status', $report->id) }}" method="POST" class="d-inline m-0">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="disetujui">
                    <button type="submit" class="btn btn-success shadow-sm" {{ $report->status == 'disetujui' ? 'disabled' : '' }}>
                        <i class="fas fa-check"></i> Setujui Laporan
                    </button>
                </form>

                <!-- Form Tolak -->
                <form action="{{ route('admin.report.status', $report->id) }}" method="POST" class="d-inline m-0">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="ditolak">
                    <button type="submit" class="btn btn-danger shadow-sm" {{ $report->status == 'ditolak' ? 'disabled' : '' }}>
                        <i class="fas fa-times"></i> Tolak
                    </button>
                </form>

                <button type="button" class="btn btn-secondary shadow-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
