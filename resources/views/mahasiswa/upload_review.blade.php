@extends('layouts.sbadmin')

@section('title', 'Upload Review Buku | Eramet')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Upload Review Buku</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">Form Upload Link Review Video</h6>
            </div>
            
            <div class="card-body">
                <p class="text-muted small mb-4">Pilih laporan buku yang sudah disetujui untuk disematkan link review videonya.</p>
                
                <form action="{{ route('mahasiswa.store_review') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-gray-800">Pilih Laporan Buku</label>
                        <select name="report_id" class="form-control shadow-sm" required>
                            <option value="">-- Pilih Laporan --</option>
                            @forelse($reports as $report)
                                <option value="{{ $report->id }}" {{ old('report_id') == $report->id ? 'selected' : '' }}>
                                    {{ $report->nama_item }} ({{ $report->created_at->format('d M Y') }})
                                </option>
                            @empty
                                <option value="" disabled>Tidak ada laporan buku yang perlu di-review.</option>
                            @endforelse
                        </select>
                        @error('report_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-gray-800">Link Video Review</label>
                        <input type="url" name="video_link" class="form-control" placeholder="https://www.youtube.com/..." value="{{ old('video_link') }}" required>
                        @error('video_link')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label font-weight-bold text-gray-800">Upload Screenshot Bukti Tag (#beasiswaeramet #kbfindonesia_tinjaubuku)</label>
                        <input type="file" name="hashtag_proof" class="form-control-file border p-2 rounded" accept="image/*" required>
                        @error('hashtag_proof')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>
                    
                    <button type="submit" class="btn btn-primary btn-block font-weight-bold shadow-sm">
                        <i class="fas fa-upload mr-2"></i>Upload Review
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection