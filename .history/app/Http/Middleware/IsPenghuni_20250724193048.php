<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsPenghuni
{
    public function handle(Request $request, Closure $next)
    {
        if (session('role') !== 'Penghuni') {
            return redirect()->back()->with('message', 'Akses ditolak');
            // abort(403, 'Akses ditolak. Hanya untuk Penghuni.');
        }

        return $next($request);
    }
}
