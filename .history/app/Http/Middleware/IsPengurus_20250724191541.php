<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsPengurus
{
    public function handle(Request $request, Closure $next)
    {
        if (session('tipeUser') !== 'Pengurus') {
            abort(403, 'Akses ditolak. Hanya untuk Pengurus.');
        }

        return $next($request);
    }
}
