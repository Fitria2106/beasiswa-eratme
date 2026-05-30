@extends('layouts.sbadmin')

@section('title', 'Perbaiki Laporan | Eramet')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Perbaiki Laporan</h1>
    <a href="{{ route('mahasiswa.dashboard') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Dashboard
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">

        @if ($errors->any())
            <div class="alert alert-danger shadow-sm mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Update Data Laporan</h6>
            </div>
            
            <div class="card-body">
                <form action="{{ route('mahasiswa.update', $report->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label class="form-label font-weight-bold text-gray-800">Nama Barang / Judul Buku</label>
                            <input type="text" name="nama_item" class="form-control" value="{{ old('nama_item', $report->nama_item) }}" required>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label class="form-label font-weight-bold text-gray-800">Harga (Rp)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold">Rp</span>
                                </div>
                                <input type="number" name="harga" class="form-control" value="{{ old('harga', $report->harga) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 p-3 bg-light rounded border">
                        <label class="form-label font-weight-bold text-gray-800">Foto Nota Pembelian</label>
                        <div class="d-flex align-items-center mt-2">
                            <img src="{{ asset('storage/' . $report->foto_nota) }}" class="rounded shadow-sm border mr-4" style="width: 100px; height: 100px; object-fit: cover;">
                            <div>
                                <input type="file" name="foto_nota" class="form-control-file">
                                <small class="text-muted d-block mt-2 font-italic">Kosongkan jika tidak ingin mengganti nota.</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 p-3 bg-light rounded border">
                        <label class="form-label font-weight-bold text-gray-800">Foto Barang Fisik</label>
                        <div class="d-flex align-items-center mt-2">
                            <img src="{{ asset('storage/' . $report->foto_barang) }}" class="rounded shadow-sm border mr-4" style="width: 100px; height: 100px; object-fit: cover;">
                            <div>
                                <input type="file" name="foto_barang" class="form-control-file">
                                <small class="text-muted d-block mt-2 font-italic">Kosongkan jika tidak ingin mengganti foto barang.</small>
                            </div>
                        </div>
                    </div>

                    <hr>
                    
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary px-4 mr-2">BATAL</a>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fas fa-save mr-2"></i>SIMPAN PERUBAHAN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection