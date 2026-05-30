@extends('layouts.sbadmin')

@section('title', 'Admin Dashboard | Eramet')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pusat Kendali Beasiswa</h1>
    <a href="{{ route('admin.cetak_pdf') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Download Laporan PDF
    </a>
    <a href="{{ route('admin.mahasiswa.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
    <i class="fas fa-user-plus fa-sm text-white-50"></i> Tambah Mahasiswa Baru
    </a>
</div>

{{-- Notifikasi Sukses --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

{{-- Summary Cards (Total Mahasiswa, Item Dilaporkan, Dana Terpakai) --}}
@include('admin.partials.summary-cards', ['allReports' => $allReports])

{{-- Tabel Laporan dan Modal Periksa --}}
@include('admin.partials.report-table', ['allReports' => $allReports])

{{-- Lightbox Zoom Gambar --}}
@include('admin.partials.lightbox')

@endsection