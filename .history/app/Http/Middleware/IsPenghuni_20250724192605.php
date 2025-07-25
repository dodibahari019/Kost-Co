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
            return redirect()->back()->with('message', 'Akses ditolak');
        }

        return $next($request);
    }
}
