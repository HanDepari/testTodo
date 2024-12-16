<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the API token exists in the session
        if (!session()->has('api_token')) {
            // If no API token, redirect to login or return an unauthorized response
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }
    
        return $next($request);
    }
    
}
