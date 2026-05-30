<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Pastikan ada parameter 'string $role' di atas ^

        if (auth()->check() && auth()->user()->role === $role) {
        return $next($request);
    }
}
}