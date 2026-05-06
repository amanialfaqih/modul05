<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // 🔥 CEK USER LOGIN & ROLE
        if (!auth()->check() || auth()->user()->role !== 'admin') {

            // kalau bukan admin → redirect
            return redirect('/home')->with('error', 'Akses ditolak!');
        }

        return $next($request);
    }
}