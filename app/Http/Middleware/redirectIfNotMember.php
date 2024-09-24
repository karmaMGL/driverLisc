<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class redirectIfNotMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated with the 'Member' guard
        if (Auth::guard('Member')->check()) {
            // Redirect to the default route if not authenticated as 'Member'
            return redirect('/');
        }

        return $next($request);
    }
}
