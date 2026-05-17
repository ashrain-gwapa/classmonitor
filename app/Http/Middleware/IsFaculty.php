<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsFaculty
{
    public function handle(Request $request, Closure $next): Response
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }

   if (auth()->user()->is_verified != 1) {
    abort(403, 'UNAUTHORIZED. FACULTY VERIFICATION REQUIRED.');
}

    return $next($request);
}
}