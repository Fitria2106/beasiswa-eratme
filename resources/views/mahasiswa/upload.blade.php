@extends('layouts.sbadmin')

@section('title', 'Tambah Laporan Baru | Eramet')

@push('css')
<style>
    #input_buku { display: none; }
</style>
@endpush

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Laporan Baru</h1>
    <a href="{{ route('mahasiswa.dashboard') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Dashboard
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Form Laporan Penggunaan Dana</h6>
            </div>
            
            <div class="card-body">
                <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf 

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-gray-800">Kategori Laporan</label>
                            <select name="jenis_laporan" id="jenis_laporan" class="form-control shadow-sm" onchange="gantiInput()" required>
                                <option value="barang_penunjang">📦 Barang Penunjang (ATK)</option>
                                <option value="buku">📖 Buku Koleksi</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold text-gray-800">Semester Berjalan</label>
                            <select name="semester" class="form-control shadow-sm" required>
                                @for ($i = 4; $i <= 8; $i++)
                                    <option value="{{ $i }}">Semester {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label id="label_item" class="form-label font-weight-bold text-primary">Nama Barang / ATK</label>
                        <input type="text" name="nama_item" class="form-control" placeholder="Masukkan nama barang..." required>
                    </div>

                    <div class="mb-3">
                        <div id="input_atk" class="p-3 rounded border border-warning bg-light">
                            <label class="form-label font-weight-bold text-warning">Keterangan Penggunaan ATK</label>
                            <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Untuk print tugas akhir..."></textarea>
                        </div>

                        <div id="input_buku" class="p-3 rounded border border-primary bg-light">
                            <label class="form-label font-weight-bold text-primary">Ringkasan / Sinopsis Buku</label>
                            <textarea name="ringkasan_buku" class="form-control" rows="3" placeholder="Jelaskan singkat isi buku..."></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-gray-800">Nominal Harga (Rp)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold">Rp</span>
                            </div>
                            <input type="number" name="harga" class="form-control" placeholder="0" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label font-weight-bold text-gray-800">Foto Nota</label>
                            <input type="file" name="foto_nota" class="form-control-file border p-2 rounded" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold text-gray-800">Foto Barang</label>
                            <input type="file" name="foto_barang" class="form-control-file border p-2 rounded" required>
                        </div>
                    </div>

                    <hr>
                    
                    <button type="submit" class="btn btn-primary btn-block font-weight-bold shadow-sm">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Laporan Sekarang
                    </button>
                </form> 
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function gantiInput() {
        var kategori = document.getElementById("jenis_laporan").value;
        var divAtk = document.getElementById("input_atk");
        var divBuku = document.getElementById("input_buku");
        var labelItem = document.getElementById("label_item");

        if (kategori === "buku") {
            divAtk.style.display = "none";
            divBuku.style.display = "block";
            labelItem.innerText = "Judul Buku Lengkap";
        } else {
            divAtk.style.display = "block";
            divBuku.style.display = "none";
            labelItem.innerText = "Nama Barang / ATK";
        }
    }
</script>
@endpush