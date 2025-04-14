<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Admin (id_role 0) bisa akses semua
        if (auth()->user()->id_role == 0) {
            return $next($request);
        }
        elseif (!in_array(auth()->user()->id_role, $roles)) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }
        else{
            return $next($request);
        }
    }
}
