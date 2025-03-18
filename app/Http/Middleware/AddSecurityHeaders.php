<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddSecurityHeaders
{
    /**
     * Ajoute des en-têtes de sécurité à toutes les réponses.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Content Security Policy (CSP)
        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com https://unpkg.com; " .
            "style-src 'self' 'unsafe-inline' https://fonts.bunny.net; " . 
            "font-src 'self' https://fonts.bunny.net; " .
            "img-src 'self' data:; " .
            "connect-src 'self';"
        );

        // Protection contre le clickjacking
        $response->headers->set('X-Frame-Options', 'DENY');
        
        // Protection contre le MIME sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        
        // Protection XSS
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Referrer Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Feature Policy/Permissions Policy
        $response->headers->set(
            'Permissions-Policy', 
            'camera=(), microphone=(), geolocation=(), interest-cohort=()'
        );

        return $response;
    }
} 