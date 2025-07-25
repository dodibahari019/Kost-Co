<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsPenghuni
{

    public function handle(Request $request, Closure $next)
    {
        if (session('tipeUser') !== 'Penghuni') {
            abort(403, 'Akses ditolak. Hanya untuk Penghuni.');
        }

        return $next($request);
    }
}
