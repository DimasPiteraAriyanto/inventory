<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user has any of the specified roles
        if ($user && $user->roles()->whereIn('name', $roles)->exists()) {
            return $next($request);
        }

        // Redirect or return a response if the user doesn't have the required roles
        return redirect('/home')->with('error', 'Unauthorized');
    }

}
