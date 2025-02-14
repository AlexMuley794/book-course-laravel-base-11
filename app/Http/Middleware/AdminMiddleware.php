<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->isAdmin()) {  // Verifica si el usuario está autenticado y es admin
            return $next($request);
        }

        // Si no es admin, redirigir a otra página (por ejemplo, inicio)
        return redirect('/')->with('error', 'Acceso denegado.');
    }
}
