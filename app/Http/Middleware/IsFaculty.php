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

    if (auth()->user()->role !== 'faculty' || !auth()->user()->is_verified) {
        abort(403, 'Unauthorized. Faculty verification required.');
    }

    return $next($request);
}
}