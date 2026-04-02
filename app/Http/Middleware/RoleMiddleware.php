<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <--- WAJIB ADA INI

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. Cek apakah user sudah login
        // 2. Cek apakah role user sama dengan yang diminta (admin/mahasiswa)
        if (!Auth::check() || Auth::user()->role !== $role) {
            return redirect('/'); // Lempar ke home kalau tidak punya akses
        }

        return $next($request);
    }
}