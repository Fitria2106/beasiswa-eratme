@extends('layouts.sbadmin')

@section('title', 'Mahasiswa Dashboard | Eramet')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Utama</h1>
    <a href="{{ route('mahasiswa.upload') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pengajuan Laporan
    </a>
</div>

{{-- Notifikasi --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row">

    <!-- Card Welcome -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card bg-primary text-white shadow h-100 py-2">
            <div class="card-body">
                <h4 class="font-weight-bold">Selamat Datang! ✨</h4>
                <p>Sistem E-Report Beasiswa Eramet - KBF Indonesia</p>
                <hr class="bg-white">
                <div class="small">Akun: <strong>{{ Auth::user()->email }}</strong></div>
            </div>
        </div>
    </div>

    <!-- Card Saldo -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            SISA SALDO BEASISWA SAYA
                        </div>
                        @php
                            $terpakai = $reports->where('status', 'disetujui')->sum('harga');
                            $sisa = 1500000 - $reports->sum('harga');
                            $persen = ($terpakai / 1500000) * 100;
                        @endphp
                        <div class="h3 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($sisa, 0, ',', '.') }}</div>
                        
                        <div class="mt-3">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-success" role="progressbar" 
                                     style="width: {{ $persen }}%" aria-valuenow="{{ $persen }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-muted mt-2 d-block">
                                Terpakai (Disetujui): Rp {{ number_format($terpakai, 0, ',', '.') }} dari Rp 1.500.000
                            </small>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-wallet fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- DataTales Riwayat Pengajuan -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-history mr-2"></i>Riwayat Pengajuan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Item & Jenis</th>
                        <th>Nominal</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr>
                        <td class="text-muted">{{ $report->created_at->format('d M Y') }}</td>
                        <td>
                            <strong class="text-gray-900">{{ $report->nama_item }}</strong><br>
                            <span class="badge badge-secondary">{{ strtoupper($report->jenis_laporan) }}</span>
                        </td>
                        <td class="font-weight-bold">Rp {{ number_format($report->harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @if($report->status == 'disetujui')
                                <span class="badge badge-success px-3 py-2">DISETUJUI</span>
                            @elseif($report->status == 'ditolak')
                                <span class="badge badge-danger px-3 py-2">DITOLAK</span>
                            @else
                                <span class="badge badge-warning px-3 py-2 text-uppercase">{{ $report->status }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($report->status == 'pending')
                                <a href="{{ route('mahasiswa.edit', $report->id) }}" class="btn btn-warning btn-sm btn-circle" title="Edit Laporan">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @else
                                <span class="text-muted small"><i class="fas fa-lock"></i> Terkunci</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada data pengajuan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection