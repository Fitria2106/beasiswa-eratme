<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Pelaporan Beasiswa Eramet">
    <meta name="author" content="Fitria">

    <title>Pendaftaran Mahasiswa | E-Report Beasiswa Eratme</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    <style>
        .bg-register-image {
            background: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1000&auto=format&fit=crop') center;
            background-size: cover;
        }
        /* Penyesuaian agar mirip dengan SB Admin 2 */
        .ts-control {
            border-radius: 10rem;
            padding: 0.8rem 1rem;
            font-size: 0.8rem;
            border: 1px solid #d1d3e2;
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
                                <p class="mb-4 text-muted">Lengkapi data di bawah ini untuk akses E-Report Beasiswa</p>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}">
                                @csrf
                                
                                <h6 class="text-primary font-weight-bold mb-3 border-bottom pb-2">
                                    <i class="fas fa-user mr-2"></i>Identitas Personal
                                </h6>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required autofocus>
                                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-danger small" />
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Alamat Email Aktif" required>
                                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger small" />
                                    </div>
                                </div>

                                <h6 class="text-primary font-weight-bold mb-3 border-bottom pb-2 mt-4">
                                    <i class="fas fa-graduation-cap mr-2"></i>Informasi Kampus
                                </h6>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim') }}" placeholder="NIM (Nomor Induk Mahasiswa)" required>
                                    <x-input-error :messages="$errors->get('nim')" class="mt-1 text-danger small" />
                                </div>
                                <div class="form-group">
                                    <select id="campus" name="campus" placeholder="Pilih atau Ketik Nama Perguruan Tinggi..." required></select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="jurusan" name="jurusan" value="{{ old('jurusan') }}" placeholder="Program Studi / Jurusan (Contoh: S1 Informatika)" required>
                                </div>

                                <h6 class="text-primary font-weight-bold mb-3 border-bottom pb-2 mt-4">
                                    <i class="fas fa-lock mr-2"></i>Keamanan Akun
                                </h6>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger small" />
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password_confirmation" name="password_confirmation" placeholder="Ulangi Password" required>
                                    </div>
                                </div>
                                <div class="text-muted small mb-4 px-2">
                                    <i class="fas fa-info-circle mr-1"></i> Minimal <strong>8 karakter</strong>, gunakan kombinasi <strong>huruf besar, huruf kecil, angka,</strong> dan <strong>simbol</strong>.
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block font-weight-bold">
                                    Daftar Akun Sekarang
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Sudah punya akun? Masuk di sini!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/js/sb-admin-2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('campus')) {
                new TomSelect("#campus", {
                    create: true,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            }
        });
    </script>
</body>
</html>
