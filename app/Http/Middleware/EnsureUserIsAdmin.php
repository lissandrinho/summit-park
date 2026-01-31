<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Si el usuario es 'admin', pasa. Si no, error 403 (Prohibido) o redirect al home.
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }

        return redirect('/'); // O abort(403);
    }
}