<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            abort(401, 'No autorizado.');
        }
        if (!auth()->user()->permissions()->pluck('name')->contains('ADMIN_PERMISSIONS')) {
            abort(403, 'No autorizado.');
        }

        return $next($request);
    }
}
