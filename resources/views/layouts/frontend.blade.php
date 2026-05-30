<!-- File: resources/views/layouts/frontend.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-light">

<div class="container-fluid py-4 min-vh-100">
    <div class="container">
        
        <!-- HEADER (Brand & Login/Register) -->
        <div class="row mb-4 align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <h3 class="fw-bold text-primary">E-Report Book</h3>
                <p class="text-muted small">Pusat Pelaporan Eramet Beyond Scholarship</p>
            </div>
            <div class="col-md-6 text-md-end text-center mt-3 mt-md-0">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary shadow-sm px-4">Buka Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary shadow-sm">Daftar Akun</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <hr class="mb-5">

        <!-- KONTEN DINAMIS DIMULAI DI SINI -->
        @yield('frontend-content')
        <!-- KONTEN DINAMIS SELESAI DI SINI -->
        
        <!-- FOOTER -->
        <footer class="mt-5 text-center py-4 text-muted">
            <small>&copy; {{ date('Y') }} Eramet Beyond Scholarship. Developed by Fitria Yosefina R.W.</small>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>