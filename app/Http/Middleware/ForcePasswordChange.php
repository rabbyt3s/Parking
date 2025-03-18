<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si l'utilisateur est connecté et doit changer son mot de passe
        if (auth()->check() && auth()->user()->force_password_change) {
            // Rediriger vers la page de changement de mot de passe
            // à moins que l'utilisateur ne soit déjà sur cette page ou en train de la soumettre
            $passwordRoutes = ['password.force.change', 'password.force.update'];
            
            if (!$request->routeIs($passwordRoutes)) {
                return redirect()->route('password.force.change')
                    ->with('warning', 'Vous devez changer votre mot de passe avant de continuer.');
            }
        }

        return $next($request);
    }
}
