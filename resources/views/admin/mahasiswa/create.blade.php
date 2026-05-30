@extends('layouts.sbadmin')
@section('title', 'Tambah Mahasiswa | Admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Akun Mahasiswa</h1>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Data Mahasiswa Baru</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required placeholder="Masukkan nama">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required placeholder="email@student.com">
            </div>

            <div class="form-group">
                <label>NIM (Nomor Induk Mahasiswa)</label>
                <input type="text" name="nim" class="form-control" required placeholder="Contoh: 12345678">
            </div>

            <div class="form-group">
                <label>Jurusan</label>
                <input type="text" name="jurusan" class="form-control" required placeholder="Contoh: S1 Teknik Informatika">
            </div>

            <div class="form-group">
                <label>Password Akun</label>
                <input type="password" name="password" class="form-control" required placeholder="Buat password (min. 8 karakter)">
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan & Buat Akun</button>
        </form>
    </div>
</div>
@endsection