<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CustomAuth
{
    /**
     * Handle an incoming request.
     * 
     * This middleware checks if user is authenticated via session
     * If not authenticated, redirects to login page
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in via session
        if (!Session::get('logged_in')) {
            // User is not authenticated, redirect to login with message
            return redirect()->route('login')->withErrors([
                'access' => 'Please log in to access this page.'
            ]);
        }

        // User is authenticated, allow access
        return $next($request);
    }
}