<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

// ... (bagian atas) ...
class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        $user = Auth::user();

        // Jika role user BUKAN 'admin', tolak akses
        if ($user->role !== 'admin') { // Cukup cek 'admin'
            abort(403, 'Akses Dilarang. Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}