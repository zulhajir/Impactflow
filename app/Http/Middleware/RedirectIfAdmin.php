<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika pengguna login dan memiliki role 'admin' atau 'manager'
        if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'manager')) {
            // Arahkan mereka ke dashboard admin
            return redirect()->route('admin.dashboard');
        }

        // Jika tidak login atau bukan admin/manager, biarkan permintaan berlanjut
        return $next($request);
    }
}