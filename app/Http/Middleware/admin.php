<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    if (auth()->check()) {
        if (auth()->user()->role == 'admin') {
            // Allow admin to continue
            return $next($request);
        } else {
            // Redirect non-admin users to their user page
            return redirect()->route('user');
        }
    }
    
    // If not authenticated, redirect to login
    return redirect()->route('login');
}

}
