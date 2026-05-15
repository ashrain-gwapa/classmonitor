<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsFaculty
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Terminate flow if user isn't authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 2. Reject students trying to modify lab parameters
        if (auth()->user()->role !== 'faculty') {
            abort(403, 'Access Denied. Student clearance constraints are active.');
        }

        // 3. Reject unverified faculty accounts
        if (!auth()->user()->is_verified) {
            abort(403, 'Your faculty authentication state is awaiting administrative confirmation.');
        }

        return $next($request);
    }
}