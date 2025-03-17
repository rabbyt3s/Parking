<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Temporairement désactivé pour le débogage
        // Laissez passer toutes les requêtes
        return $next($request);
        
        /*
        if (!auth()->check() || auth()->user()->est_admin != 1) {
            return redirect('/')->with('error', 'Accès non autorisé.');
        }

        return $next($request);
        */
    }
}